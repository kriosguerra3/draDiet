<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAssessmentRequest;
use App\Http\Requests\UpdateAssessmentRequest;
use App\Repositories\AssessmentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AssessmentController extends AppBaseController
{
    /** @var  AssessmentRepository */
    private $assessmentRepository;

    public function __construct(AssessmentRepository $assessmentRepo)
    {
        $this->assessmentRepository = $assessmentRepo;
    }

    /**
     * Display a listing of the Assessment.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->assessmentRepository->pushCriteria(new RequestCriteria($request));
        $assessments = $this->assessmentRepository->all();

        return view('assessments.index')
            ->with('assessments', $assessments);
    }

    /**
     * Show the form for creating a new Assessment.
     *
     * @return Response
     */
    public function create()
    {
        return view('assessments.create');
    }

    /**
     * Store a newly created Assessment in storage.
     *
     * @param CreateAssessmentRequest $request
     *
     * @return Response
     */
    public function store(CreateAssessmentRequest $request)
    {
        $input = $request->all();

        $assessment = $this->assessmentRepository->create($input);

        Flash::success('Assessment saved successfully.');

        return redirect(route('assessments.index'));
    }

    /**
     * Display the specified Assessment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $assessment = $this->assessmentRepository->findWithoutFail($id);

        if (empty($assessment)) {
            Flash::error('Assessment not found');

            return redirect(route('assessments.index'));
        }

        return view('assessments.show')->with('assessment', $assessment);
    }

    /**
     * Show the form for editing the specified Assessment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $assessment = $this->assessmentRepository->findWithoutFail($id);

        if (empty($assessment)) {
            Flash::error('Assessment not found');

            return redirect(route('assessments.index'));
        }

        return view('assessments.edit')->with('assessment', $assessment);
    }

    /**
     * Update the specified Assessment in storage.
     *
     * @param  int              $id
     * @param UpdateAssessmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAssessmentRequest $request)
    {
        $assessment = $this->assessmentRepository->findWithoutFail($id);

        if (empty($assessment)) {
            Flash::error('Assessment not found');

            return redirect(route('assessments.index'));
        }

        $assessment = $this->assessmentRepository->update($request->all(), $id);

        Flash::success('Assessment updated successfully.');

        return redirect(route('assessments.index'));
    }

    /**
     * Remove the specified Assessment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $assessment = $this->assessmentRepository->findWithoutFail($id);

        if (empty($assessment)) {
            Flash::error('Assessment not found');

            return redirect(route('assessments.index'));
        }

        $this->assessmentRepository->delete($id);

        Flash::success('Assessment deleted successfully.');

        return redirect(route('assessments.index'));
    }
}
