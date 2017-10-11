<?php

use App\Models\Exercise;
use App\Repositories\ExerciseRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExerciseRepositoryTest extends TestCase
{
    use MakeExerciseTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ExerciseRepository
     */
    protected $exerciseRepo;

    public function setUp()
    {
        parent::setUp();
        $this->exerciseRepo = App::make(ExerciseRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateExercise()
    {
        $exercise = $this->fakeExerciseData();
        $createdExercise = $this->exerciseRepo->create($exercise);
        $createdExercise = $createdExercise->toArray();
        $this->assertArrayHasKey('id', $createdExercise);
        $this->assertNotNull($createdExercise['id'], 'Created Exercise must have id specified');
        $this->assertNotNull(Exercise::find($createdExercise['id']), 'Exercise with given id must be in DB');
        $this->assertModelData($exercise, $createdExercise);
    }

    /**
     * @test read
     */
    public function testReadExercise()
    {
        $exercise = $this->makeExercise();
        $dbExercise = $this->exerciseRepo->find($exercise->id);
        $dbExercise = $dbExercise->toArray();
        $this->assertModelData($exercise->toArray(), $dbExercise);
    }

    /**
     * @test update
     */
    public function testUpdateExercise()
    {
        $exercise = $this->makeExercise();
        $fakeExercise = $this->fakeExerciseData();
        $updatedExercise = $this->exerciseRepo->update($fakeExercise, $exercise->id);
        $this->assertModelData($fakeExercise, $updatedExercise->toArray());
        $dbExercise = $this->exerciseRepo->find($exercise->id);
        $this->assertModelData($fakeExercise, $dbExercise->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteExercise()
    {
        $exercise = $this->makeExercise();
        $resp = $this->exerciseRepo->delete($exercise->id);
        $this->assertTrue($resp);
        $this->assertNull(Exercise::find($exercise->id), 'Exercise should not exist in DB');
    }
}
