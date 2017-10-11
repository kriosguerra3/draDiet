<?php

namespace App\Repositories;

use App\Models\Habit;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HabitRepository
 * @package App\Repositories
 * @version October 11, 2017, 9:50 pm UTC
 *
 * @method Habit findWithoutFail($id, $columns = ['*'])
 * @method Habit find($id, $columns = ['*'])
 * @method Habit first($columns = ['*'])
*/
class HabitRepository extends BaseRepository
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
        return Habit::class;
    }
}
