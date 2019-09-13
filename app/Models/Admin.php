<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'postnom', 'prenom', 'password',
    ];

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

    protected $primaryKey = 'idadmins';

    protected static function boot(){
        parent::boot();

        static::creating(function($user){
           $user->pseudo = self::pseudoUnique(str_slug($user->prenom, $separator = '-'));
        });
    }


        // Génération de pseudo unique
    private static function pseudoUnique($pseudo){
        if(self::where('pseudo',$pseudo)->first()){
            $complement  = random_int(1, 100);
            $pseudo = $pseudo.$complement;
            return self::pseudoUnique($pseudo);
        }

        return $pseudo;
    }
}
