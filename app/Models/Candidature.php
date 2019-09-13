<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $primaryKey = 'idcandidatures';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idusers', 'idoffres',
    ];

    public static function aPostuler($idoffres,$idusers){
        return self::where('idoffres',$idoffres)->where('idusers',$idusers)->exists();
    }
    
    public static function scopeJoinUser($query){

        return $query->join('users','users.idusers','=','candidatures.idusers');               
    }
    public static function scopeJoinOffre($query){

        return $query->join('offres','offres.idoffres','=','candidatures.idoffres');               
    }

    public static function scopeNonAdmi($query){

        return $query->leftJoin('formations', 'candidatures.idcandidatures', '=', 'formations.idcandidatures')
                        ->whereRaw('(formations.idcandidatures is NULL)');
                        

    }
}
