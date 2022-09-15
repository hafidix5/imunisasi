<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class anak extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'anaks';

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
    protected $fillable = ['id', 'nama', 'tgl_lahir', 'jenis_kelamin', 'ibus_id'];

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
     * Get the Ibu for this model.
     *
     * @return App\Models\Ibu
     */
    public function Ibu()
    {
        return $this->belongsTo('App\Models\ibu', 'ibus_id', 'id');
    }

    /**
     * Get the jadwalImunisasi for this model.
     *
     * @return App\Models\JadwalImunisasi
     */
    public function jadwalImunisasi()
    {
        return $this->hasOne('App\Models\jadwal_imunisasi', 'anaks_id', 'id');
    }

    /**
     * Set the tgl_lahir.
     *
     * @param  string  $value
     * @return void
     */
    /* public function setTglLahirAttribute($value)
    {
        $this->attributes['tgl_lahir'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    } */

    /**
     * Get tgl_lahir in array format
     *
     * @param  string  $value
     * @return array
     */
    /*   public function getTglLahirAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }
 */
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
