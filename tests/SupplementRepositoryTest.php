<?php

use App\Models\Supplement;
use App\Repositories\SupplementRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SupplementRepositoryTest extends TestCase
{
    use MakeSupplementTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SupplementRepository
     */
    protected $supplementRepo;

    public function setUp()
    {
        parent::setUp();
        $this->supplementRepo = App::make(SupplementRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSupplement()
    {
        $supplement = $this->fakeSupplementData();
        $createdSupplement = $this->supplementRepo->create($supplement);
        $createdSupplement = $createdSupplement->toArray();
        $this->assertArrayHasKey('id', $createdSupplement);
        $this->assertNotNull($createdSupplement['id'], 'Created Supplement must have id specified');
        $this->assertNotNull(Supplement::find($createdSupplement['id']), 'Supplement with given id must be in DB');
        $this->assertModelData($supplement, $createdSupplement);
    }

    /**
     * @test read
     */
    public function testReadSupplement()
    {
        $supplement = $this->makeSupplement();
        $dbSupplement = $this->supplementRepo->find($supplement->id);
        $dbSupplement = $dbSupplement->toArray();
        $this->assertModelData($supplement->toArray(), $dbSupplement);
    }

    /**
     * @test update
     */
    public function testUpdateSupplement()
    {
        $supplement = $this->makeSupplement();
        $fakeSupplement = $this->fakeSupplementData();
        $updatedSupplement = $this->supplementRepo->update($fakeSupplement, $supplement->id);
        $this->assertModelData($fakeSupplement, $updatedSupplement->toArray());
        $dbSupplement = $this->supplementRepo->find($supplement->id);
        $this->assertModelData($fakeSupplement, $dbSupplement->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSupplement()
    {
        $supplement = $this->makeSupplement();
        $resp = $this->supplementRepo->delete($supplement->id);
        $this->assertTrue($resp);
        $this->assertNull(Supplement::find($supplement->id), 'Supplement should not exist in DB');
    }
}
