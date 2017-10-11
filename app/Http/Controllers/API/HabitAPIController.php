<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHabitAPIRequest;
use App\Http\Requests\API\UpdateHabitAPIRequest;
use App\Models\Habit;
use App\Repositories\HabitRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class HabitController
 * @package App\Http\Controllers\API
 */

class HabitAPIController extends AppBaseController
{
    /** @var  HabitRepository */
    private $habitRepository;

    public function __construct(HabitRepository $habitRepo)
    {
        $this->habitRepository = $habitRepo;
    }

    /**
     * Display a listing of the Habit.
     * GET|HEAD /habits
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->habitRepository->pushCriteria(new RequestCriteria($request));
        $this->habitRepository->pushCriteria(new LimitOffsetCriteria($request));
        $habits = $this->habitRepository->all();

        return $this->sendResponse($habits->toArray(), 'Habits retrieved successfully');
    }

    /**
     * Store a newly created Habit in storage.
     * POST /habits
     *
     * @param CreateHabitAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHabitAPIRequest $request)
    {
        $input = $request->all();

        $habits = $this->habitRepository->create($input);

        return $this->sendResponse($habits->toArray(), 'Habit saved successfully');
    }

    /**
     * Display the specified Habit.
     * GET|HEAD /habits/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Habit $habit */
        $habit = $this->habitRepository->findWithoutFail($id);

        if (empty($habit)) {
            return $this->sendError('Habit not found');
        }

        return $this->sendResponse($habit->toArray(), 'Habit retrieved successfully');
    }

    /**
     * Update the specified Habit in storage.
     * PUT/PATCH /habits/{id}
     *
     * @param  int $id
     * @param UpdateHabitAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHabitAPIRequest $request)
    {
        $input = $request->all();

        /** @var Habit $habit */
        $habit = $this->habitRepository->findWithoutFail($id);

        if (empty($habit)) {
            return $this->sendError('Habit not found');
        }

        $habit = $this->habitRepository->update($input, $id);

        return $this->sendResponse($habit->toArray(), 'Habit updated successfully');
    }

    /**
     * Remove the specified Habit from storage.
     * DELETE /habits/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Habit $habit */
        $habit = $this->habitRepository->findWithoutFail($id);

        if (empty($habit)) {
            return $this->sendError('Habit not found');
        }

        $habit->delete();

        return $this->sendResponse($id, 'Habit deleted successfully');
    }
}
