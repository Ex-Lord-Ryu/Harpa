<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Email Verification Routes
Route::get('/verify-email/{email?}', [App\Http\Controllers\Auth\VerificationController::class, 'showVerificationForm'])
    ->name('verification.notice')
    ->middleware('guest');
Route::post('/verify-email', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])
    ->name('verification.verify')
    ->middleware('guest');
Route::post('/verify-email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resendOtp'])
    ->name('verification.resend')
    ->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changepassword'])->name('profile.change-password');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::get('/blank-page', [App\Http\Controllers\HomeController::class, 'blank'])->name('blank');

    Route::get('/hakakses', [App\Http\Controllers\HakaksesController::class, 'index'])->name('hakakses.index')->middleware('admin');
    Route::get('/hakakses/create', [App\Http\Controllers\HakaksesController::class, 'create'])->name('hakakses.create')->middleware('admin');
    Route::post('/hakakses/store', [App\Http\Controllers\HakaksesController::class, 'store'])->name('hakakses.store')->middleware('admin');
    Route::get('/hakakses/edit/{id}', [App\Http\Controllers\HakaksesController::class, 'edit'])->name('hakakses.edit')->middleware('admin');
    Route::put('/hakakses/update/{id}', [App\Http\Controllers\HakaksesController::class, 'update'])->name('hakakses.update')->middleware('admin');
    Route::delete('/hakakses/delete/{id}', [App\Http\Controllers\HakaksesController::class, 'destroy'])->name('hakakses.delete')->middleware('admin');

    Route::post('/hakakses/{id}/send-otp', [App\Http\Controllers\HakaksesController::class, 'sendOtp'])->name('hakakses.send-otp')->middleware('admin');
    Route::post('/hakakses/{id}/verify-otp', [App\Http\Controllers\HakaksesController::class, 'verifyOtp'])->name('hakakses.verify-otp')->middleware('admin');
    Route::put('/hakakses/{id}/update-password', [App\Http\Controllers\HakaksesController::class, 'updatePassword'])->name('hakakses.update-password')->middleware('admin');

    Route::get('/table-example', [App\Http\Controllers\ExampleController::class, 'table'])->name('table.example');
    Route::get('/clock-example', [App\Http\Controllers\ExampleController::class, 'clock'])->name('clock.example');
    Route::get('/chart-example', [App\Http\Controllers\ExampleController::class, 'chart'])->name('chart.example');
    Route::get('/form-example', [App\Http\Controllers\ExampleController::class, 'form'])->name('form.example');
    Route::get('/map-example', [App\Http\Controllers\ExampleController::class, 'map'])->name('map.example');
    Route::get('/calendar-example', [App\Http\Controllers\ExampleController::class, 'calendar'])->name('calendar.example');
    Route::get('/gallery-example', [App\Http\Controllers\ExampleController::class, 'gallery'])->name('gallery.example');
    Route::get('/todo-example', [App\Http\Controllers\ExampleController::class, 'todo'])->name('todo.example');
    Route::get('/contact-example', [App\Http\Controllers\ExampleController::class, 'contact'])->name('contact.example');
    Route::get('/faq-example', [App\Http\Controllers\ExampleController::class, 'faq'])->name('faq.example');
    Route::get('/news-example', [App\Http\Controllers\ExampleController::class, 'news'])->name('news.example');
    Route::get('/about-example', [App\Http\Controllers\ExampleController::class, 'about'])->name('about.example');

    // Simple route using a closure instead of a controller
    Route::post('/contact', function (Illuminate\Http\Request $request) {
        // Process contact form
        return redirect()->back()->with('status', 'Pesan Anda telah dikirim. Terima kasih!');
    })->name('contact.submit');
});
