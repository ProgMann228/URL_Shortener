<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class URLModel extends Model
{
    protected $table = 'links';
    protected $fillable = [
        'original_url',
        'short_url',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
