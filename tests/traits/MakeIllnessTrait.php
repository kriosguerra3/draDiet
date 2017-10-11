<?php

use Faker\Factory as Faker;
use App\Models\Illness;
use App\Repositories\IllnessRepository;

trait MakeIllnessTrait
{
    /**
     * Create fake instance of Illness and save it in database
     *
     * @param array $illnessFields
     * @return Illness
     */
    public function makeIllness($illnessFields = [])
    {
        /** @var IllnessRepository $illnessRepo */
        $illnessRepo = App::make(IllnessRepository::class);
        $theme = $this->fakeIllnessData($illnessFields);
        return $illnessRepo->create($theme);
    }

    /**
     * Get fake instance of Illness
     *
     * @param array $illnessFields
     * @return Illness
     */
    public function fakeIllness($illnessFields = [])
    {
        return new Illness($this->fakeIllnessData($illnessFields));
    }

    /**
     * Get fake data of Illness
     *
     * @param array $postFields
     * @return array
     */
    public function fakeIllnessData($illnessFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $illnessFields);
    }
}
