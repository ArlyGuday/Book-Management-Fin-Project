<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    if ($user->role === 'admin') {
        $users = \App\Models\User::with('books')->get();
        $totalUsers = \App\Models\User::count();
        $totalBooks = \App\Models\Book::count();
        $books = \App\Models\Book::with('user')->get();
    } else {
        $books = $user->books;
        $users = null;
        $totalUsers = null;
        $totalBooks = null;
    }
    
    return view('dashboard', compact('books', 'users', 'totalUsers', 'totalBooks'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('books', BookController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
});


require __DIR__.'/auth.php';
