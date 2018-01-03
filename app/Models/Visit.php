<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Visit
 * @package App\Models
 * @version October 11, 2017, 10:06 pm UTC
 *
 * @property integer patient_id
 * @property date date
 * @property integer user_id
 */
class Visit extends Model
{
    use SoftDeletes;

    public $table = 'visits';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'patient_id',
        'date',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'patient_id' => 'integer',
        'date' => 'date',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    
    public function assessments(){
        return $this->belongsToMany('App\Models\Assessment')->withPivot('value');
    }
    
    public function schedules(){
        return $this->belongsToMany('App\Models\Schedule')->withPivot('time');
    }
    
    public function medications(){
        return $this->belongsToMany('App\Models\Medication');
    }
    
    public function supplements(){
        return $this->belongsToMany('App\Models\Supplement');
    }

    //sinhgular since its a 1:M relationship
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }        
    
}
