<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place_Stationnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle', 'espace', 'numero', 'type_vehicule_id', 'niveaux_id', 'capteur_id', 'abonnement_id', 'statut_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'place_stationnements';
}
