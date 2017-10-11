<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScheduleApiTest extends TestCase
{
    use MakeScheduleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSchedule()
    {
        $schedule = $this->fakeScheduleData();
        $this->json('POST', '/api/v1/schedules', $schedule);

        $this->assertApiResponse($schedule);
    }

    /**
     * @test
     */
    public function testReadSchedule()
    {
        $schedule = $this->makeSchedule();
        $this->json('GET', '/api/v1/schedules/'.$schedule->id);

        $this->assertApiResponse($schedule->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSchedule()
    {
        $schedule = $this->makeSchedule();
        $editedSchedule = $this->fakeScheduleData();

        $this->json('PUT', '/api/v1/schedules/'.$schedule->id, $editedSchedule);

        $this->assertApiResponse($editedSchedule);
    }

    /**
     * @test
     */
    public function testDeleteSchedule()
    {
        $schedule = $this->makeSchedule();
        $this->json('DELETE', '/api/v1/schedules/'.$schedule->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/schedules/'.$schedule->id);

        $this->assertResponseStatus(404);
    }
}
