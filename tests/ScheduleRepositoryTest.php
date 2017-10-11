<?php

use App\Models\Schedule;
use App\Repositories\ScheduleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScheduleRepositoryTest extends TestCase
{
    use MakeScheduleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ScheduleRepository
     */
    protected $scheduleRepo;

    public function setUp()
    {
        parent::setUp();
        $this->scheduleRepo = App::make(ScheduleRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSchedule()
    {
        $schedule = $this->fakeScheduleData();
        $createdSchedule = $this->scheduleRepo->create($schedule);
        $createdSchedule = $createdSchedule->toArray();
        $this->assertArrayHasKey('id', $createdSchedule);
        $this->assertNotNull($createdSchedule['id'], 'Created Schedule must have id specified');
        $this->assertNotNull(Schedule::find($createdSchedule['id']), 'Schedule with given id must be in DB');
        $this->assertModelData($schedule, $createdSchedule);
    }

    /**
     * @test read
     */
    public function testReadSchedule()
    {
        $schedule = $this->makeSchedule();
        $dbSchedule = $this->scheduleRepo->find($schedule->id);
        $dbSchedule = $dbSchedule->toArray();
        $this->assertModelData($schedule->toArray(), $dbSchedule);
    }

    /**
     * @test update
     */
    public function testUpdateSchedule()
    {
        $schedule = $this->makeSchedule();
        $fakeSchedule = $this->fakeScheduleData();
        $updatedSchedule = $this->scheduleRepo->update($fakeSchedule, $schedule->id);
        $this->assertModelData($fakeSchedule, $updatedSchedule->toArray());
        $dbSchedule = $this->scheduleRepo->find($schedule->id);
        $this->assertModelData($fakeSchedule, $dbSchedule->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSchedule()
    {
        $schedule = $this->makeSchedule();
        $resp = $this->scheduleRepo->delete($schedule->id);
        $this->assertTrue($resp);
        $this->assertNull(Schedule::find($schedule->id), 'Schedule should not exist in DB');
    }
}
