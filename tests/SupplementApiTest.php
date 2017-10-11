<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SupplementApiTest extends TestCase
{
    use MakeSupplementTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSupplement()
    {
        $supplement = $this->fakeSupplementData();
        $this->json('POST', '/api/v1/supplements', $supplement);

        $this->assertApiResponse($supplement);
    }

    /**
     * @test
     */
    public function testReadSupplement()
    {
        $supplement = $this->makeSupplement();
        $this->json('GET', '/api/v1/supplements/'.$supplement->id);

        $this->assertApiResponse($supplement->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSupplement()
    {
        $supplement = $this->makeSupplement();
        $editedSupplement = $this->fakeSupplementData();

        $this->json('PUT', '/api/v1/supplements/'.$supplement->id, $editedSupplement);

        $this->assertApiResponse($editedSupplement);
    }

    /**
     * @test
     */
    public function testDeleteSupplement()
    {
        $supplement = $this->makeSupplement();
        $this->json('DELETE', '/api/v1/supplements/'.$supplement->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/supplements/'.$supplement->id);

        $this->assertResponseStatus(404);
    }
}
