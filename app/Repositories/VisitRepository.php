<?php

namespace App\Repositories;

use App\Models\Visit;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class VisitRepository
 * @package App\Repositories
 * @version October 11, 2017, 10:06 pm UTC
 *
 * @method Visit findWithoutFail($id, $columns = ['*'])
 * @method Visit find($id, $columns = ['*'])
 * @method Visit first($columns = ['*'])
*/
class VisitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_id',
        'date',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Visit::class;
    }
}
