<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Allergy
 * @package App\Models
 * @version October 11, 2017, 9:47 pm UTC
 *
 * @property string name
 */
class Allergy extends Model
{
    use SoftDeletes;
    
    public $table = 'allergies';
    
    public $fillable = [
        'patient_id'
    ];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    
    public function allergiable()
    {
        return $this->morphTo();
    }
}
