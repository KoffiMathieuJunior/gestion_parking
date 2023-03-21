<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gardien extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'nom','prenoms', 'parking_id', 'proprietaire_id'
    ];
    protected $primaryKey = 'id';
}
