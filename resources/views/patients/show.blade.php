@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Patient
        </h1>
         
    </section>
    <div class="content">
    
    	    	
        <div class="box box-primary">
            <div class="box-body">
           		
                <div class="row" style="padding-left: 20px">
                    @include('patients.show_fields')
                   
                </div>
            </div>
            <div class="panel panel-default">
      			<div class="panel-body"><a href="{!! route('patients.index') !!}" class="btn btn-default">Regresar</a></div>
    		</div>
        </div>
    </div>
@endsection
