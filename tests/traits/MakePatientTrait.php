<?php

use Faker\Factory as Faker;
use App\Models\Patient;
use App\Repositories\PatientRepository;

trait MakePatientTrait
{
    /**
     * Create fake instance of Patient and save it in database
     *
     * @param array $patientFields
     * @return Patient
     */
    public function makePatient($patientFields = [])
    {
        /** @var PatientRepository $patientRepo */
        $patientRepo = App::make(PatientRepository::class);
        $theme = $this->fakePatientData($patientFields);
        return $patientRepo->create($theme);
    }

    /**
     * Get fake instance of Patient
     *
     * @param array $patientFields
     * @return Patient
     */
    public function fakePatient($patientFields = [])
    {
        return new Patient($this->fakePatientData($patientFields));
    }

    /**
     * Get fake data of Patient
     *
     * @param array $postFields
     * @return array
     */
    public function fakePatientData($patientFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'last_name' => $fake->word,
            'gender' => $fake->word,
            'birthdate' => $fake->word,
            'phone_number' => $fake->word,
            'user_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $patientFields);
    }
}
