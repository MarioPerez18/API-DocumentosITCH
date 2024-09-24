<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantType extends Model
{
    use HasFactory;

    protected $fillable = [
        'participantType'
    ];

    public function event_participant(){
        return $this->belongsTo(EventUser::class);
    }

    public function events(){
        return $this->belongsToMany(Event::class);
    }
}


