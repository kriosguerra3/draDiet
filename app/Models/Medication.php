<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Medication
 * @package App\Models
 * @version October 11, 2017, 9:54 pm UTC
 *
 * @property string name
 * @property string dose
 */
class Medication extends Model
{
    use SoftDeletes;

    public $table = 'medications';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'dose'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'dose' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    
    public function allergies()
    {
        return $this->morphMany('\App\Models\Allergy', 'allergiable');
    }

    
}
