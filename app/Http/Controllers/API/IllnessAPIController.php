<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateIllnessAPIRequest;
use App\Http\Requests\API\UpdateIllnessAPIRequest;
use App\Models\Illness;
use App\Repositories\IllnessRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class IllnessController
 * @package App\Http\Controllers\API
 */

class IllnessAPIController extends AppBaseController
{
    /** @var  IllnessRepository */
    private $illnessRepository;

    public function __construct(IllnessRepository $illnessRepo)
    {
        $this->illnessRepository = $illnessRepo;
    }

    /**
     * Display a listing of the Illness.
     * GET|HEAD /illnesses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->illnessRepository->pushCriteria(new RequestCriteria($request));
        $this->illnessRepository->pushCriteria(new LimitOffsetCriteria($request));
        $illnesses = $this->illnessRepository->all();

        return $this->sendResponse($illnesses->toArray(), 'Illnesses retrieved successfully');
    }

    /**
     * Store a newly created Illness in storage.
     * POST /illnesses
     *
     * @param CreateIllnessAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateIllnessAPIRequest $request)
    {
        $input = $request->all();

        $illnesses = $this->illnessRepository->create($input);

        return $this->sendResponse($illnesses->toArray(), 'Illness saved successfully');
    }

    /**
     * Display the specified Illness.
     * GET|HEAD /illnesses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Illness $illness */
        $illness = $this->illnessRepository->findWithoutFail($id);

        if (empty($illness)) {
            return $this->sendError('Illness not found');
        }

        return $this->sendResponse($illness->toArray(), 'Illness retrieved successfully');
    }

    /**
     * Update the specified Illness in storage.
     * PUT/PATCH /illnesses/{id}
     *
     * @param  int $id
     * @param UpdateIllnessAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIllnessAPIRequest $request)
    {
        $input = $request->all();

        /** @var Illness $illness */
        $illness = $this->illnessRepository->findWithoutFail($id);

        if (empty($illness)) {
            return $this->sendError('Illness not found');
        }

        $illness = $this->illnessRepository->update($input, $id);

        return $this->sendResponse($illness->toArray(), 'Illness updated successfully');
    }

    /**
     * Remove the specified Illness from storage.
     * DELETE /illnesses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Illness $illness */
        $illness = $this->illnessRepository->findWithoutFail($id);

        if (empty($illness)) {
            return $this->sendError('Illness not found');
        }

        $illness->delete();

        return $this->sendResponse($id, 'Illness deleted successfully');
    }
}
