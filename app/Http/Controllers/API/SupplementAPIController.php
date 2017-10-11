<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSupplementAPIRequest;
use App\Http\Requests\API\UpdateSupplementAPIRequest;
use App\Models\Supplement;
use App\Repositories\SupplementRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SupplementController
 * @package App\Http\Controllers\API
 */

class SupplementAPIController extends AppBaseController
{
    /** @var  SupplementRepository */
    private $supplementRepository;

    public function __construct(SupplementRepository $supplementRepo)
    {
        $this->supplementRepository = $supplementRepo;
    }

    /**
     * Display a listing of the Supplement.
     * GET|HEAD /supplements
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->supplementRepository->pushCriteria(new RequestCriteria($request));
        $this->supplementRepository->pushCriteria(new LimitOffsetCriteria($request));
        $supplements = $this->supplementRepository->all();

        return $this->sendResponse($supplements->toArray(), 'Supplements retrieved successfully');
    }

    /**
     * Store a newly created Supplement in storage.
     * POST /supplements
     *
     * @param CreateSupplementAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSupplementAPIRequest $request)
    {
        $input = $request->all();

        $supplements = $this->supplementRepository->create($input);

        return $this->sendResponse($supplements->toArray(), 'Supplement saved successfully');
    }

    /**
     * Display the specified Supplement.
     * GET|HEAD /supplements/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Supplement $supplement */
        $supplement = $this->supplementRepository->findWithoutFail($id);

        if (empty($supplement)) {
            return $this->sendError('Supplement not found');
        }

        return $this->sendResponse($supplement->toArray(), 'Supplement retrieved successfully');
    }

    /**
     * Update the specified Supplement in storage.
     * PUT/PATCH /supplements/{id}
     *
     * @param  int $id
     * @param UpdateSupplementAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupplementAPIRequest $request)
    {
        $input = $request->all();

        /** @var Supplement $supplement */
        $supplement = $this->supplementRepository->findWithoutFail($id);

        if (empty($supplement)) {
            return $this->sendError('Supplement not found');
        }

        $supplement = $this->supplementRepository->update($input, $id);

        return $this->sendResponse($supplement->toArray(), 'Supplement updated successfully');
    }

    /**
     * Remove the specified Supplement from storage.
     * DELETE /supplements/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Supplement $supplement */
        $supplement = $this->supplementRepository->findWithoutFail($id);

        if (empty($supplement)) {
            return $this->sendError('Supplement not found');
        }

        $supplement->delete();

        return $this->sendResponse($id, 'Supplement deleted successfully');
    }
}
