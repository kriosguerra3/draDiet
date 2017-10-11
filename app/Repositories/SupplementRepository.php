<?php

namespace App\Repositories;

use App\Models\Supplement;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SupplementRepository
 * @package App\Repositories
 * @version October 11, 2017, 10:03 pm UTC
 *
 * @method Supplement findWithoutFail($id, $columns = ['*'])
 * @method Supplement find($id, $columns = ['*'])
 * @method Supplement first($columns = ['*'])
*/
class SupplementRepository extends BaseRepository
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
        return Supplement::class;
    }
}
