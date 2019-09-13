<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $primaryKey = 'idoffres';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre','resume','description','idtypes_offres'
    ];
    

    public static function scopeNonPostuler($query,$idusers){

        return $query->leftJoin('candidatures', 'offres.idoffres', '=', 'candidatures.idoffres')
                        ->whereRaw('candidatures.idoffres is NULL')
                        ->orWhere('candidatures.idusers','!=',$idusers);
                        

    }
}
