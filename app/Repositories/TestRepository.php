<?php

namespace App\Repositories;

use App\Models\Test;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TestRepository
 * @package App\Repositories
 * @version November 14, 2017, 8:36 pm UTC
 *
 * @method Test findWithoutFail($id, $columns = ['*'])
 * @method Test find($id, $columns = ['*'])
 * @method Test first($columns = ['*'])
*/
class TestRepository extends BaseRepository
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
        return Test::class;
    }
}
