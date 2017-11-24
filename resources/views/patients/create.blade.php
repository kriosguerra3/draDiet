@extends('layouts.app') 
@section('css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
@stop
@section('content')
<section class="content-header">
	<h1>Registro de Nuevo Paciente</h1>
</section>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			@include('adminlte-templates::common.errors') 
			{!! Form::open(['route'=> 'patients.store']) !!}
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Datos Personales</h3>
				</div>
				<div class="box-body">@include('patients.fields')</div>
			</div>
		</div>
		{!! Form::close() !!}

	</div>
</div>
@endsection

@section('views_scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script>
        $( document ).ready(function() {        	
        	$('.datepicker').datepicker({
        	    format: 'dd/mm/yyyy',
        	    orientation:'bottom'        	    
        	});        	
        });
	</script>    
@stop
