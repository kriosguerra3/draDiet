<?php

use Faker\Factory as Faker;
use App\Models\Medication;
use App\Repositories\MedicationRepository;

trait MakeMedicationTrait
{
    /**
     * Create fake instance of Medication and save it in database
     *
     * @param array $medicationFields
     * @return Medication
     */
    public function makeMedication($medicationFields = [])
    {
        /** @var MedicationRepository $medicationRepo */
        $medicationRepo = App::make(MedicationRepository::class);
        $theme = $this->fakeMedicationData($medicationFields);
        return $medicationRepo->create($theme);
    }

    /**
     * Get fake instance of Medication
     *
     * @param array $medicationFields
     * @return Medication
     */
    public function fakeMedication($medicationFields = [])
    {
        return new Medication($this->fakeMedicationData($medicationFields));
    }

    /**
     * Get fake data of Medication
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMedicationData($medicationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'dose' => $fake->text,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $medicationFields);
    }
}
