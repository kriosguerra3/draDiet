<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Patient
 * @package App\Models
 * @version October 11, 2017, 9:56 pm UTC
 *
 * @property string name
 * @property string last_name
 * @property string gender
 * @property date birthdate
 * @property string phone_number
 * @property integer user_id
 */
class Patient extends Model
{
    use SoftDeletes;

    public $table = 'patients';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    
    protected $dates = [
        'birthdate',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public $fillable = [
        'name',
        'last_name',
        'gender',
        'birthdate',
        'phone_number',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'last_name' => 'string',
        'gender' => 'string',
        'birthdate' => 'date',
        'phone_number' => 'string',
        'user_id' => 'integer'
    ];
    

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    
    public function age() {
        return $this->birthdate->diffInYears(\Carbon\Carbon::now());
    }

    
}
