@section('css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">	
	<link rel="stylesheet" href="{{ url('/') }}/bower/clockpicker/dist/bootstrap-clockpicker.min.css" />	
@endsection 

<div class="form-group col-md-12">    
    <h2>Datos Personales</h2>
    <div class=" box box-primary">
    	<div class="box-body">
            <!-- Name Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('name', 'Nombres:') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            
            <!-- Last Name Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('last_name', 'Apellidos:') !!}
                {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
            </div>
            
            <!-- Gender Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('gender', 'Género:') !!}    
                <br>
                {!! Form::radio('gender', 'female', false, array('id'=>'female','class'=>'custom-control custom-radio'));!!}
                {!! Form::label('female', 'Femenino'); !!}    
                {!! Form::radio('gender', 'male', false, array('id'=>'male','class'=>'custom-control custom-radio'));!!}
                {!! Form::label('male', 'Masculino'); !!}
            </div>
            
            <!-- Birthdate Field -->
            <div class="form-group col-sm-6">
            	{!! Form::label('birthdate', 'Fecha de Nacimiento:') !!} 
            	<div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
            		@if (Route::currentRouteName() == "patients.edit" )
            			<input type="text" id="birthdate" name="birthdate" class="datepicker form-control pull-right" value="{{ $patient['birthdate']->format('d/m/Y') }}">
            		@else
            			<input type="text" id="birthdate" name="birthdate" class="datepicker form-control pull-right" value="">
            		@endif		
                </div>
            </div>
            
            <!-- phone Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('phone_number', 'Teléfono') !!}
                {!! Form::text('phone_number', old('phone_number'), ['class' => 'form-control']) !!}
            </div>
            
            <!-- Email Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('email', 'Correo electrónico') !!}
                {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
            </div>
           
             <!-- Age Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('patient_age', 'Edad') !!}
                {!! Form::text('patient_age',null, ['id'=>'patient_age','class' => 'form-control', 'readonly'  => 'true']) !!}
            </div>
        </div>
    </div>
</div>

<div class="form-group col-md-12">
	<h2>Historia Clínica</h2>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Enfermedades que padece</h3>
		</div>
		<div class="box-body">
			@foreach($general_illnesses as $illness)
				<div class="form-group col-md-3">
					{{-- If para validar si estamos editando o creando un paciente--}}
					@if (Route::currentRouteName() == "patients.edit" )
						{!! Form::checkbox('illnesses[]', $illness->id, $patient['illnesses']->contains($illness->id) ? true: false  , array('class'=>'form-check-label'));!!}
					@else
						{!! Form::checkbox('illnesses[]', $illness->id,false, array('class'=>'form-check-label'));!!}
					@endif		
					{!! Form::label('illness', $illness->name ,array('class'=>'form-check-input')); !!}
				</div>
			@endforeach
		</div>

		<div id="female_illnesses">
			<div class="box-header with-border">
				<h3 class="box-title">Enfermedades Ginecológicas</h3>
			</div>
			<div class="box-body">
				@foreach($female_illnesses as $illness)
					<div class="form-group col-sm-3">
						{{-- If para validar si estamos editando o creando un paciente--}}
					@if (Route::currentRouteName() == "patients.edit" )
						{!! Form::checkbox('illnesses[]', $illness->id, $patient['illnesses']->contains($illness->id) ? true: false  , array('class'=>'form-check-label'));!!}
					@else
						{!! Form::checkbox('illnesses[]', $illness->id,false, array('class'=>'form-check-label'));!!}
					@endif	
					{!! Form::label('illness', $illness->name ,array('class'=>'form-check-input')); !!}
					</div>
				@endforeach
			</div>
		</div>
	</div>		
	
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Alergias</h3>
		</div>
		<div class="box-body">			
			<div class="form-group col-sm-12">
				@if (Route::currentRouteName() == "patients.edit" )
					{{-- Tercer parámetro: solo si hay alergias, va checked--}}
					{!! Form::checkbox('food_allergies_checkbox','',$patient['food_allergies']->isNotEmpty() == true ? 'checked' : '', array('id'=>'food_allergies_checkbox','class'=>'form-check-label'));!!}
				@else
					{!! Form::checkbox('food_allergies_checkbox', '',false, array('id'=>'food_allergies_checkbox','class'=>'form-check-input'));!!}
				@endif	
				{!! Form::label('food_allergies_checkbox', 'Alimentos' ,array('class'=>'form-check-label')); !!}
			</div>			
			<?php 			    
			    $hideFoodsList = 'style = "display: none;"';
                if(Route::currentRouteName() == "patients.edit" ){
                    //We validate if there's medication previously selected so we display the list                   
                    if($patient['food_allergies']->isEmpty() == true ) {
                        $hideFoodsList = 'style = "display: none;"';
                    }
                    else{
                        $hideFoodsList = '';
                    }
                }                
			?>
			<div id="foods_list_div" class="box-body col-sm-12" {!! $hideFoodsList !!}>
    			@foreach($foods as $food)
        			<div class="form-group col-sm-3">
        				@if (Route::currentRouteName() == "patients.edit" )
        					{!! Form::checkbox('food_allergies[]', $food->id, $patient['food_allergies']->contains($food->id) ? true: false  , array('class'=>'form-check-label'));!!}
        				@else
        					{!! Form::checkbox('food_allergies[]', $food->id, false, array('class'=>'form-check-input'));!!}
        				@endif	
        				{!! Form::label('food_allergies[]', $food->name ,array('class'=>'form-check-label')); !!}
        			</div>
    			@endforeach
    		</div>    		
    		<div class="form-group col-sm-12">
				@if (Route::currentRouteName() == "patients.edit" )
					{{-- Tercer parámetro: solo si hay alergias, va checked--}}
					{!! Form::checkbox('medication_allergies_checkbox','',$patient['medication_allergies']->isNotEmpty() == true ? 'checked' : '', array('id'=>'medication_allergies_checkbox', 'class'=>'form-check-label'));!!}
				@else
					{!! Form::checkbox('medication_allergies_checkbox', '' ,false, array('id'=>'medication_allergies_checkbox','class'=>'form-check-input'));!!}
				@endif	
				{!! Form::label('medication_allergies_checkbox', 'Medicamentos' ,array('class'=>'form-check-label')); !!}
			</div>
			<?php 
			    $hideMedicationList = 'style = "display: none;"';
    			if(Route::currentRouteName() == "patients.edit" ){
                    //We validate if there's medication previously selected so we display the list                    
                    if($patient['medication_allergies']->isEmpty() == true ) {
                        $hideMedicationList = 'style = "display: none;"';
                    }else{
                        $hideMedicationList = '';
                    }                  
    			}
			?>
    		<div id="medications_list_div" class="box-body col-sm-12" {!! $hideMedicationList !!} >
    			@foreach($medications as $medication)
        			<div class="form-group col-sm-3">
        				@if (Route::currentRouteName() == "patients.edit" )
        					{!! Form::checkbox('medication_allergies[]', $medication->id, $patient['medication_allergies']->contains($medication->id) ? true: false  , array('class'=>'form-check-label'));!!}
        				@else
        					{!! Form::checkbox('medication_allergies[]', $medication->id, false, array('class'=>'form-check-input'));!!}
        				@endif	
        				{!! Form::label('medication_allergies[]', $medication->name ,array('class'=>'form-check-label')); !!}
        			</div>
    			@endforeach
    		</div>
		</div>
	</div>		
</div>

	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Hábitos</h3>
			</div>
			<div class="box-body">
				@foreach($habits as $habit)					
					<div class="form-group col-sm-6">
						{{-- If para validar si estamos editando o creando un paciente--}}
    					@if (Route::currentRouteName() == "patients.edit" )
    						{!! Form::checkbox('habits[]', $habit->id, $patient['habits']->contains($habit->id) ? true: false  , array('class'=>'form-check-label'));!!}
    					@else
    						{!! Form::checkbox('habits[]', $habit->id, false, array('class'=>'form-check-input'));!!}
    					@endif						
						{!! Form::label('habit', $habit->name ,array('class'=>'form-check-label')); !!}
					</div>
				@endforeach
			</div>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Ejercicio</h3>
			</div>
			<div class="box-body">
				{{-- Exercises are stored in the DB as habits, that's why we use the same $habit array--}}
				@foreach($exercises as $habit)
				<div class="form-group col-sm-6">
					@if (Route::currentRouteName() == "patients.edit" )
						{!! Form::checkbox('habits[]', $habit->id, $patient['habits']->contains($habit->id) ? true: false  , array('class'=>'form-check-label'));!!}
					@else
						{!! Form::checkbox('habits[]', $habit->id, false, array('class'=>'form-check-input'));!!}
					@endif	
					{!! Form::label('habits', $habit->name ,array('class'=>'form-check-label')); !!}
				</div>
				@endforeach
			</div>
		</div>
	</div>	
	
	@php
	//Associative array of the name in DB and the Label so we can save some lines of code
    $schedule_fields = array('wakes_up'=>'Despierta','breakfast'=>'Desayuno','snack_am'=>'Snack Mañana','lunch'=>'Comida','snack_pm'=>'Snack PM','dinner'=>'Cena','sleeps'=>'Duerme'); 
	@endphp				
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Horarios</h3>
			</div>
			<div class="box-body">
    			@foreach($schedule_fields as $field => $label )
    			 	@php
    			 		//Forming the field name
    			 		$field_name = "schedule_" . $field; 
    			 	@endphp	  
    				<div class="form-group col-sm-4">
    					{!! Form::label('habits', $label ,array('class'=>'form-check-label')); !!}				        				                                                
                        <div class="input-group clockpicker">
        					@if (Route::currentRouteName() == "patients.edit" )
        					@php 
        						//if there's a date stored, we format it so we delete the seconds, otherwise the field is empty
        					   	$time = $patient[$field_name] == null ? "" : date('H:i', strtotime($patient[$field_name])); 
    					    @endphp	
        						<input id="{{$field_name}}" name="{{$field_name}}" type="text" class="form-control input-small" value="{{$time}}">                    		
                            @else
                        		<input id="{{$field_name}}" name="{{$field_name}}" type="text" class="form-control input-small">
                            @endif	
                            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                        </div>
        				
    				</div>    				
    			@endforeach
			</div>
		</div>
	</div>	
	
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Antecedentes</h3>
			</div>
			<div class="box-body">
    			 <div class="form-group col-sm-12">
                    {!! Form::label('past_medications', 'Ha tomado medicamentos para bajar de peso:') !!}                    
            	</div>
            	<div class="form-group col-sm-12">
            		{!! Form::textarea('past_medications', null, ['class' => 'form-control','size' => '30x5']) !!}            		
            	</div>
			</div>
		</div>
	</div>	
	
	
	

    <div class="form-group col-md-12">
    	<h2>Plan de tratamiento</h2>
    	<div class="box box-primary">		
    		<div class="box-body">
        		<div class="box-header with-border">
        			<h3 class="box-title">Alimentos que consume</h3>
        		</div>
        		<div class="box-body">
        			@foreach($foods as $food)
        			<div class="form-group col-sm-3">
        				@if (Route::currentRouteName() == "patients.edit" )
        					{!! Form::checkbox('foods[]', $food->id, $patient['foods']->contains($food->id) ? true: false  , array('class'=>'form-check-label'));!!}
        				@else
        					{!! Form::checkbox('foods[]', $food->id, true, array('class'=>'form-check-input'));!!}
        				@endif	
        				{!! Form::label('foods', $food->name ,array('class'=>'form-check-label')); !!}
        			</div>
        			@endforeach
        		</div>
    		</div>
    	</div>
    </div>
    
    <div class="form-group col-md-12">
    	<h2>Valoración</h2>
    	<div class="box box-primary">		
    		<div class="box-body">
        		<div class="box-header with-border">
        			<h3 class="box-title">Complexión física</h3>
        		</div>
        		<div class="box-body">   
            		@foreach($assessments['complexion_fisica'] as $assessment)
    				<div class="form-group col-sm-3">
    				{!! Form::label('habits', $assessment->label ,array('class'=>'form-check-label')); !!}
    					@if (Route::currentRouteName() == "patients.edit" )
    						{!! Form::text('assessments['.$assessment->id.']',$patient['visit_assessments'][$assessment->id],array('id'=>'assessments['.$assessment->id.']','class' => 'form-control','placeholder' => 'Centímetros'));!!}
    					@else
    						{!! Form::text('assessments['.$assessment->id.']',null,array('id'=>'assessments['.$assessment->id.']','class' => 'form-control','placeholder' => 'Centímetros')); !!}
    					@endif	
    					
    				</div>
    				@endforeach
    				<div class="form-group col-sm-2">
    					{!! Form::label('physical_complexion', 'Complexión física') !!}
						{!! Form::text('physical_complexion', null, ['id'=> 'physical_complexion','class' => 'form-control','readonly' => 'true']) !!}
        			</div>         		        		    
        			      			
        		</div>
        			
        		<div class="box-header with-border">
        			<h3 class="box-title">Peso Ideal</h3>
        		</div>
        		<div class="box-body">   
            		@foreach($assessments['peso'] as $assessment)
    				<div class="form-group col-sm-4">
    				{!! Form::label('habits', $assessment->label ,array('class'=>'form-check-label')); !!}
    					@if (Route::currentRouteName() == "patients.edit" )
    						{!! Form::text('assessments['.$assessment->id.']',$patient['visit_assessments'][$assessment->id],array('id'=>'assessments['.$assessment->id.']','class' => 'form-control','placeholder' => 'Kilogramos'));!!}
    					@else
    						{!! Form::text('assessments['.$assessment->id.']',null,array('id'=>'assessments['.$assessment->id.']','class' => 'form-control','placeholder' => 'Kilogramos')); !!}
    					@endif	
    					
    				</div>
    				@endforeach    				      			      			
        		</div>
        		
        		<div class="box-header with-border">
        			<h3 class="box-title">Porcentaje de Grasa Corporal</h3>
        		</div>
        		<div class="box-body">   
            		@foreach($assessments['porcentaje_grasa_corporal'] as $assessment)
    				<div class="form-group col-sm-4">
    				{!! Form::label('habits', $assessment->label ,array('class'=>'form-check-label')); !!}
    					@if (Route::currentRouteName() == "patients.edit" )
    						{!! Form::text('assessments['.$assessment->id.']',$patient['visit_assessments'][$assessment->id],array('id'=>'assessments['.$assessment->id.']','class' => 'form-control'));!!}
    					@else
    						{!! Form::text('assessments['.$assessment->id.']',null,array('id'=>'assessments['.$assessment->id.']','class' => 'form-control')); !!}
    					@endif	
    					
    				</div>
    				@endforeach
    				<div class="form-group col-sm-4">
    					{!! Form::label('body_fat', '% Grasa Corporal') !!}
						{!! Form::text('body_fat', null, ['id'=>'body_fat','class' => 'form-control','readonly' => 'true']) !!}
        			</div>       			      			
        		</div> 
        		       		
        		<div class="box-header with-border">
        			<h3 class="box-title">Signos</h3>
        		</div>
        		<div class="box-body">   
            		@foreach($assessments['signos'] as $assessment)
    				<div class="form-group col-sm-4">
    				{!! Form::label('habits', $assessment->label ,array('class'=>'form-check-label')); !!}
    					@if (Route::currentRouteName() == "patients.edit" )
    						{!! Form::text('assessments['.$assessment->id.']',$patient['visit_assessments'][$assessment->id],array('id'=>'assessments['.$assessment->id.']','class' => 'form-control'));!!}
    					@else
    						{!! Form::text('assessments['.$assessment->id.']',null,array('id'=>'assessments['.$assessment->id.']','class' => 'form-control')); !!}
    					@endif	
    					
    				</div>
    				@endforeach    				  			      			
        		</div>   
        		   		
        		<div class="box-header with-border">
					<h3 class="box-title">Otras indicaciones</h3>
    			</div>
    			<div class="box-body">        			
                	<div class="form-group col-sm-12">
                		{!! Form::textarea('indications', null, ['class' => 'form-control','size' => '30x5']) !!}
                	</div>
				</div>			
			
    		</div>
    	</div>
    </div>

 <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('patients.index') !!}" class="btn btn-default">Cancelar</a>
    </div>
    
    
@section('views_scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/bower/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/js/functions.js"></script>

     <script type="text/javascript">     
        $( document ).ready(function() { 
        	
        	var patientAge = $('#patient_age').val();
        	var patientGender =  $('input[name=gender]:checked').val();
        	var skinfold = $("#assessments\\[9\\]").val();
        	var height = $("#assessments\\[1\\]").val();			
    		var wristCircumference = $("#assessments\\[6\\]").val();
    		var gender = $('input[name=gender]:checked').val();
            var birthdate = $('#birthdate').val();

            var pathname = window.location.pathname; 

            //Only if we are editing the patient the age, complexion and body fat is calculated. We find the word "edit" in the url 
			if(pathname,indexOf("edit") !== -1){
				$("#patient_age").val(getPatientAge(birthdate));
				/* These functions are defined on public/js/functions.js */
	        	$("#physical_complexion").val(calculatePhysicalComplexion(height,wristCircumference,gender)); 
	        	$("#body_fat").val(calculateBodyFat(patientAge,patientGender,skinfold));
			}            
        	
        	
          	$('.clockpicker').clockpicker({
          		donetext:"Ingresar"
            });
      		
        	$('.datepicker').datepicker({
        	    format: 'dd/mm/yyyy',
        	    orientation:'bottom'        	    
        	});
        	
        	$("#medication_allergies_checkbox").click(function() {  
        		$("#medications_list_div").toggle('slow'); 	        
    	    }); 
    
        	$("#food_allergies_checkbox").click(function() {  
        		$("#foods_list_div").toggle('slow');	        
    	    });         	

        	//Listeners for the inputs when their values change
        	
        	//Calculating Physical Complexion when the values are being introduced.
        	// Double \\are used to escape square brackets in the ids. The complete functions        	
        	$("#assessments\\[1\\], #assessments\\[6\\], input[name=gender]:checked" ).keyup(function(){				
				//calculatePhysicalComplexion(height,wristCircumference,gender);
        		$("#physical_complexion").val(calculatePhysicalComplexion($("#assessments\\[1\\]").val(),$("#assessments\\[6\\]").val(),$('input[name=gender]:checked').val()));	
        	});

        	//Calculating Physical Complexion when the values are being introduced. Double \\are used to escape square brackets in the ids. The complete functions        	
        	$("#birthdate").keyup(function(){				
        		$("#patient_age").val(getPatientAge($("#birthdate").val()));       		
        	});
        	 
        	$("#patient_age,input[name=gender]:checked,#assessments\\[9\\]").keyup(function(){
        		//calculateBodyFat(patientAge,patientGender,skinfold)
            	$("#body_fat").val(calculateBodyFat($('#patient_age').val(),$('input[name=gender]:checked').val(),$("#assessments\\[9\\]").val()));
            });
			
        	
        });
	</script>    
@endsection    