<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
         'matricule',
          'couleur',
          'marque',
          'model',
           'type_vehicule_id',
           'client_id'
    ];

    protected $primaryKey = 'id';

}
