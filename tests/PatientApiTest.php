<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PatientApiTest extends TestCase
{
    use MakePatientTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePatient()
    {
        $patient = $this->fakePatientData();
        $this->json('POST', '/api/v1/patients', $patient);

        $this->assertApiResponse($patient);
    }

    /**
     * @test
     */
    public function testReadPatient()
    {
        $patient = $this->makePatient();
        $this->json('GET', '/api/v1/patients/'.$patient->id);

        $this->assertApiResponse($patient->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePatient()
    {
        $patient = $this->makePatient();
        $editedPatient = $this->fakePatientData();

        $this->json('PUT', '/api/v1/patients/'.$patient->id, $editedPatient);

        $this->assertApiResponse($editedPatient);
    }

    /**
     * @test
     */
    public function testDeletePatient()
    {
        $patient = $this->makePatient();
        $this->json('DELETE', '/api/v1/patients/'.$patient->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/patients/'.$patient->id);

        $this->assertResponseStatus(404);
    }
}
