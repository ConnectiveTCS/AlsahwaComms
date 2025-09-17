<?php

namespace App\Policies;

use App\Models\Announcement;
use App\Models\User;

class AnnouncementPolicy
{
    // Only teacher, hod, or admin can update their own announcement
    public function update(User $user, Announcement $announcement): bool
    {
        return ($user->id === $announcement->sender_id)
            && (
                $user->roles->contains('name', 'teacher') ||
                $user->roles->contains('name', 'hod') ||
                $user->roles->contains('name', 'admin')
            );
    }

    // Only admin can delete any announcement
    public function delete(User $user, Announcement $announcement): bool
    {
        return $user->roles->contains('name', 'admin');
    }

    // Anyone can view announcements
    public function view(User $user, Announcement $announcement): bool
    {
        return true;
    }

    // Only teacher, hod, or admin can create announcements
    public function create(User $user): bool
    {
        return $user->roles->contains('name', 'teacher')
            || $user->roles->contains('name', 'hod')
            || $user->roles->contains('name', 'admin');
    }
}
