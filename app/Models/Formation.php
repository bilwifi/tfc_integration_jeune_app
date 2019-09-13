<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $primaryKey = 'idformations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idcandidatures','idusers','idoffres' 
    ];
    public static function scopeJoinCandidature($query){

        return $query->join('candidatures','candidatures.idcandidatures','=','formations.idcandidatures');               
    }
    public static function scopeJoinOffre($query){

        return $query->JoinCandidature()
        				->join('offres','offres.idoffres','=','candidatures.idoffres');               
    }
}
