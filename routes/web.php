<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\RestController;
use App\Models\Note;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function (){
    return view('list');
});

Route::get('/notes/{id}', function($noteId) {

    $note = Note::findOrFail($noteId);

    return view('details', array(
        'title' => $note->title,
        'note' => $note
    ));
});

Route::get('/', function (){
    return view('list', array(
        'notes' => Note::all()
    ));
})->name('notes.list');

Route::post('/notes', [NoteController::class, 'store'])
    ->name('notes.store');

Route::delete('/notes/{note}', [NoteController::class, 'destroy'])
    ->name('notes.destroy');

Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])
    ->name('notes.edit');

Route::patch('/notes/{note}', [NoteController::class, 'update'])
    ->name('notes.update');


/**
 * REST - api.php
 */
Route::get('/api/notes', [RestController::class, 'index'])
    ->name('rest.index');

Route::get('/api/notes/{id}', [RestController::class, 'show'])
    ->name('rest.show');
