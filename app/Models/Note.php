<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Yaml\Yaml;

/**
* Mange notes
*/
class Note {

    public $id;
    public $title;

    // user text
    public $content;

    // generated text
    public $markdown;

    public function __construct($id = '', $title = '') {
        $this->id = empty($id) ? Str::uuid()->toString() : $id;
        $this->title = $title;
    }

    public static function find($id) {
        $notes = static::all();
        $note = $notes->firstWhere('id', $id);
        return $note;
    }

    public static function delete(Note $note) {

        return Storage::delete('notes' . DIRECTORY_SEPARATOR . $note->id . '.md');

    }

    public static function findOrFail($id)
    {
        $note = static::find($id);

        if ($note == null) {
            throw new ModelNotFoundException();
        }

        return $note;
    }

    public static function update(Note $note) {
        $metadata = array(
            'title' => $note->title,
            'id' => $note->id
        );

        $frontmatter = Yaml::dump($metadata, 2, 4, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);

        $markdown = "---" . PHP_EOL . $frontmatter . "---" . PHP_EOL . PHP_EOL . $note->content;

        return Storage::disk('local')->put('notes' . DIRECTORY_SEPARATOR . $note->id . '.md', $markdown);

    }

    public static function save() : bool {

        // TODO: attributes - validator ... check
        $note = new Note('', request('title'));
        $note->content = request('content');

        $metadata = array(
            'title' => $note->title,
            'id' => $note->id
        );

        $frontmatter = Yaml::dump($metadata, 2, 4, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);

        $markdown = "---" . PHP_EOL . $frontmatter . "---" . PHP_EOL . PHP_EOL . $note->content;

        return Storage::disk('local')->put('notes' . DIRECTORY_SEPARATOR . $note->id . '.md', $markdown);

    }


    public static function all() {
        $files = Storage::files('notes');

        $notes = collect($files)->map(function ($file) {

            $fileToParse = Storage::disk('local')->get($file);

            return YamlFrontMatter::parse(
                $fileToParse
            );
        })->map(function ($document) {
            $note = new Note($document->id, $document->title);
            $note->content = $document->body();

            return $note;

        })->map(function ($note) {
            $note->markdown = Str::markdown($note->content);

            return $note;
        });

        return $notes;
    }
}
