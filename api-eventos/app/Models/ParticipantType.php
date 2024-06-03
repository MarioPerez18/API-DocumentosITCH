<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantType extends Model
{
    use HasFactory;

    public function event_participant(){
        return $this->belongsTo(EventParticipant::class);
    }
}
