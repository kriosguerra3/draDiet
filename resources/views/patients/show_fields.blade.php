<!-- Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $patient->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Nombre(s):') !!}
    <p>{!! $patient->name !!}</p>
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('last_name', 'Apellidos:') !!}
    <p>{!! $patient->last_name !!}</p>
</div>

<!-- Gender Field -->
<div class="form-group col-sm-4">
    {!! Form::label('gender', 'Sexo:') !!}    
   <p>@lang('messages.genders.'.$patient->gender)</p>
    
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-4">
    {!! Form::label('birthdate', 'Fecha de Nacimiento:') !!}  	
	    
    <p>{!! \Carbon\Carbon::parse($patient->birthdate)->format('d/F/Y') !!}</p>
 
</div>

<!-- Age Field -->
<div class="form-group col-sm-4">
    {!! Form::label('Age', 'Edad:') !!}  	
	    
    <p>{!! $patient->age() !!} Años</p>
    
 
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-4">
    {!! Form::label('phone_number', 'Teléfono:') !!}
    <p>{!! $patient->phone_number !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $patient->user_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-4">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $patient->created_at !!}</p>
</div>



