<?php

use App\Http\Controllers\ProfileController;
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

Route::get("/presence", function ($presence) {

})->name('presences.index');

Route::get("/users", function ($presence) {

})->name('users.index');

Route::get("/lieux", function ($presence) {

})->name('lieux.index');

Route::get("/statistiques", function ($presence) {

})->name('statistiques');



Route::get("/users/new", function ($presence) {

})->name('users.create');

Route::get("/lieu/new", function ($presence) {

})->name('lieux.create');