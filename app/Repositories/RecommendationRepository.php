<?php

namespace App\Repositories;

use App\Models\Recommendation;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RecommendationRepository
 * @package App\Repositories
 * @version November 14, 2017, 8:27 pm UTC
 *
 * @method Recommendation findWithoutFail($id, $columns = ['*'])
 * @method Recommendation find($id, $columns = ['*'])
 * @method Recommendation first($columns = ['*'])
*/
class RecommendationRepository extends BaseRepository
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
        return Recommendation::class;
    }
}
