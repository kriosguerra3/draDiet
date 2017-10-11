@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Medication
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($medication, ['route' => ['medications.update', $medication->id], 'method' => 'patch']) !!}

                        @include('medications.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection