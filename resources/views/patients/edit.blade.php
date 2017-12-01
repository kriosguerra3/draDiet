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
       <div class="box">
           <div class="box-body">
               {!! Form::model($patient, ['route' => ['patients.update', $patient->id], 'method' => 'patch']) !!}
                    @include('patients.fields')
               {!! Form::close() !!}
           </div>
       </div>
   </div>
@endsection
