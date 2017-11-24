@extends('layouts.app')
@section('css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
@stop
@section('content')
    <section class="content-header">
        <h1>
            Patient
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($patient, ['route' => ['patients.update', $patient->id], 'method' => 'patch']) !!}
                        @include('patients.fields')
                   {!! Form::close() !!}
               </div>
           </div>
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