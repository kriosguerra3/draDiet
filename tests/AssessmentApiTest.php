<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AssessmentApiTest extends TestCase
{
    use MakeAssessmentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAssessment()
    {
        $assessment = $this->fakeAssessmentData();
        $this->json('POST', '/api/v1/assessments', $assessment);

        $this->assertApiResponse($assessment);
    }

    /**
     * @test
     */
    public function testReadAssessment()
    {
        $assessment = $this->makeAssessment();
        $this->json('GET', '/api/v1/assessments/'.$assessment->id);

        $this->assertApiResponse($assessment->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAssessment()
    {
        $assessment = $this->makeAssessment();
        $editedAssessment = $this->fakeAssessmentData();

        $this->json('PUT', '/api/v1/assessments/'.$assessment->id, $editedAssessment);

        $this->assertApiResponse($editedAssessment);
    }

    /**
     * @test
     */
    public function testDeleteAssessment()
    {
        $assessment = $this->makeAssessment();
        $this->json('DELETE', '/api/v1/assessments/'.$assessment->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/assessments/'.$assessment->id);

        $this->assertResponseStatus(404);
    }
}
