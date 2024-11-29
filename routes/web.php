<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GestionLieux;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
ini_set('memory_limit', '256M');
Route::get('/', function () {
    return view('auth/login');
})->middleware('guest');

Route::get('/posts', function () {
    return view('posts', [
        'posts' => Post::with(['categorie', 'type', 'user'])->get()
    ]);
})->name("posts");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','rolemanager:admin'])->name('dashboard');


Route::get('/erreur', function () {
    return view('autres');
})->middleware(['auth', 'verified','rolemanager:utilisateur'])->name('autres');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/change-language/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'fr'])) {
        Session::put('locale', $lang);
        App::setLocale($lang);
    }
    return Redirect::back();
})->name('change.language');


/*
Route::get("/users", function ($presence) {

})->name('users.index');
Route::get("/users/new", function ($presence) {

})->name('users.create');
*/
Route::get('/presences', [PresenceController::class, 'index'])->name('presences.index')->middleware(['auth','rolemanager:admin']);



Route::get("/statistiques", function ($presence) {

})->name('statistiques')->middleware(['auth','rolemanager:admin']);




Route::prefix('/lieux')->name('lieux.')->controller(GestionLieux::class)->group(function () {
    
    Route::get("/new","new")->name('create');
    Route::post("/new","store")->name('store');
    Route::delete("/destroy/{lieu}","destroy")->name('destroy');
    Route::post('/lieux/{lieu}', "update")->name('update');
})->middleware(['auth','rolemanager:admin']);



Route::middleware(['auth','rolemanager:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('user/{utilisateur}', [UserController::class,"voir"])->name('voir');
});


Route::middleware(['auth','verified','rolemanager:admin'])->group(function () {
    Route::resource('admin', AdminController::class);
  //  Route::get('admin/{utilisateur}', [AdminController::class,"voir"])->name('admin.voir');
  Route::get('admin/{utilisateur}/voir', [AdminController::class, 'voir'])->name('admin.voir');

    Route::patch('/admin/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.toggleStatus');

});

Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');

Route::get('/presences/pdf', [PresenceController::class, 'exportPdf'])->name('presences.exportPdf');

Route::get('/presences/imprimer', function () {
    $presences = session('presences');
    $filterDate = request()->get('date', 'N/A'); // Récupération du paramètre 'date'
    $status = request()->get('status', 'Tous'); // Récupération du paramètre 'status'

    if (!$presences) {
        return redirect()->back()->with('error', 'Aucune donnée disponible pour l\'impression.');
    }

    $pdf = Pdf::loadView('presences.pdf', compact('presences', 'filterDate', 'status'));
    return $pdf->stream('presences.pdf');
})->name('presences.imprimer');

