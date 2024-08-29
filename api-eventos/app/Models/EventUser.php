<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EventUser extends Pivot
{
    protected $fillable = [
        'user_id',
        'event_id',
        'participant_type_id'
    ];

    public function document(){
        return $this->hasOne(Document::class);
    }

    public function participantType(){
        return $this->hasOne(ParticipantType::class);
    }
    


    
}
