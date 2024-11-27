<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;


    protected $fillable = [
        'number',
        'generated',
        'delivered',
        'archive',
        'dateGenerated',
        'deliveryDate',
        'encryptedString',
        'cutEncryptedString'
    ];

    

    public function event_participant(){
        return $this->belongsTo(EventUser::class);
    }
}
