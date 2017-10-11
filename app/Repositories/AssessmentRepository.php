<?php

namespace App\Repositories;

use App\Models\Assessment;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AssessmentRepository
 * @package App\Repositories
 * @version October 11, 2017, 9:28 pm UTC
 *
 * @method Assessment findWithoutFail($id, $columns = ['*'])
 * @method Assessment find($id, $columns = ['*'])
 * @method Assessment first($columns = ['*'])
*/
class AssessmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Assessment::class;
    }
}
