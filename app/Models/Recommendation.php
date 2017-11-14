<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Recommendation
 * @package App\Models
 * @version November 14, 2017, 8:27 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection assessmentVisit
 * @property \Illuminate\Database\Eloquent\Collection foodPatient
 * @property \Illuminate\Database\Eloquent\Collection habitPatient
 * @property \Illuminate\Database\Eloquent\Collection illnessMedication
 * @property \Illuminate\Database\Eloquent\Collection illnessPatient
 * @property \Illuminate\Database\Eloquent\Collection illnessSupplement
 * @property \Illuminate\Database\Eloquent\Collection malaiseMedication
 * @property \Illuminate\Database\Eloquent\Collection malaiseSupplement
 * @property string name
 */
class Recommendation extends Model
{
    use SoftDeletes;

    public $table = 'recommendations';
    
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

    
}
