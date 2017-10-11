@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Assessment
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($assessment, ['route' => ['assessments.update', $assessment->id], 'method' => 'patch']) !!}

                        @include('assessments.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection