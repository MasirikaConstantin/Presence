<?php

use App\Http\Controllers\GestionLieux;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

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
})->middleware(['auth', 'verified'])->name('dashboard');

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
Route::get('/presences', [PresenceController::class, 'index'])->name('presences.index');



Route::get("/statistiques", function ($presence) {

})->name('statistiques');




Route::prefix('/lieux')->name('lieux.')->controller(GestionLieux::class)->group(function () {
    
    Route::get("/new","new")->name('create');
    Route::post("/new","store")->name('store');
    Route::delete("/destroy/{lieu}","destroy")->name('destroy');
    Route::post('/lieux/{lieu}', "update")->name('update');
})->middleware(['auth']);



Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('user/{utilisateur}', [UserController::class,"voir"])->name('voir');
});

