<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proprietaire extends Model
{
    use HasFactory;
    protected $fillable = [
       'libelle', 'contact', 'email', 'date_inscription', 'logo', 'type_proprietaire_id'
    ];
    protected $primaryKey = 'id';
}
