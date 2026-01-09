<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'read',
        'reply',
    ];

    protected function casts(): array
    {
        return [
            'read' => 'boolean',
        ];
    }
}
