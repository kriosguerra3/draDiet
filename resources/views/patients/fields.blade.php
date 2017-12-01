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
            
            <!-- Email Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('phone_number', 'Teléfono') !!}
                {!! Form::text('phone_number', old('phone_number'), ['class' => 'form-control']) !!}
            </div>
            
            <!-- Email Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('email', 'Correo electrónico') !!}
                {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
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
					{{-- Tercer parámetro (false) es si va checked--}}
					{!! Form::checkbox('food_allergies','',false, array('id'=>'food_allergies','class'=>'form-check-label'));!!}
				@else
					{!! Form::checkbox('food_allergies', '',false, array('id'=>'food_allergies','class'=>'form-check-input'));!!}
				@endif	
				{!! Form::label('alimentos', 'Alimentos' ,array('class'=>'form-check-label')); !!}
			</div>			
			
			<div id="foods_list_div" class="box-body col-sm-12">
    			@foreach($foods as $food)
        			<div class="form-group col-sm-3">
        				@if (Route::currentRouteName() == "patients.edit" )
        					{!! Form::checkbox('food_allergies[]', $food->id, $patient['foods']->contains($food->id) ? true: false  , array('class'=>'form-check-label'));!!}
        				@else
        					{!! Form::checkbox('food_allergies[]', $food->id, false, array('class'=>'form-check-input'));!!}
        				@endif	
        				{!! Form::label('foods', $food->name ,array('class'=>'form-check-label')); !!}
        			</div>
    			@endforeach
    		</div>
    		
    		<div class="form-group col-sm-12">
				@if (Route::currentRouteName() == "patients.edit" )
					{{-- Tercer parámetro (false) es si va checked--}}
					{!! Form::checkbox('medication_allergies', '',false, array('id'=>'medication_allergies', 'class'=>'form-check-label'));!!}
				@else
					{!! Form::checkbox('medication_allergies', '',false, array('id'=>'medication_allergies','class'=>'form-check-input'));!!}
				@endif	
				{!! Form::label('medicamentos', 'Medicamentos' ,array('class'=>'form-check-label')); !!}
			</div>
			
    		<div id="medications_list_div" class="box-body col-sm-12">
    			@foreach($medications as $medication)
        			<div class="form-group col-sm-3">
        				@if (Route::currentRouteName() == "patients.edit" )
        					{!! Form::checkbox('medication_allergies[]', $medication->id, $patient['medication']->contains($medication->id) ? true: false  , array('class'=>'form-check-label'));!!}
        				@else
        					{!! Form::checkbox('medication_allergies[]', $medication->id, false, array('class'=>'form-check-input'));!!}
        				@endif	
        				{!! Form::label('foods', $medication->name ,array('class'=>'form-check-label')); !!}
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

 <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('patients.index') !!}" class="btn btn-default">Cancelar</a>
    </div>
    
    
@section('views_scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script>
        $( document ).ready(function() { 
			//Hiding these sections on load
        	$("#medications_list_div, #foods_list_div").hide();
                   	
        	$('.datepicker').datepicker({
        	    format: 'dd/mm/yyyy',
        	    orientation:'bottom'        	    
        	});

    	$("#medication_allergies").click(function() {  
    		$("#medications_list_div").toggle('slow'); 	        
	    }); 

    	$("#food_allergies").click(function() {  
    		$("#foods_list_div").toggle('slow');	        
	    }); 
        	  	
        });
	</script>    
@stop    