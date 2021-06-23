<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceXApiModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'capsule_serial',
        'capsule_id',
        'status',
        'original_launch',
        'original_launch_unix',
        'missions',
        'landings',
        'type',
        'details',
        'reuse_count',
    ];
}
