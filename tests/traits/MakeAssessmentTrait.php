<?php

use Faker\Factory as Faker;
use App\Models\Assessment;
use App\Repositories\AssessmentRepository;

trait MakeAssessmentTrait
{
    /**
     * Create fake instance of Assessment and save it in database
     *
     * @param array $assessmentFields
     * @return Assessment
     */
    public function makeAssessment($assessmentFields = [])
    {
        /** @var AssessmentRepository $assessmentRepo */
        $assessmentRepo = App::make(AssessmentRepository::class);
        $theme = $this->fakeAssessmentData($assessmentFields);
        return $assessmentRepo->create($theme);
    }

    /**
     * Get fake instance of Assessment
     *
     * @param array $assessmentFields
     * @return Assessment
     */
    public function fakeAssessment($assessmentFields = [])
    {
        return new Assessment($this->fakeAssessmentData($assessmentFields));
    }

    /**
     * Get fake data of Assessment
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAssessmentData($assessmentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $assessmentFields);
    }
}
