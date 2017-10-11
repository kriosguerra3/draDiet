<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedicationRequest;
use App\Http\Requests\UpdateMedicationRequest;
use App\Repositories\MedicationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MedicationController extends AppBaseController
{
    /** @var  MedicationRepository */
    private $medicationRepository;

    public function __construct(MedicationRepository $medicationRepo)
    {
        $this->medicationRepository = $medicationRepo;
    }

    /**
     * Display a listing of the Medication.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->medicationRepository->pushCriteria(new RequestCriteria($request));
        $medications = $this->medicationRepository->all();

        return view('medications.index')
            ->with('medications', $medications);
    }

    /**
     * Show the form for creating a new Medication.
     *
     * @return Response
     */
    public function create()
    {
        return view('medications.create');
    }

    /**
     * Store a newly created Medication in storage.
     *
     * @param CreateMedicationRequest $request
     *
     * @return Response
     */
    public function store(CreateMedicationRequest $request)
    {
        $input = $request->all();

        $medication = $this->medicationRepository->create($input);

        Flash::success('Medication saved successfully.');

        return redirect(route('medications.index'));
    }

    /**
     * Display the specified Medication.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medication = $this->medicationRepository->findWithoutFail($id);

        if (empty($medication)) {
            Flash::error('Medication not found');

            return redirect(route('medications.index'));
        }

        return view('medications.show')->with('medication', $medication);
    }

    /**
     * Show the form for editing the specified Medication.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medication = $this->medicationRepository->findWithoutFail($id);

        if (empty($medication)) {
            Flash::error('Medication not found');

            return redirect(route('medications.index'));
        }

        return view('medications.edit')->with('medication', $medication);
    }

    /**
     * Update the specified Medication in storage.
     *
     * @param  int              $id
     * @param UpdateMedicationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedicationRequest $request)
    {
        $medication = $this->medicationRepository->findWithoutFail($id);

        if (empty($medication)) {
            Flash::error('Medication not found');

            return redirect(route('medications.index'));
        }

        $medication = $this->medicationRepository->update($request->all(), $id);

        Flash::success('Medication updated successfully.');

        return redirect(route('medications.index'));
    }

    /**
     * Remove the specified Medication from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medication = $this->medicationRepository->findWithoutFail($id);

        if (empty($medication)) {
            Flash::error('Medication not found');

            return redirect(route('medications.index'));
        }

        $this->medicationRepository->delete($id);

        Flash::success('Medication deleted successfully.');

        return redirect(route('medications.index'));
    }
}
