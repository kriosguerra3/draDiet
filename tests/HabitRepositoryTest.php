<?php

use App\Models\Habit;
use App\Repositories\HabitRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HabitRepositoryTest extends TestCase
{
    use MakeHabitTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HabitRepository
     */
    protected $habitRepo;

    public function setUp()
    {
        parent::setUp();
        $this->habitRepo = App::make(HabitRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateHabit()
    {
        $habit = $this->fakeHabitData();
        $createdHabit = $this->habitRepo->create($habit);
        $createdHabit = $createdHabit->toArray();
        $this->assertArrayHasKey('id', $createdHabit);
        $this->assertNotNull($createdHabit['id'], 'Created Habit must have id specified');
        $this->assertNotNull(Habit::find($createdHabit['id']), 'Habit with given id must be in DB');
        $this->assertModelData($habit, $createdHabit);
    }

    /**
     * @test read
     */
    public function testReadHabit()
    {
        $habit = $this->makeHabit();
        $dbHabit = $this->habitRepo->find($habit->id);
        $dbHabit = $dbHabit->toArray();
        $this->assertModelData($habit->toArray(), $dbHabit);
    }

    /**
     * @test update
     */
    public function testUpdateHabit()
    {
        $habit = $this->makeHabit();
        $fakeHabit = $this->fakeHabitData();
        $updatedHabit = $this->habitRepo->update($fakeHabit, $habit->id);
        $this->assertModelData($fakeHabit, $updatedHabit->toArray());
        $dbHabit = $this->habitRepo->find($habit->id);
        $this->assertModelData($fakeHabit, $dbHabit->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteHabit()
    {
        $habit = $this->makeHabit();
        $resp = $this->habitRepo->delete($habit->id);
        $this->assertTrue($resp);
        $this->assertNull(Habit::find($habit->id), 'Habit should not exist in DB');
    }
}
