<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'libelle','host', 'mot_passe', 'parking_id'
    ];
    protected $primaryKey = 'id';
}
