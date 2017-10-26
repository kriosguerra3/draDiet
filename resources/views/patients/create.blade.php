@extends('layouts.app') @section('content')
<section class="content-header">
	<h1>Registro de Nuevo Paciente</h1>
</section>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			@include('adminlte-templates::common.errors') {!! Form::open(['route'
			=> 'patients.store']) !!}
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Datos Personales</h3>
				</div>
				<div class="box-body">@include('patients.fields')</div>
			</div>

			<h2>Historia Clínica</h2>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Enfermedades que padece</h3>
				</div>
				<div class="box-body">
					@foreach($general_illnesses as $illness)
						<div class="form-group col-sm-3">
    						{!! Form::checkbox('illness_'.$illness->id, 'illness_'.$illness->id, false, array('id'=>'illness_'.$illness->id,'class'=>'form-check-label'));!!}
    						{!! Form::label('illness_'.$illness->id, $illness->name ,array('class'=>'form-check-input')); !!}
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
        						{!! Form::checkbox('illness_'.$illness->id, 'illness_'.$illness->id, false, array('id'=>'illness_'.$illness->id,'class'=>'form-check-label'));!!}
        						{!! Form::label('illness_'.$illness->id, $illness->name ,array('class'=>'form-check-input')); !!}
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
    						{!! Form::checkbox('habit_'.$habit->id, 'habit_'.$habit->id, false, array('id'=>'habit_'.$habit->id,'class'=>'form-check-input'));!!}
    						{!! Form::label('habit_'.$habit->id, $habit->name ,array('class'=>'form-check-label')); !!}
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
					@foreach($exercises as $exercise)
					<div class="form-group col-sm-6">
						{!! Form::checkbox('exercise_'.$exercise->id, 'exercise_'.$exercise->id, false, array('id'=>'exercise_'.$exercise->id,'class'=>'form-check-input'));!!}
    					{!! Form::label('exercise_'.$exercise->id, $exercise->name ,array('class'=>'form-check-label')); !!}
					</div>
					@endforeach
				</div>
			</div>
		</div>


        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
            <a href="{!! route('patients.index') !!}" class="btn btn-default">Cancelar</a>
        </div>

		{!! Form::close() !!}

	</div>
</div>
@endsection

@section('views_scripts')
    <script src="/js/views_scripts.js"></script>
@stop
