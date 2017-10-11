<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MedicationApiTest extends TestCase
{
    use MakeMedicationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMedication()
    {
        $medication = $this->fakeMedicationData();
        $this->json('POST', '/api/v1/medications', $medication);

        $this->assertApiResponse($medication);
    }

    /**
     * @test
     */
    public function testReadMedication()
    {
        $medication = $this->makeMedication();
        $this->json('GET', '/api/v1/medications/'.$medication->id);

        $this->assertApiResponse($medication->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMedication()
    {
        $medication = $this->makeMedication();
        $editedMedication = $this->fakeMedicationData();

        $this->json('PUT', '/api/v1/medications/'.$medication->id, $editedMedication);

        $this->assertApiResponse($editedMedication);
    }

    /**
     * @test
     */
    public function testDeleteMedication()
    {
        $medication = $this->makeMedication();
        $this->json('DELETE', '/api/v1/medications/'.$medication->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/medications/'.$medication->id);

        $this->assertResponseStatus(404);
    }
}
