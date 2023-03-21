<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle', 'etat', 'statut_id', 'gateway_id'
    ];
    protected $primaryKey = 'id';
}
