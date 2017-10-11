<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAssessmentAPIRequest;
use App\Http\Requests\API\UpdateAssessmentAPIRequest;
use App\Models\Assessment;
use App\Repositories\AssessmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class AssessmentController
 * @package App\Http\Controllers\API
 */

class AssessmentAPIController extends AppBaseController
{
    /** @var  AssessmentRepository */
    private $assessmentRepository;

    public function __construct(AssessmentRepository $assessmentRepo)
    {
        $this->assessmentRepository = $assessmentRepo;
    }

    /**
     * Display a listing of the Assessment.
     * GET|HEAD /assessments
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->assessmentRepository->pushCriteria(new RequestCriteria($request));
        $this->assessmentRepository->pushCriteria(new LimitOffsetCriteria($request));
        $assessments = $this->assessmentRepository->all();

        return $this->sendResponse($assessments->toArray(), 'Assessments retrieved successfully');
    }

    /**
     * Store a newly created Assessment in storage.
     * POST /assessments
     *
     * @param CreateAssessmentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAssessmentAPIRequest $request)
    {
        $input = $request->all();

        $assessments = $this->assessmentRepository->create($input);

        return $this->sendResponse($assessments->toArray(), 'Assessment saved successfully');
    }

    /**
     * Display the specified Assessment.
     * GET|HEAD /assessments/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Assessment $assessment */
        $assessment = $this->assessmentRepository->findWithoutFail($id);

        if (empty($assessment)) {
            return $this->sendError('Assessment not found');
        }

        return $this->sendResponse($assessment->toArray(), 'Assessment retrieved successfully');
    }

    /**
     * Update the specified Assessment in storage.
     * PUT/PATCH /assessments/{id}
     *
     * @param  int $id
     * @param UpdateAssessmentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAssessmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Assessment $assessment */
        $assessment = $this->assessmentRepository->findWithoutFail($id);

        if (empty($assessment)) {
            return $this->sendError('Assessment not found');
        }

        $assessment = $this->assessmentRepository->update($input, $id);

        return $this->sendResponse($assessment->toArray(), 'Assessment updated successfully');
    }

    /**
     * Remove the specified Assessment from storage.
     * DELETE /assessments/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Assessment $assessment */
        $assessment = $this->assessmentRepository->findWithoutFail($id);

        if (empty($assessment)) {
            return $this->sendError('Assessment not found');
        }

        $assessment->delete();

        return $this->sendResponse($id, 'Assessment deleted successfully');
    }
}
