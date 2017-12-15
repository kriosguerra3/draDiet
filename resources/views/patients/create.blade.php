@extends('layouts.app') 
@section('content')
<section class="content-header">
	<h1>Registro de Nuevo Paciente</h1>
</section>
<div class="content">
	<div class="row">
		<div class="col-md-12">
			@include('adminlte-templates::common.errors') 
			{!! Form::open(['route'=> 'patients.store']) !!}
			<div class="box">				
				<div class="box-body">@include('patients.fields')</div>
			</div>
		</div>
		{!! Form::close() !!}

	</div>
</div>
@endsection
