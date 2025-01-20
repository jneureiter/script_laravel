<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/**
* Mange notes
*/
class Note {

    public $id;
    public $title;
    public $content;
    public function __construct($id, $title) {
        $this->id = $id;
        $this->title = $title;
    }

    public static function find($id) {
        $notes = static::all();
        $note = $notes->firstWhere('id', $id);
        return $note;
    }

    public static function findOrFail($id)
    {
        $note = static::find($id);

        if ($note == null) {
            throw new ModelNotFoundException();
        }

        return $note;
    }

    public static function all() {
        $path = resource_path("notes");

        $files = File::files($path);

        $notes = collect($files)->map(function ($file) {
            return YamlFrontMatter::parse(
                file_get_contents($file)
            );
        })->map(function ($document) {
            $note = new Note($document->id, $document->title);
            $note->content = $document->body();

            return $note;
        })->map(function ($note) {
            $note->content = Str::markdown($note->content);

            return $note;
        });

        return $notes;
    }
}
