<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VotingToken extends Model
{
    protected $fillable = ['token', 'used', 'paslon_id', 'used_at'];

    public function paslon()
    {
        return $this->belongsTo(Paslon::class);
    }
}
