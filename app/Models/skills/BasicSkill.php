<?php

namespace App\Models\skills;

use App\Models\characters\Character;
use App\Models\characters\CharacterClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BasicSkill extends Model
{

    use HasFactory;
    protected $fillable = ['name', 'description', 'first_level_cost', 'second_level_cost', 'character_class_id'];

    public function characterClass()
    {
        return $this->belongsTo(CharacterClass::class);
    }

    public function characters()
    {
        $this->belongsToMany(Character::class, 'character_basic_skill')
            ->withPivot('nodes_skilled')
            ->withTimestamps();
    }
}
