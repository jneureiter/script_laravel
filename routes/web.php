<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\TokenController;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
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

//3|5r5le87zTgIPhPkwsFkeIPr0hJRxjmBF0xEhJEbe74f033c9
Route::get('/login-single', function (){
    $res = Auth::attempt([
            'email' => 'max.muster@example.com',
            'password' => 'max']
    );

    if($res == true){

        $token = auth()->user()->createToken('Demo Single', ['notes:singe']);

        return 'Ergebnis: ' . $token->plainTextToken;
    }


    return 'Falsch';
});

//4|9jHO4sTtEDGwdh58WOOuEM0GjYv3NBE8tJgYXIVSf2a36684
Route::get('/login-all', function (){
    $res = Auth::attempt([
            'email' => 'max.muster@example.com',
            'password' => 'max']
    );

    if($res == true){

        $token = auth()->user()->createToken('Demo all', ['notes:all']);

        return 'Ergebnis: ' . $token->plainTextToken;
    }


    return 'Falsch';
});

// 2|9c7wSgS8YW7kTB5dTg6RP0dNlqQ6p7zaBn8QOblZc9a2781c
Route::get('/login', function(){

    $res = Auth::attempt([
        'email' => 'max.muster@example.com',
        'password' => 'max']
    );

    if($res == true){

        $token = auth()->user()->createToken('Demo 1');

        return 'Ergebnis: ' . $token->plainTextToken;
    }


    return 'Falsch';

});//->name('login')


// Route für die Ansicht
Route::get('/token-generator', [TokenController::class, 'showTokenGenerator'])->name('token.view');

// Route für die Token-Generierung
Route::post('/generate-token', [TokenController::class, 'generateToken'])->name('generate.token');
