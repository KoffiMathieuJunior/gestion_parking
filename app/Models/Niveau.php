<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'numero', 'capacite', 'parking_id'];
    protected $primaryKey = 'id';
}
