<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mode_Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'libelle'
    ];
    protected $primaryKey = 'id';
    protected $table = 'mode_paiements';
}
