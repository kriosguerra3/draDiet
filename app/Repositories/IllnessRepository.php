<?php

namespace App\Repositories;

use App\Models\Illness;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class IllnessRepository
 * @package App\Repositories
 * @version October 11, 2017, 9:53 pm UTC
 *
 * @method Illness findWithoutFail($id, $columns = ['*'])
 * @method Illness find($id, $columns = ['*'])
 * @method Illness first($columns = ['*'])
*/
class IllnessRepository extends BaseRepository
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
        return Illness::class;
    }
}
