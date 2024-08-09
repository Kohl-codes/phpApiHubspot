<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HubSpotContactController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('home');
});



Route::get('/', [HomeController::class, 'index'])->name('home');


// Route for managing contacts
Route::get('/contacts', function () {
    return view('contacts'); // This should be the view for managing contacts
})->name('contacts.manage');

// Route for displaying all contacts
Route::get('/allcontacts', [HubSpotContactController::class, 'index'])->name('contacts.all');

// Route for storing a new contact
Route::post('/contacts', [HubSpotContactController::class, 'store'])->name('contacts.store');

// Route for searching contacts
Route::get('/search', [HubSpotContactController::class, 'search'])->name('contacts.search');


