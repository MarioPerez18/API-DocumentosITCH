<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = [
        'shortName',
        'longName',
        'longNameUri',
        'institution_type_id'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function institution_type(){
        return $this->belongsTo(InstitutionType::class);
    }

    
}
