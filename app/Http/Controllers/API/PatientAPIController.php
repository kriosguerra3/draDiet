<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePatientAPIRequest;
use App\Http\Requests\API\UpdatePatientAPIRequest;
use App\Models\Patient;
use App\Repositories\PatientRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PatientController
 * @package App\Http\Controllers\API
 */

class PatientAPIController extends AppBaseController
{
    /** @var  PatientRepository */
    private $patientRepository;

    public function __construct(PatientRepository $patientRepo)
    {
        $this->patientRepository = $patientRepo;
    }

    /**
     * Display a listing of the Patient.
     * GET|HEAD /patients
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->patientRepository->pushCriteria(new RequestCriteria($request));
        $this->patientRepository->pushCriteria(new LimitOffsetCriteria($request));
        $patients = $this->patientRepository->all();

        return $this->sendResponse($patients->toArray(), 'Patients retrieved successfully');
    }

    /**
     * Store a newly created Patient in storage.
     * POST /patients
     *
     * @param CreatePatientAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePatientAPIRequest $request)
    {
        $input = $request->all();

        $patients = $this->patientRepository->create($input);

        return $this->sendResponse($patients->toArray(), 'Patient saved successfully');
    }

    /**
     * Display the specified Patient.
     * GET|HEAD /patients/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Patient $patient */
        $patient = $this->patientRepository->findWithoutFail($id);

        if (empty($patient)) {
            return $this->sendError('Patient not found');
        }

        return $this->sendResponse($patient->toArray(), 'Patient retrieved successfully');
    }

    /**
     * Update the specified Patient in storage.
     * PUT/PATCH /patients/{id}
     *
     * @param  int $id
     * @param UpdatePatientAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePatientAPIRequest $request)
    {
        $input = $request->all();

        /** @var Patient $patient */
        $patient = $this->patientRepository->findWithoutFail($id);

        if (empty($patient)) {
            return $this->sendError('Patient not found');
        }

        $patient = $this->patientRepository->update($input, $id);

        return $this->sendResponse($patient->toArray(), 'Patient updated successfully');
    }

    /**
     * Remove the specified Patient from storage.
     * DELETE /patients/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Patient $patient */
        $patient = $this->patientRepository->findWithoutFail($id);

        if (empty($patient)) {
            return $this->sendError('Patient not found');
        }

        $patient->delete();

        return $this->sendResponse($id, 'Patient deleted successfully');
    }
}
