<?php

namespace App\Repositories;

use App\Models\Schedule;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ScheduleRepository
 * @package App\Repositories
 * @version October 11, 2017, 10:00 pm UTC
 *
 * @method Schedule findWithoutFail($id, $columns = ['*'])
 * @method Schedule find($id, $columns = ['*'])
 * @method Schedule first($columns = ['*'])
*/
class ScheduleRepository extends BaseRepository
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
        return Schedule::class;
    }
}
