<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\BlogEntries;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home', ['blogPosts' => App\Models\BlogPosts::with('user')->get()]);
});

Route::get('/article/{slug}', [\App\Http\Controllers\BlogPostsController::class, 'show'])->name('article');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('blog-entries', BlogEntries::class)->name('blog-entries');
});
