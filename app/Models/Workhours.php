<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workhours extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'gebruiker_id',
        'datum',
        'start_tijd',
        'eind_tijd',
        'pauze',
        'vrije_dag',
        'taken',
        'bijzonderheden',
        'gewerkte_uren',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
