<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // General role-based gate
        Gate::define('is-role', function (User $user, string $role) {
            return $user->roles->contains('name', $role);
        });

        // Example: Only teachers and HODs can create announcements
        Gate::define('create-announcement', function (User $user) {
            return $user->roles->contains('name', 'teacher')
                || $user->roles->contains('name', 'hod')
                || $user->roles->contains('name', 'admin');
        });

        // Everyone can send messages (teachers, students, parents, hods, admins)
        Gate::define('send-message', function (User $user) {
            return $user->roles->pluck('name')->intersect([
                'teacher',
                'student',
                'parent',
                'hod',
                'admin'
            ])->isNotEmpty();
        });
    }
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Message::class => \App\Policies\MessagePolicy::class,
        \App\Models\Announcement::class => \App\Policies\AnnouncementPolicy::class,
    ];
}
