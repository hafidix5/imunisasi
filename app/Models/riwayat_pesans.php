<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class riwayat_pesans extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'riwayat_pesans';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'pesans_id',
                  'ibus_id'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the Pesan for this model.
     *
     * @return App\Models\Pesan
     */
    public function Pesan()
    {
        return $this->belongsTo('App\Models\pesans','pesans_id','id');
    }

    /**
     * Get the Ibu for this model.
     *
     * @return App\Models\Ibu
     */
    public function Ibu()
    {
        return $this->belongsTo('App\Models\Ibu','ibus_id','id');
    }


    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

}
