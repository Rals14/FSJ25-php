<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class pedidos extends Model
{
    //
    protected $fillable = ['producto', 'cantidad', 'total', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
