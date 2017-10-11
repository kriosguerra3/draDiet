<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMedicationAPIRequest;
use App\Http\Requests\API\UpdateMedicationAPIRequest;
use App\Models\Medication;
use App\Repositories\MedicationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MedicationController
 * @package App\Http\Controllers\API
 */

class MedicationAPIController extends AppBaseController
{
    /** @var  MedicationRepository */
    private $medicationRepository;

    public function __construct(MedicationRepository $medicationRepo)
    {
        $this->medicationRepository = $medicationRepo;
    }

    /**
     * Display a listing of the Medication.
     * GET|HEAD /medications
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->medicationRepository->pushCriteria(new RequestCriteria($request));
        $this->medicationRepository->pushCriteria(new LimitOffsetCriteria($request));
        $medications = $this->medicationRepository->all();

        return $this->sendResponse($medications->toArray(), 'Medications retrieved successfully');
    }

    /**
     * Store a newly created Medication in storage.
     * POST /medications
     *
     * @param CreateMedicationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMedicationAPIRequest $request)
    {
        $input = $request->all();

        $medications = $this->medicationRepository->create($input);

        return $this->sendResponse($medications->toArray(), 'Medication saved successfully');
    }

    /**
     * Display the specified Medication.
     * GET|HEAD /medications/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Medication $medication */
        $medication = $this->medicationRepository->findWithoutFail($id);

        if (empty($medication)) {
            return $this->sendError('Medication not found');
        }

        return $this->sendResponse($medication->toArray(), 'Medication retrieved successfully');
    }

    /**
     * Update the specified Medication in storage.
     * PUT/PATCH /medications/{id}
     *
     * @param  int $id
     * @param UpdateMedicationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedicationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Medication $medication */
        $medication = $this->medicationRepository->findWithoutFail($id);

        if (empty($medication)) {
            return $this->sendError('Medication not found');
        }

        $medication = $this->medicationRepository->update($input, $id);

        return $this->sendResponse($medication->toArray(), 'Medication updated successfully');
    }

    /**
     * Remove the specified Medication from storage.
     * DELETE /medications/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Medication $medication */
        $medication = $this->medicationRepository->findWithoutFail($id);

        if (empty($medication)) {
            return $this->sendError('Medication not found');
        }

        $medication->delete();

        return $this->sendResponse($id, 'Medication deleted successfully');
    }
}
