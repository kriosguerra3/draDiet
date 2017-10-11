<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IllnessApiTest extends TestCase
{
    use MakeIllnessTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateIllness()
    {
        $illness = $this->fakeIllnessData();
        $this->json('POST', '/api/v1/illnesses', $illness);

        $this->assertApiResponse($illness);
    }

    /**
     * @test
     */
    public function testReadIllness()
    {
        $illness = $this->makeIllness();
        $this->json('GET', '/api/v1/illnesses/'.$illness->id);

        $this->assertApiResponse($illness->toArray());
    }

    /**
     * @test
     */
    public function testUpdateIllness()
    {
        $illness = $this->makeIllness();
        $editedIllness = $this->fakeIllnessData();

        $this->json('PUT', '/api/v1/illnesses/'.$illness->id, $editedIllness);

        $this->assertApiResponse($editedIllness);
    }

    /**
     * @test
     */
    public function testDeleteIllness()
    {
        $illness = $this->makeIllness();
        $this->json('DELETE', '/api/v1/illnesses/'.$illness->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/illnesses/'.$illness->id);

        $this->assertResponseStatus(404);
    }
}
