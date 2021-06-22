<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Početna stranica. Povlače se tri niza od 4 filma.
Route::get('/', [MovieController::class, 'index'])->name('home');

Route::get('/login', function (){
    return view('login');
})->name("login");

Route::get('/404', function (){
    return view('errors.404');
})->name('404');

Route::patch('/user/update/{id}', [UserController::class, 'update'])->name('user-update');

Route::get('/register', [UserController::class, 'create'])->name("register");
Route::post('/register', [UserController::class, 'store'])->name("register");
//Otvara stranicu na kojoj korisnik može da pregleda sve filmove i da ih razvrsta po raznim kriterijumima
Route::get('/browse', function (){
    return view('browse');
})->name("browse");

Route::post('/api/browse', [ApiController::class, 'browse']);

//Otvara stranicu o autoru, sa koje se isti može kontaktirati
Route::get('/author', function (){
    return view('author');
})->name("author");

//Otvara dokumentaciju
Route::get('/documentation', function () {
    echo "documentation";
})->name('documentation');

//Prikaz detalja o odabranom filmu
Route::get('/movies/show/{id}', [MovieController::class, 'show']);

//Dohvata sve filmove na osnovu zadatih kriterijuma. Prikazuju se na stranici browse
Route::post('/browse', [MovieController::class, 'browse_post']);

//Dohvata žanrove koji se upisuju u dropdown listu, kako bi korisnik mogao da ih odabere pri filtriranju
Route::get('api/genres', [ApiController::class, 'get_genres']);

//Dohvata sve komentare određenog filma kada se stranica učita, i kada korisnik doda novi komentar
Route::get('/api/comments/get_all/{movie_id}', [ApiController::class, 'comments_get']);

Route::get('/password/reset', function () {
    return view('password-reset');
})->name('password-reset-form');

Route::post('/password/reset', [UserController::class, 'password_reset'])->name('password-reset');

Route::get('/email_verify/{email}/{code}', [UserController::class, 'email_verify'])->name('email-verify');

//Odrađuje prijavljivanje
Route::post('/login', [UserController::class, 'login'])->name("do-login");

//Rute ka admin stranicama. Prolaze kroz sva middleware-a. Jedan proverava da li je korisnik ulogovan, a drugi da li je admin.
Route::middleware(['isLoggedOut', 'isAdmin'])->group(function(){

    Route::prefix('admin')->group(function () {

        //Upisuje film u bazu
        Route::post('movies/store', [MovieController::class, 'store'])->name("movies-store");

        //Briše film iz baze
        Route::post('movies/delete', 'MovieController@destroy')->name("movies-delete");

        //Briše korisnika iz baze
        Route::post('users/delete', 'UserController@destroy')->name("users-delete");

        //Menja film u bazi
        Route::post('movies/update', 'MovieController@update')->name("movies-update");

        //Otvara formu za izmenu filma
        Route::get('movies/edit/{id}', 'MovieController@edit')->name('movies-edit');

        //Dohvata korisnike za prikaz adminu
        Route::get('users', [UserController::class, 'index'])->name("admin-users");

        //Dohvata komentare za prikaz adminu
        Route::get('comments', 'PageController@admin_comments')->name("admin-comments");

        //Neki osnovni, relativno nebitni statistički podaci
        Route::get('overview', function (){
            return view('admin.admin-overview');
        })->name("admin-overview");

        //Otvara formu za unos filma
        Route::get('movies/create', [MovieController::class, 'create'])->name("movies-create");

        //Otvara adminovu stranicu sa filmovima
        Route::get('movies', function(){
            return view('/admin/admin-movies');
        })->name("admin-movies");

    });
    //Dohvata filmove ajaxom za adminovu stranicu sa filmovima (paginacija)
    Route::get('/api/admin/movies/{current_page}', [ApiController::class, 'admin_get_movies']);

    //Dohvata korisnike ajaxom za adminovu stranicu sa korisnicima (paginacija)
    Route::get('/api/admin/users/{current_page}', [ApiController::class, 'admin_get_users']);

});

//Ukoliko nije prijavljen, ne može da pristupi stranici za profil
Route::middleware(['isLoggedOut'])->group(function(){
    Route::get('/profile', function(){
        return view('profile');
    })->name('profile');
});

//Poništava sesiju
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//Dodaje komentar ajaxom
Route::post('api/comments/create', [ApiController::class, 'comment_add']);
