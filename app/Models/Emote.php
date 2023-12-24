<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emote extends Model
{
    use HasFactory;

    protected $table = 'resources_img';

    protected $fillable = [
        'channel_id',
        'name',
        'tier',
        'type',
        'image'
    ];
}
