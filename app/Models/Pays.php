<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'code', 'libelle', 'flags', 'indicatif', 'language', 'language_code'
    ];
    protected $primaryKey = 'id';

}
