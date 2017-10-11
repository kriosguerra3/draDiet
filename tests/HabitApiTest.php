<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HabitApiTest extends TestCase
{
    use MakeHabitTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateHabit()
    {
        $habit = $this->fakeHabitData();
        $this->json('POST', '/api/v1/habits', $habit);

        $this->assertApiResponse($habit);
    }

    /**
     * @test
     */
    public function testReadHabit()
    {
        $habit = $this->makeHabit();
        $this->json('GET', '/api/v1/habits/'.$habit->id);

        $this->assertApiResponse($habit->toArray());
    }

    /**
     * @test
     */
    public function testUpdateHabit()
    {
        $habit = $this->makeHabit();
        $editedHabit = $this->fakeHabitData();

        $this->json('PUT', '/api/v1/habits/'.$habit->id, $editedHabit);

        $this->assertApiResponse($editedHabit);
    }

    /**
     * @test
     */
    public function testDeleteHabit()
    {
        $habit = $this->makeHabit();
        $this->json('DELETE', '/api/v1/habits/'.$habit->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/habits/'.$habit->id);

        $this->assertResponseStatus(404);
    }
}
