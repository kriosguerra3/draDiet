<?php

use Faker\Factory as Faker;
use App\Models\Habit;
use App\Repositories\HabitRepository;

trait MakeHabitTrait
{
    /**
     * Create fake instance of Habit and save it in database
     *
     * @param array $habitFields
     * @return Habit
     */
    public function makeHabit($habitFields = [])
    {
        /** @var HabitRepository $habitRepo */
        $habitRepo = App::make(HabitRepository::class);
        $theme = $this->fakeHabitData($habitFields);
        return $habitRepo->create($theme);
    }

    /**
     * Get fake instance of Habit
     *
     * @param array $habitFields
     * @return Habit
     */
    public function fakeHabit($habitFields = [])
    {
        return new Habit($this->fakeHabitData($habitFields));
    }

    /**
     * Get fake data of Habit
     *
     * @param array $postFields
     * @return array
     */
    public function fakeHabitData($habitFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $habitFields);
    }
}
