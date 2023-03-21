<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'date_reservation', 'place_stationnement_id', 'duree_reservation','formule_id', 'heure_arrive', 'heure_depart',  'client_id', 'mode_paiement_id'
    ];
    protected $primaryKey = 'id';
}
