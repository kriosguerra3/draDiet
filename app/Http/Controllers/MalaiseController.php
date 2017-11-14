<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMalaiseRequest;
use App\Http\Requests\UpdateMalaiseRequest;
use App\Repositories\MalaiseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MalaiseController extends AppBaseController
{
    /** @var  MalaiseRepository */
    private $malaiseRepository;

    public function __construct(MalaiseRepository $malaiseRepo)
    {
        $this->malaiseRepository = $malaiseRepo;
    }

    /**
     * Display a listing of the Malaise.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->malaiseRepository->pushCriteria(new RequestCriteria($request));
        $malaises = $this->malaiseRepository->all();

        return view('malaises.index')
            ->with('malaises', $malaises);
    }

    /**
     * Show the form for creating a new Malaise.
     *
     * @return Response
     */
    public function create()
    {
        return view('malaises.create');
    }

    /**
     * Store a newly created Malaise in storage.
     *
     * @param CreateMalaiseRequest $request
     *
     * @return Response
     */
    public function store(CreateMalaiseRequest $request)
    {
        $input = $request->all();

        $malaise = $this->malaiseRepository->create($input);

        Flash::success('Malaise saved successfully.');

        return redirect(route('malaises.index'));
    }

    /**
     * Display the specified Malaise.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $malaise = $this->malaiseRepository->findWithoutFail($id);

        if (empty($malaise)) {
            Flash::error('Malaise not found');

            return redirect(route('malaises.index'));
        }

        return view('malaises.show')->with('malaise', $malaise);
    }

    /**
     * Show the form for editing the specified Malaise.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $malaise = $this->malaiseRepository->findWithoutFail($id);

        if (empty($malaise)) {
            Flash::error('Malaise not found');

            return redirect(route('malaises.index'));
        }

        return view('malaises.edit')->with('malaise', $malaise);
    }

    /**
     * Update the specified Malaise in storage.
     *
     * @param  int              $id
     * @param UpdateMalaiseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMalaiseRequest $request)
    {
        $malaise = $this->malaiseRepository->findWithoutFail($id);

        if (empty($malaise)) {
            Flash::error('Malaise not found');

            return redirect(route('malaises.index'));
        }

        $malaise = $this->malaiseRepository->update($request->all(), $id);

        Flash::success('Malaise updated successfully.');

        return redirect(route('malaises.index'));
    }

    /**
     * Remove the specified Malaise from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $malaise = $this->malaiseRepository->findWithoutFail($id);

        if (empty($malaise)) {
            Flash::error('Malaise not found');

            return redirect(route('malaises.index'));
        }

        $this->malaiseRepository->delete($id);

        Flash::success('Malaise deleted successfully.');

        return redirect(route('malaises.index'));
    }
}
