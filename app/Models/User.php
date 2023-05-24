<?php

namespace App\Models;
// use Laravel\Passport\HasApiTokens;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends  Authenticatable implements MustVerifyEmail
{
    use HasFactory, 
    HasApiTokens,
    Notifiable ;

    protected $fillable = [
        'nom', 
        'prenoms', 
        'login', 
        'password', 
        'contact',
        'email',
        // 'compagne_id',
        // 'proprietaire_id',
        'type_user_id',
        'statut_id',
        'image',
        'sexe',
    ];
    protected $primaryKey = 'id';

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * The attribute to use for authentication
     *
     * @var string
     */
    public function getAuthIdentifierName()
    {
        return 'login';
    }

    public function getAuthPassword() { 
        return $this->password; 
    }
}
