<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class RestController extends Controller
{
    public function index(){
        $notes = Note::all();

        $response = [
            'success' => true,
            'notes' => $notes,
            'results' => count($notes),
        ];

        return response()->json($response, 200);
    }

    public function show($id){
        $note = Note::find($id);

        if ($note == null) {
            $response = [
                'success' => false,
                'message' => 'Note not found'
            ];

            return response()->json($response, 404);
        }

        $response = [
            'success' => true,
            'note' => $note,
        ];

        return response()->json($response);
    }
}
