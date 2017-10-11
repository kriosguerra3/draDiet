<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExerciseApiTest extends TestCase
{
    use MakeExerciseTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateExercise()
    {
        $exercise = $this->fakeExerciseData();
        $this->json('POST', '/api/v1/exercises', $exercise);

        $this->assertApiResponse($exercise);
    }

    /**
     * @test
     */
    public function testReadExercise()
    {
        $exercise = $this->makeExercise();
        $this->json('GET', '/api/v1/exercises/'.$exercise->id);

        $this->assertApiResponse($exercise->toArray());
    }

    /**
     * @test
     */
    public function testUpdateExercise()
    {
        $exercise = $this->makeExercise();
        $editedExercise = $this->fakeExerciseData();

        $this->json('PUT', '/api/v1/exercises/'.$exercise->id, $editedExercise);

        $this->assertApiResponse($editedExercise);
    }

    /**
     * @test
     */
    public function testDeleteExercise()
    {
        $exercise = $this->makeExercise();
        $this->json('DELETE', '/api/v1/exercises/'.$exercise->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/exercises/'.$exercise->id);

        $this->assertResponseStatus(404);
    }
}
