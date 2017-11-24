<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Repositories\PatientRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Patient;
use App\Models\Illness;
use App\Models\Habit;


class PatientController extends AppBaseController
{
    /** @var  PatientRepository */
    private $patientRepository;

    public function __construct(PatientRepository $patientRepo)
    {
        $this->patientRepository = $patientRepo;
    }

    /**
     * Display a listing of the Patient.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->patientRepository->pushCriteria(new RequestCriteria($request));
        $patients = $this->patientRepository->all();

        return view('patients.index')
            ->with('patients', $patients);
    }

    /**
     * Show the form for creating a new Patient.
     *
     * @return Response
     */
    public function create()
    {
        //Mandamos todos los registros de hábitos, enfermedades, etc.              
        $female_illnesses = Illness::where('gender', '=','female')->orderBy('name', 'asc')->get();
        $general_illnesses = Illness::orWhereNull('gender')->orderBy('name', 'asc')->get();
        $habits= Habit::where('type', '=',NULL)->orderBy("name")->get();
        $exercises= Habit::where('type', '=','exercise')->orderBy("name")->get();       
        
        return view('patients.create',compact('general_illnesses','female_illnesses','habits','exercises'));
    }

    /**
     * Store a newly created Patient in storage.
     *
     * @param CreatePatientRequest $request
     *
     * @return Response
     */
    public function store(CreatePatientRequest $request)
    {
        //We separate the inputs to store them properly
        $input_patient = $request->except('illnesses','habits');                
        $input_illnesses = $request->get('illnesses');
        $input_habits = $request->get('habits');
        
        //Rewriting the birthdate into Carbon Format
        $input_patient['birthdate'] =  Carbon::createFromFormat('d/m/Y',  $input_patient['birthdate']);        
        //Saving data into each table
        $patient = $this->patientRepository->create($input_patient);
        $patient->illnesses()->sync($input_illnesses);
        $patient->habits()->sync($input_habits);

        Flash::success('Patient saved successfully.');

        return redirect(route('patients.index'));
    }

    /**
     * Display the specified Patient.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        
        $patient = $this->patientRepository->findWithoutFail($id);

        if (empty($patient)) {
            Flash::error('Patient not found');

            return redirect(route('patients.index'));
        }

        return view('patients.show')->with('patient', $patient);
    }

    /**
     * Show the form for editing the specified Patient.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
          
        //Mandamos todos los registros de hábitos, enfermedades, etc.
        $general_illnesses = Illness::orWhereNull('gender')->orderBy('name', 'asc')->get();
        $female_illnesses = Illness::where('gender', '=','female')->orderBy('name', 'asc')->get();        
        $habits = Habit::where('type', '=', NULL)->orderBy("name")->get();
        $exercises= Habit::where('type', '=','exercise')->orderBy("name")->get();     
        
        $patient = $this->patientRepository->findWithoutFail($id);        
        //Mandamos todos los registros de hábitos, enfermedades, etc.
        $patient['illnesses'] =  $patient->illnesses()->get(); 
        $patient['habits'] = $patient->habits()->get();                
        
        if (empty($patient)) {
            Flash::error('Patient not found');

            return redirect(route('patients.index'));
        }

        return view('patients.edit', compact('patient','general_illnesses','female_illnesses','habits','exercises'));
    }

    /**
     * Update the specified Patient in storage.
     *
     * @param  int              $id
     * @param UpdatePatientRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePatientRequest $request)
    {        
        $patient = $this->patientRepository->findWithoutFail($id);       

        if (empty($patient)) {
            Flash::error('Patient not found');
            return redirect(route('patients.index'));
        }
        
        //Rewriting the birthdate into Carbon Format
        $request['birthdate'] =  Carbon::createFromFormat('d/m/Y', $request['birthdate']);        
        $patient = $this->patientRepository->update($request->all(), $id);
        
        //Detaching illnesses in case there's none when updating        
        if($request->get('illnesses') === null){
            $patient->illnesses()->detach();            
        }  

        //Detaching habits in case there's none when updating
        if($request->get('habits') === null){
            $patient->habits()->detach();
        }                       
        
        Flash::success('Patient updated successfully.');
        return redirect(route('patients.index'));
    }

    /**
     * Remove the specified Patient from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $patient = $this->patientRepository->findWithoutFail($id);

        if (empty($patient)) {
            Flash::error('Patient not found');

            return redirect(route('patients.index'));
        }

        $this->patientRepository->delete($id);
        Flash::success('Patient deleted successfully.');
        return redirect(route('patients.index'));
    }
}
