<?php

use Faker\Factory as Faker;
use App\Models\Supplement;
use App\Repositories\SupplementRepository;

trait MakeSupplementTrait
{
    /**
     * Create fake instance of Supplement and save it in database
     *
     * @param array $supplementFields
     * @return Supplement
     */
    public function makeSupplement($supplementFields = [])
    {
        /** @var SupplementRepository $supplementRepo */
        $supplementRepo = App::make(SupplementRepository::class);
        $theme = $this->fakeSupplementData($supplementFields);
        return $supplementRepo->create($theme);
    }

    /**
     * Get fake instance of Supplement
     *
     * @param array $supplementFields
     * @return Supplement
     */
    public function fakeSupplement($supplementFields = [])
    {
        return new Supplement($this->fakeSupplementData($supplementFields));
    }

    /**
     * Get fake data of Supplement
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSupplementData($supplementFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'dose' => $fake->text,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $supplementFields);
    }
}
