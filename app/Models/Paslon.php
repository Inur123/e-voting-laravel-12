<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paslon extends Model
{
    protected $table = 'paslon'; // Correct table name

    protected $fillable = [
        'nomor_urut',
        'nama',
        'gambar',
        'visi_misi',
        'total_pemilih',
    ];

    public function votingTokens()
{
    return $this->hasMany(VotingToken::class);
}

}
