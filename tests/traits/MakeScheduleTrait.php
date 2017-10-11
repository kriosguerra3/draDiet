<?php

use Faker\Factory as Faker;
use App\Models\Schedule;
use App\Repositories\ScheduleRepository;

trait MakeScheduleTrait
{
    /**
     * Create fake instance of Schedule and save it in database
     *
     * @param array $scheduleFields
     * @return Schedule
     */
    public function makeSchedule($scheduleFields = [])
    {
        /** @var ScheduleRepository $scheduleRepo */
        $scheduleRepo = App::make(ScheduleRepository::class);
        $theme = $this->fakeScheduleData($scheduleFields);
        return $scheduleRepo->create($theme);
    }

    /**
     * Get fake instance of Schedule
     *
     * @param array $scheduleFields
     * @return Schedule
     */
    public function fakeSchedule($scheduleFields = [])
    {
        return new Schedule($this->fakeScheduleData($scheduleFields));
    }

    /**
     * Get fake data of Schedule
     *
     * @param array $postFields
     * @return array
     */
    public function fakeScheduleData($scheduleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $scheduleFields);
    }
}
