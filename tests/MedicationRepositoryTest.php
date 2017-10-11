<?php

use App\Models\Medication;
use App\Repositories\MedicationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MedicationRepositoryTest extends TestCase
{
    use MakeMedicationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MedicationRepository
     */
    protected $medicationRepo;

    public function setUp()
    {
        parent::setUp();
        $this->medicationRepo = App::make(MedicationRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMedication()
    {
        $medication = $this->fakeMedicationData();
        $createdMedication = $this->medicationRepo->create($medication);
        $createdMedication = $createdMedication->toArray();
        $this->assertArrayHasKey('id', $createdMedication);
        $this->assertNotNull($createdMedication['id'], 'Created Medication must have id specified');
        $this->assertNotNull(Medication::find($createdMedication['id']), 'Medication with given id must be in DB');
        $this->assertModelData($medication, $createdMedication);
    }

    /**
     * @test read
     */
    public function testReadMedication()
    {
        $medication = $this->makeMedication();
        $dbMedication = $this->medicationRepo->find($medication->id);
        $dbMedication = $dbMedication->toArray();
        $this->assertModelData($medication->toArray(), $dbMedication);
    }

    /**
     * @test update
     */
    public function testUpdateMedication()
    {
        $medication = $this->makeMedication();
        $fakeMedication = $this->fakeMedicationData();
        $updatedMedication = $this->medicationRepo->update($fakeMedication, $medication->id);
        $this->assertModelData($fakeMedication, $updatedMedication->toArray());
        $dbMedication = $this->medicationRepo->find($medication->id);
        $this->assertModelData($fakeMedication, $dbMedication->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMedication()
    {
        $medication = $this->makeMedication();
        $resp = $this->medicationRepo->delete($medication->id);
        $this->assertTrue($resp);
        $this->assertNull(Medication::find($medication->id), 'Medication should not exist in DB');
    }
}
