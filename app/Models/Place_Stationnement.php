<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place_Stationnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle', 'etat', 'numero', 'type_vehicule_id', 'parking_id', 'capteur_id'
    ];
    protected $primaryKey = 'id';
}
