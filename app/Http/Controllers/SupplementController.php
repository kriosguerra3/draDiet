<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupplementRequest;
use App\Http\Requests\UpdateSupplementRequest;
use App\Repositories\SupplementRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SupplementController extends AppBaseController
{
    /** @var  SupplementRepository */
    private $supplementRepository;

    public function __construct(SupplementRepository $supplementRepo)
    {
        $this->supplementRepository = $supplementRepo;
    }

    /**
     * Display a listing of the Supplement.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->supplementRepository->pushCriteria(new RequestCriteria($request));
        $supplements = $this->supplementRepository->all();

        return view('supplements.index')
            ->with('supplements', $supplements);
    }

    /**
     * Show the form for creating a new Supplement.
     *
     * @return Response
     */
    public function create()
    {
        return view('supplements.create');
    }

    /**
     * Store a newly created Supplement in storage.
     *
     * @param CreateSupplementRequest $request
     *
     * @return Response
     */
    public function store(CreateSupplementRequest $request)
    {
        $input = $request->all();

        $supplement = $this->supplementRepository->create($input);

        Flash::success('Supplement saved successfully.');

        return redirect(route('supplements.index'));
    }

    /**
     * Display the specified Supplement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $supplement = $this->supplementRepository->findWithoutFail($id);

        if (empty($supplement)) {
            Flash::error('Supplement not found');

            return redirect(route('supplements.index'));
        }

        return view('supplements.show')->with('supplement', $supplement);
    }

    /**
     * Show the form for editing the specified Supplement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $supplement = $this->supplementRepository->findWithoutFail($id);

        if (empty($supplement)) {
            Flash::error('Supplement not found');

            return redirect(route('supplements.index'));
        }

        return view('supplements.edit')->with('supplement', $supplement);
    }

    /**
     * Update the specified Supplement in storage.
     *
     * @param  int              $id
     * @param UpdateSupplementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupplementRequest $request)
    {
        $supplement = $this->supplementRepository->findWithoutFail($id);

        if (empty($supplement)) {
            Flash::error('Supplement not found');

            return redirect(route('supplements.index'));
        }

        $supplement = $this->supplementRepository->update($request->all(), $id);

        Flash::success('Supplement updated successfully.');

        return redirect(route('supplements.index'));
    }

    /**
     * Remove the specified Supplement from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $supplement = $this->supplementRepository->findWithoutFail($id);

        if (empty($supplement)) {
            Flash::error('Supplement not found');

            return redirect(route('supplements.index'));
        }

        $this->supplementRepository->delete($id);

        Flash::success('Supplement deleted successfully.');

        return redirect(route('supplements.index'));
    }
}
