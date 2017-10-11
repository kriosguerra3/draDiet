@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Supplement
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($supplement, ['route' => ['supplements.update', $supplement->id], 'method' => 'patch']) !!}

                        @include('supplements.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection