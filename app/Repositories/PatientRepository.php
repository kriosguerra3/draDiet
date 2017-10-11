<?php

namespace App\Repositories;

use App\Models\Patient;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PatientRepository
 * @package App\Repositories
 * @version October 11, 2017, 9:56 pm UTC
 *
 * @method Patient findWithoutFail($id, $columns = ['*'])
 * @method Patient find($id, $columns = ['*'])
 * @method Patient first($columns = ['*'])
*/
class PatientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'last_name',
        'gender',
        'birthdate',
        'phone_number',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Patient::class;
    }
}
