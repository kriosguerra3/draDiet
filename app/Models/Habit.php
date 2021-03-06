<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Habit
 * @package App\Models
 * @version October 11, 2017, 9:50 pm UTC
 *
 * @property string name
 */
class Habit extends Model
{
    use SoftDeletes;

    public $table = 'habits';
    
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
        
    
    public function medications(){
        return $this->belongsToMany('App\Models\Medication');
    }
    
    public function supplements(){
        return $this->belongsToMany('App\Models\Supplement');
    }
    
    public function visits()
    {
        return $this->morphToMany('App\Models\Visit', 'visitable');
    }

    
}
