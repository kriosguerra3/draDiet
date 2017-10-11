<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use App\Repositories\HabitRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class HabitController extends AppBaseController
{
    /** @var  HabitRepository */
    private $habitRepository;

    public function __construct(HabitRepository $habitRepo)
    {
        $this->habitRepository = $habitRepo;
    }

    /**
     * Display a listing of the Habit.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->habitRepository->pushCriteria(new RequestCriteria($request));
        $habits = $this->habitRepository->all();

        return view('habits.index')
            ->with('habits', $habits);
    }

    /**
     * Show the form for creating a new Habit.
     *
     * @return Response
     */
    public function create()
    {
        return view('habits.create');
    }

    /**
     * Store a newly created Habit in storage.
     *
     * @param CreateHabitRequest $request
     *
     * @return Response
     */
    public function store(CreateHabitRequest $request)
    {
        $input = $request->all();

        $habit = $this->habitRepository->create($input);

        Flash::success('Habit saved successfully.');

        return redirect(route('habits.index'));
    }

    /**
     * Display the specified Habit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $habit = $this->habitRepository->findWithoutFail($id);

        if (empty($habit)) {
            Flash::error('Habit not found');

            return redirect(route('habits.index'));
        }

        return view('habits.show')->with('habit', $habit);
    }

    /**
     * Show the form for editing the specified Habit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $habit = $this->habitRepository->findWithoutFail($id);

        if (empty($habit)) {
            Flash::error('Habit not found');

            return redirect(route('habits.index'));
        }

        return view('habits.edit')->with('habit', $habit);
    }

    /**
     * Update the specified Habit in storage.
     *
     * @param  int              $id
     * @param UpdateHabitRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHabitRequest $request)
    {
        $habit = $this->habitRepository->findWithoutFail($id);

        if (empty($habit)) {
            Flash::error('Habit not found');

            return redirect(route('habits.index'));
        }

        $habit = $this->habitRepository->update($request->all(), $id);

        Flash::success('Habit updated successfully.');

        return redirect(route('habits.index'));
    }

    /**
     * Remove the specified Habit from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $habit = $this->habitRepository->findWithoutFail($id);

        if (empty($habit)) {
            Flash::error('Habit not found');

            return redirect(route('habits.index'));
        }

        $this->habitRepository->delete($id);

        Flash::success('Habit deleted successfully.');

        return redirect(route('habits.index'));
    }
}
