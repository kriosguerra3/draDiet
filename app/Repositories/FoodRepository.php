<?php

namespace App\Repositories;

use App\Models\Food;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FoodRepository
 * @package App\Repositories
 * @version October 11, 2017, 9:47 pm UTC
 *
 * @method Food findWithoutFail($id, $columns = ['*'])
 * @method Food find($id, $columns = ['*'])
 * @method Food first($columns = ['*'])
*/
class FoodRepository extends BaseRepository
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
        return Food::class;
    }
}
