<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Malaise
 * @package App\Models
 * @version November 14, 2017, 8:25 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection assessmentVisit
 * @property \Illuminate\Database\Eloquent\Collection foodPatient
 * @property \Illuminate\Database\Eloquent\Collection habitPatient
 * @property \Illuminate\Database\Eloquent\Collection illnessMedication
 * @property \Illuminate\Database\Eloquent\Collection illnessPatient
 * @property \Illuminate\Database\Eloquent\Collection illnessSupplement
 * @property \Illuminate\Database\Eloquent\Collection MalaiseMedication
 * @property \Illuminate\Database\Eloquent\Collection MalaiseSupplement
 * @property string name
 */
class Malaise extends Model
{
    use SoftDeletes;

    public $table = 'malaises';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function malaiseMedications()
    {
        return $this->hasMany(\App\Models\MalaiseMedication::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function malaiseSupplements()
    {
        return $this->hasMany(\App\Models\MalaiseSupplement::class);
    }
}
