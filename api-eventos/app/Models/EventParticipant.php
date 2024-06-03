<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EventParticipant extends Pivot
{
    public function document(){
        return $this->hasOne(Document::class);
    }

    public function participantType(){
        return $this->hasOne(ParticipantType::class);
    }


    
}
