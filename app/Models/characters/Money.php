<?php

namespace App\Models\characters;

use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    protected $table = 'money';
    protected $fillable = ['gf', 'tt', 'kl', 'mu', 'character_id',];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
