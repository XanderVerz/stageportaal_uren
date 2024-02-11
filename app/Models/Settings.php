<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'gebruiker_id',
        'start_tijd_standaard',
        'eind_tijd_standaard',
        'pauze',
        'praktijkopleider',
        'stagebegeleider',
    ];
    public function gebruiker()
    {
        return $this->belongsTo(User::class, 'gebruiker_id');
    }
}
