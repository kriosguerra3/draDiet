<?php

use App\Models\Patient;
use App\Repositories\PatientRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PatientRepositoryTest extends TestCase
{
    use MakePatientTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PatientRepository
     */
    protected $patientRepo;

    public function setUp()
    {
        parent::setUp();
        $this->patientRepo = App::make(PatientRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePatient()
    {
        $patient = $this->fakePatientData();
        $createdPatient = $this->patientRepo->create($patient);
        $createdPatient = $createdPatient->toArray();
        $this->assertArrayHasKey('id', $createdPatient);
        $this->assertNotNull($createdPatient['id'], 'Created Patient must have id specified');
        $this->assertNotNull(Patient::find($createdPatient['id']), 'Patient with given id must be in DB');
        $this->assertModelData($patient, $createdPatient);
    }

    /**
     * @test read
     */
    public function testReadPatient()
    {
        $patient = $this->makePatient();
        $dbPatient = $this->patientRepo->find($patient->id);
        $dbPatient = $dbPatient->toArray();
        $this->assertModelData($patient->toArray(), $dbPatient);
    }

    /**
     * @test update
     */
    public function testUpdatePatient()
    {
        $patient = $this->makePatient();
        $fakePatient = $this->fakePatientData();
        $updatedPatient = $this->patientRepo->update($fakePatient, $patient->id);
        $this->assertModelData($fakePatient, $updatedPatient->toArray());
        $dbPatient = $this->patientRepo->find($patient->id);
        $this->assertModelData($fakePatient, $dbPatient->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePatient()
    {
        $patient = $this->makePatient();
        $resp = $this->patientRepo->delete($patient->id);
        $this->assertTrue($resp);
        $this->assertNull(Patient::find($patient->id), 'Patient should not exist in DB');
    }
}
