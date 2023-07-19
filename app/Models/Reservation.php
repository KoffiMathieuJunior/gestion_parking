<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code', 
        'place_id', 
        'formule_id', 
        'parkings_id', 
        'statut', 
        'date_depart', 
        'heure_depart',  
        'heure_arrive', 
        'date_arrive', 
        'client_id', 
        'mode_paiement_id'
    ];
    protected $primaryKey = 'id';
}
