<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'prenoms', 'contact','email','compagne_id'
    ];
    protected $primaryKey = 'id';
}
