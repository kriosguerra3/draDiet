<?php

namespace App\Repositories;

use App\Models\Exercise;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ExerciseRepository
 * @package App\Repositories
 * @version October 11, 2017, 9:32 pm UTC
 *
 * @method Exercise findWithoutFail($id, $columns = ['*'])
 * @method Exercise find($id, $columns = ['*'])
 * @method Exercise first($columns = ['*'])
*/
class ExerciseRepository extends BaseRepository
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
        return Exercise::class;
    }
}
