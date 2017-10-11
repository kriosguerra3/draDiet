<?php

use Faker\Factory as Faker;
use App\Models\Exercise;
use App\Repositories\ExerciseRepository;

trait MakeExerciseTrait
{
    /**
     * Create fake instance of Exercise and save it in database
     *
     * @param array $exerciseFields
     * @return Exercise
     */
    public function makeExercise($exerciseFields = [])
    {
        /** @var ExerciseRepository $exerciseRepo */
        $exerciseRepo = App::make(ExerciseRepository::class);
        $theme = $this->fakeExerciseData($exerciseFields);
        return $exerciseRepo->create($theme);
    }

    /**
     * Get fake instance of Exercise
     *
     * @param array $exerciseFields
     * @return Exercise
     */
    public function fakeExercise($exerciseFields = [])
    {
        return new Exercise($this->fakeExerciseData($exerciseFields));
    }

    /**
     * Get fake data of Exercise
     *
     * @param array $postFields
     * @return array
     */
    public function fakeExerciseData($exerciseFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $exerciseFields);
    }
}
