<?php

namespace App\Providers;

use App\Models\Note;
use App\Models\Schedule; // Make sure to import the Schedule model
use App\Policies\NotePolicy;
use App\Policies\SchedulePolicy; // Import the SchedulePolicy
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Note::class => NotePolicy::class,
        Schedule::class => SchedulePolicy::class, // Register SchedulePolicy
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Optionally, you can define additional gates here
    }
}
