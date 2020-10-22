<?php

namespace App;
Use App\User;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
