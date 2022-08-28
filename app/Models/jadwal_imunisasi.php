<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jadwal_imunisasi extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jadwal_imunisasis';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'anaks_id';
    protected $keyType = 'string';
    public $incrementing = false;


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'jenis_imunisasis_id',
                  'tempat',
                  'tanggal',
                  'waktu_pemberian',
                  'berat_badan',
                  'panjang_badan',
                  'suhu',
                  'status',
                  'keterangan',
                  'users_id'
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
     * Get the Anak for this model.
     *
     * @return App\Models\Anak
     */
    public function Anak()
    {
        return $this->belongsTo('App\Models\Anak','anaks_id','id');
    }

    /**
     * Get the JenisImunisasi for this model.
     *
     * @return App\Models\JenisImunisasi
     */
    public function JenisImunisasi()
    {
        return $this->belongsTo('App\Models\JenisImunisasi','jenis_imunisasis_id','id');
    }

    /**
     * Get the User for this model.
     *
     * @return App\Models\User
     */
    public function User()
    {
        return $this->belongsTo('App\Models\User','users_id','id');
    }

    /**
     * Set the tanggal.
     *
     * @param  string  $value
     * @return void
     */
    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Set the waktu_pemberian.
     *
     * @param  string  $value
     * @return void
     */
    public function setWaktuPemberianAttribute($value)
    {
        $this->attributes['waktu_pemberian'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Get tanggal in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getTanggalAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get waktu_pemberian in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getWaktuPemberianAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
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
