<?php

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
});

