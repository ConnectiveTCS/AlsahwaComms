<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['title', 'body', 'sender_id', 'target_role'];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function attachments() {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
