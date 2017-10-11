<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Dose Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('dose', 'Dose:') !!}
    {!! Form::textarea('dose', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('medications.index') !!}" class="btn btn-default">Cancel</a>
</div>
