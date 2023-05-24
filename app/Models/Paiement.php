<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    
    protected $fillable = [
      'abonnement_id', 'date', 'montant'
    ];
    protected $primaryKey = 'id';

}
