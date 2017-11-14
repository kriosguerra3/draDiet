<?php

namespace App\Repositories;

use App\Models\Malaise;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MalaiseRepository
 * @package App\Repositories
 * @version November 14, 2017, 8:25 pm UTC
 *
 * @method Malaise findWithoutFail($id, $columns = ['*'])
 * @method Malaise find($id, $columns = ['*'])
 * @method Malaise first($columns = ['*'])
*/
class MalaiseRepository extends BaseRepository
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
        return Malaise::class;
    }
}
