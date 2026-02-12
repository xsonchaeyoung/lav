<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('form');
})->name('home');


Route::post('/saveData', [FormController::class, 'saveData']);

Route::get('/contacts', [FormController::class, 'getContacts'])->name('contacts');

Route::post('/contacts/update', [FormController::class, 'update'])->name('contacts.update');

Route::delete('/contacts/{id}',[FormController::class,'delete'])->name('contacts.delete');