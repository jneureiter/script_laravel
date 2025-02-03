<?php

namespace App\Providers;


use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('note', function (string $value) {
            return Note::findOrFail($value);
        });

        Gate::define('show-note', function (User $user, Note $note) {
            return $note->author === $user->id;
        });
    }
}
