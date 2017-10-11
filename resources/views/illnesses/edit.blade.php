@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Illness
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($illness, ['route' => ['illnesses.update', $illness->id], 'method' => 'patch']) !!}

                        @include('illnesses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection