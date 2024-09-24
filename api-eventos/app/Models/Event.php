<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'startDate',
        'endDate',
        'nameEvent',
        'description',
        'nameEventUri'
    ];


    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function participant_types(){
        return $this->belongsToMany(ParticipantType::class);
    }
}
