<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wilayah_kerjas extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'wilayah_kerjas';

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
            'id',
                  'jenis',
                  'nama'
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
     * Get the ibu for this model.
     *
     * @return App\Models\Ibu
     */
    public function ibu()
    {
        return $this->hasOne('App\Models\ibu','wilayah_kerjas_id','id');
    }

    /**
     * Get the usersWilayah for this model.
     *
     * @return App\Models\UsersWilayah
     */
    public function usersWilayah()
    {
        return $this->hasOne('App\Models\users_wilayahs','wilayah_kerjas_id','id');
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
