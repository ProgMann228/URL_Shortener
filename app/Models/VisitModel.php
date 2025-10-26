<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitModel extends Model
{
    protected $table = 'url_visit';
    public $timestamps = false;

    protected $fillable = [
        'url_id',
        'ip',
        'user_agent',
        'visited_at'
    ];
    protected $casts = [
        'visited_at' => 'datetime'
    ];

}
