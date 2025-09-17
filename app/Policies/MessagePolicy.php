<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;

class MessagePolicy
{
    // Only sender or admin can delete
    public function delete(User $user, Message $message): bool
    {
        return $user->id === $message->sender_id
            || $user->roles->contains('name', 'admin');
    }

    // Only sender can update/edit message
    public function update(User $user, Message $message): bool
    {
        return $user->id === $message->sender_id;
    }

    // View message → must be sender OR recipient
    public function view(User $user, Message $message): bool
    {
        return $user->id === $message->sender_id
            || $message->recipients->contains($user->id);
    }
    
    // Only sender or recipient can reply
    public function reply(User $user, Message $message): bool
    {
        return $user->id === $message->sender_id
            || $message->recipients->contains($user->id);
    }
}
