<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 
        'libelle',
        'host',
        'ip',
        'username',
        'mot_passe', 
        'config', 
        'niveaux_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'gateway';
}
