<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HubSpotContactController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('home');
});


// Contacts page route
// Route::get('/contacts', [HomeController::class, 'contacts'])->name('contacts.index');

// Home page route
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

//Route for updating a contact
Route::patch('/contacts/{id}', [HubSpotContactController::class, 'update'])->name('contacts.update');

//Route for deleting a contact
Route::delete('/contacts/{id}', [HubSpotContactController::class, 'destroy'])->name('contacts.destroy');

