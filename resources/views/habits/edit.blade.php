@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Habit
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($habit, ['route' => ['habits.update', $habit->id], 'method' => 'patch']) !!}

                        @include('habits.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection