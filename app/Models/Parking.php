<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle', 'latitude', 'longitude','adresse', 'heure_ouverture', 'heure_fermeture', 'compagnie_id'
    ];
    protected $primaryKey = 'id';
}
