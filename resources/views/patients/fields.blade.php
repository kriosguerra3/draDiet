<script>
$( document ).ready(function() {
	alert(1);
});
</script>


<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombres:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', 'Apellidos:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Género:') !!}    
    <br>
    {!! Form::radio('gender', 'female', false, array('id'=>'female','class'=>'custom-control custom-radio'));!!}
    {!! Form::label('female', 'Femenino'); !!}    
    {!! Form::radio('gender', 'male', false, array('id'=>'male','class'=>'custom-control custom-radio'));!!}
    {!! Form::label('male', 'Masculino'); !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6">
	{!! Form::label('birthdate', 'Fecha de Nacimiento:') !!} {!!
	Form::date('birthdate', null, ['class' => 'form-control']) !!}

	<div class="input-group date" data-provide="datepicker">
		<input type="text" class="form-control">
		<div class="input-group-addon">
			<span class="glyphicon glyphicon-th"></span>
		</div>
	</div>

</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', 'Teléfono') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
</div>


