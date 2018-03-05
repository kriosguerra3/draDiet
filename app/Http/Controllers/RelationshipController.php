<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medication;
use App\Models\Supplement;
use App\Models\Illness;
use App\Models\Malaise;

class RelationshipController extends Controller
{    

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $medications = Medication::orderBy("name")->get(); 
        $supplements = Supplement::orderBy("name")->get();
        $illnesses = Illness::orderBy("name")->get();
        $malaises = Malaise::orderBy("name")->get();
                
        //return view('relationships.index')->with('medications', $medications);
        return view('relationships.index',compact('medications','supplements','illnesses','malaises'));
    }
    
    /**
     * Display current relationships
     */
    public function view($id,$type)
    {
        if($type == "illness" || $type == "malaise"){
            //Buscar todos los medicamentos asociados
            //Buscar todas los suplementos asociados
        }
        else if($type == "medication" || $type == "supplement"){
            //Buscar todas las enfermedades asociados
            //Buscar todas los malestares asociados
        }               
        
        return view('relationships.view');
    }
}
