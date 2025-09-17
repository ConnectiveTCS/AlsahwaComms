<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['subject', 'body', 'sender_id'];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipients() {
        return $this->belongsToMany(User::class, 'message_user', 'message_id', 'recipient_id')
                    ->withPivot('is_read');
    }

    public function attachments() {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
