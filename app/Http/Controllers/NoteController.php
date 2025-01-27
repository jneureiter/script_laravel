<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function store(Request $request){


        $attributes = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string|min:1|max:255',
        ]);


        $note = new Note();
        $note->title = $attributes['title'];
        $note->content = $attributes['content'];
        $res = $note->save();

        if($res){
            return back()->with('success', 'Note created successfully');
        }
    }

    public function destroy(Note $note){
        $res = Note::delete($note);

        if($res){
            return back()->with('success', 'Note deleted successfully');
        }
    }

    public function edit(Note $note){
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note){
        $attributes = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string|min:1|max:255',

        ]);

        $note->title = $attributes['title'];
        $note->content = $attributes['content'];

        $res = Note::update($note);

        if($res){
            return redirect()->route('notes.list')->with('success', 'Note updated successfully');
        }

    }
}
