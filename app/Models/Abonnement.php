<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Abonnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 
        // 'date_abonnement', 
        'libelle', 
        'date_debut', 
        'date_fin', 
        'client_id', 
        'place_stationnements_id', 
        'type_abonnement_id', 
        'statut', 
       
    ];
    protected $primaryKey = 'id';
}
