<?php

use App\Models\Illness;
use App\Repositories\IllnessRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IllnessRepositoryTest extends TestCase
{
    use MakeIllnessTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var IllnessRepository
     */
    protected $illnessRepo;

    public function setUp()
    {
        parent::setUp();
        $this->illnessRepo = App::make(IllnessRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateIllness()
    {
        $illness = $this->fakeIllnessData();
        $createdIllness = $this->illnessRepo->create($illness);
        $createdIllness = $createdIllness->toArray();
        $this->assertArrayHasKey('id', $createdIllness);
        $this->assertNotNull($createdIllness['id'], 'Created Illness must have id specified');
        $this->assertNotNull(Illness::find($createdIllness['id']), 'Illness with given id must be in DB');
        $this->assertModelData($illness, $createdIllness);
    }

    /**
     * @test read
     */
    public function testReadIllness()
    {
        $illness = $this->makeIllness();
        $dbIllness = $this->illnessRepo->find($illness->id);
        $dbIllness = $dbIllness->toArray();
        $this->assertModelData($illness->toArray(), $dbIllness);
    }

    /**
     * @test update
     */
    public function testUpdateIllness()
    {
        $illness = $this->makeIllness();
        $fakeIllness = $this->fakeIllnessData();
        $updatedIllness = $this->illnessRepo->update($fakeIllness, $illness->id);
        $this->assertModelData($fakeIllness, $updatedIllness->toArray());
        $dbIllness = $this->illnessRepo->find($illness->id);
        $this->assertModelData($fakeIllness, $dbIllness->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteIllness()
    {
        $illness = $this->makeIllness();
        $resp = $this->illnessRepo->delete($illness->id);
        $this->assertTrue($resp);
        $this->assertNull(Illness::find($illness->id), 'Illness should not exist in DB');
    }
}
