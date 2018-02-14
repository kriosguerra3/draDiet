<table class="table table-responsive" id="patients-table">
    <thead>
        <tr>
            <th>Nombre</th>
        <th>Apellidos</th>
        <th>Género</th>
        <th>Fecha de Nacimiento</th>
        <th>Teléfono</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>    
   
    @foreach($patients as $patient)
        <tr>
            <td>{!! $patient->name !!}</td>
            <td>{!! $patient->last_name !!}</td>
            <td> @lang('messages.genders.'.$patient->gender) </td>
            <td><p>{!! \Carbon\Carbon::parse($patient->birthdate)->format('d/F/Y') !!}</p></td>
            <td>{!! $patient->phone_number !!}</td>
            <td>
                {!! Form::open(['route' => ['patients.destroy', $patient->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('patients.show', [$patient->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('patients.edit', [$patient->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>