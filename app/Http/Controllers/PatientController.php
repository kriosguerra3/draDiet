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
use App\Models\Food;
use App\Models\Illness;
use App\Models\Habit;
use App\Models\Medication;
use App\Models\Assessment;
use App\Models\Visit;
use Auth;

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
        $exercises = Habit::where('type', '=','exercise')->orderBy("name")->get();  
        $foods = Food::orderBy("name")->get();
        $medications = Medication::orderBy("name")->get();        
        $assessments = Assessment::orderBy("name")->get()->groupBy('parent');
        
        return view('patients.create',compact('general_illnesses','female_illnesses', 'habits','exercises','foods','medications','assessments'));
    
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
        //dd($request);
        //We separate the inputs to store them properly
        $input_patient = $request->except('illnesses','habits','food_allergies','medication_allergies');                
        $input_illnesses = $request->get('illnesses');
        $input_habits = $request->get('habits');
        $input_food_allergies= $request->get('food_allergies');
        $input_medication_allergies= $request->get('medication_allergies');
        $input_assessments = $request->get('assessments');
        
        //Rewriting the birthdate into Carbon Format
        $input_patient['birthdate'] =  Carbon::createFromFormat('d/m/Y',  $input_patient['birthdate']);        
        //Saving data into each table
        $patient = $this->patientRepository->create($input_patient);
        $patient->illnesses()->sync($input_illnesses);
        $patient->habits()->sync($input_habits);
        $patient->food_allergies()->sync($input_food_allergies);
        $patient->medication_allergies()->sync($input_medication_allergies);
        
        //Saving the visit information. Since these are related models we can just use the save method
        $visit = new Visit(['user_id'=>Auth::user()->id]);
        $patient->visits()->save($visit);
                
        //Saving the values from the measured assessments. We use attach plus the additional column     
        foreach($input_assessments as $assessment_id=>$value){
            $visit->assessments()->attach($assessment_id,['value' => $value]);
        }
        
        
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
        $foods = Food::orderBy("name")->get(); 
        $medications = Medication::orderBy("name")->get();
        $assessments = Assessment::orderBy("name")->get()->groupBy('parent');
        
        $patient = $this->patientRepository->findWithoutFail($id);   
        
        $patient['birthdate']->format('d-m-Y');        

        //Mandamos todos los registros de hábitos, enfermedades, etc.
        $patient['illnesses'] =  $patient->illnesses()->get(); 
        $patient['habits'] = $patient->habits()->get();
        $patient['foods'] = $patient->foods()->get();
        $patient['food_allergies'] = $patient->food_allergies()->get();
        $patient['medication_allergies'] = $patient->medication_allergies()->get();       

        //Getting the first visit id
        $visit = $patient->visits()->first();
        $assessments_first_visit = $visit->assessments()->get();
        
        //Arranging the assessment values so we can send them to the form
        foreach ($assessments_first_visit as $assessment_value) {
            $first_visit_assessments[$assessment_value->id] = $assessment_value->pivot->value;
            //Como almacenarlas después que necesitemos el valor de varias visitas:
            //$first_visit_assessments[$visit->id][$assessment_value->id] = $assessment_value->pivot->value;
        }
        $patient['visit_assessments'] = $first_visit_assessments;
       
        if (empty($patient)) {
            Flash::error('Patient not found');
            return redirect(route('patients.index'));
        }
        
        return view('patients.edit', compact('patient','general_illnesses','female_illnesses','habits','exercises','foods','medications','assessments'));
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
        
        
        //Getting the first visit id
        $visit = $patient->visits()->first();
        
        //Updating the values from the measured assessments. We use attach plus the additional column
        foreach( $request['assessments'] as $assessment_id=>$value){
            $visit->assessments()->updateExistingPivot($assessment_id,['value' => $value]);
        }
        
        
        //Detaching illnesses in case there's none when updating        
        if($request->get('illnesses') === null){
            $patient->illnesses()->detach();            
        }  

        //Detaching habits in case there's none when updating
        if($request->get('habits') === null){
            $patient->habits()->detach();
        }
        
        //Detaching foods in case there's none when updating
        if($request->get('foods') === null){
            $patient->foods()->detach();
        }       
       
        //Detaching food_allergies in case there's none when updating
        if($request->get('food_allergies') === null){              
            $patient->food_allergies()->detach();
        } 
        
        //Detaching medication_allergies in case there's none when updating
        if($request->get('medication_allergies') === null){
            $patient->medication_allergies()->detach();
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
