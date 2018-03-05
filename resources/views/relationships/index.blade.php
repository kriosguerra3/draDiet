@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Administrador de Relaciones</h1>        
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
            	<ul class="nav nav-tabs">
                  <li class="active"><a href="#medications_tab" data-toggle="tab">Medicamentos</a></li>
                  <li><a href="#supplements_tab" data-toggle="tab">Suplementos</a></li>
                  <li><a href="#illnesses_tab" data-toggle="tab">Enfermedades</a></li>
                  <li><a href="#malaises_tab" data-toggle="tab">Malestares</a></li>
                </ul>
                               
          <div class="tab-content clearfix">     
                <div class="tab-pane active" id="medications_tab">          			
          			@include('medications.table_relationships')
				</div>
				<div class="tab-pane" id="supplements_tab">
          			@include('supplements.table')
				</div>
				<div class="tab-pane" id="illnesses_tab">
          			@include('illnesses.table')
				</div>
				<div class="tab-pane" id="malaises_tab">
          			@include('malaises.table')
				</div>
				
          </div>
                
            </div>
            
            
        </div>
    </div>
@endsection

