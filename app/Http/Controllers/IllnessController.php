<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIllnessRequest;
use App\Http\Requests\UpdateIllnessRequest;
use App\Repositories\IllnessRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class IllnessController extends AppBaseController
{
    /** @var  IllnessRepository */
    private $illnessRepository;

    public function __construct(IllnessRepository $illnessRepo)
    {
        $this->illnessRepository = $illnessRepo;
    }

    /**
     * Display a listing of the Illness.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->illnessRepository->pushCriteria(new RequestCriteria($request));
        $illnesses = $this->illnessRepository->all();

        return view('illnesses.index')
            ->with('illnesses', $illnesses);
    }

    /**
     * Show the form for creating a new Illness.
     *
     * @return Response
     */
    public function create()
    {
        return view('illnesses.create');
    }

    /**
     * Store a newly created Illness in storage.
     *
     * @param CreateIllnessRequest $request
     *
     * @return Response
     */
    public function store(CreateIllnessRequest $request)
    {
        $input = $request->all();

        $illness = $this->illnessRepository->create($input);

        Flash::success('Illness saved successfully.');

        return redirect(route('illnesses.index'));
    }

    /**
     * Display the specified Illness.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $illness = $this->illnessRepository->findWithoutFail($id);

        if (empty($illness)) {
            Flash::error('Illness not found');

            return redirect(route('illnesses.index'));
        }

        return view('illnesses.show')->with('illness', $illness);
    }

    /**
     * Show the form for editing the specified Illness.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $illness = $this->illnessRepository->findWithoutFail($id);

        if (empty($illness)) {
            Flash::error('Illness not found');

            return redirect(route('illnesses.index'));
        }

        return view('illnesses.edit')->with('illness', $illness);
    }

    /**
     * Update the specified Illness in storage.
     *
     * @param  int              $id
     * @param UpdateIllnessRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIllnessRequest $request)
    {
        $illness = $this->illnessRepository->findWithoutFail($id);

        if (empty($illness)) {
            Flash::error('Illness not found');

            return redirect(route('illnesses.index'));
        }

        $illness = $this->illnessRepository->update($request->all(), $id);

        Flash::success('Illness updated successfully.');

        return redirect(route('illnesses.index'));
    }

    /**
     * Remove the specified Illness from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $illness = $this->illnessRepository->findWithoutFail($id);

        if (empty($illness)) {
            Flash::error('Illness not found');

            return redirect(route('illnesses.index'));
        }

        $this->illnessRepository->delete($id);

        Flash::success('Illness deleted successfully.');

        return redirect(route('illnesses.index'));
    }
}
