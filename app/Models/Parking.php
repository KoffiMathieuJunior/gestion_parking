<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle', 
        'latitude', 
        'longitude',
        'adresse', 
        'heure_ouverture', 
        'heure_fermeture', 
        'capacite_total', 
        'ville_id',
        'jours',
        'proprietaire_id',
    ];
    protected $primaryKey = 'id';
    // protected $table = 'parkings';
}
