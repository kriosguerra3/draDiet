<?php

namespace App\Repositories;

use App\Models\Medication;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MedicationRepository
 * @package App\Repositories
 * @version October 11, 2017, 9:54 pm UTC
 *
 * @method Medication findWithoutFail($id, $columns = ['*'])
 * @method Medication find($id, $columns = ['*'])
 * @method Medication first($columns = ['*'])
*/
class MedicationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'dose'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Medication::class;
    }
}
