<?php

use Faker\Factory as Faker;
use App\Models\Visit;
use App\Repositories\VisitRepository;

trait MakeVisitTrait
{
    /**
     * Create fake instance of Visit and save it in database
     *
     * @param array $visitFields
     * @return Visit
     */
    public function makeVisit($visitFields = [])
    {
        /** @var VisitRepository $visitRepo */
        $visitRepo = App::make(VisitRepository::class);
        $theme = $this->fakeVisitData($visitFields);
        return $visitRepo->create($theme);
    }

    /**
     * Get fake instance of Visit
     *
     * @param array $visitFields
     * @return Visit
     */
    public function fakeVisit($visitFields = [])
    {
        return new Visit($this->fakeVisitData($visitFields));
    }

    /**
     * Get fake data of Visit
     *
     * @param array $postFields
     * @return array
     */
    public function fakeVisitData($visitFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'patient_id' => $fake->randomDigitNotNull,
            'date' => $fake->word,
            'user_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $visitFields);
    }
}
