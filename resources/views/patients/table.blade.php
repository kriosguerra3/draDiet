<table class="table table-responsive" id="patients-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Birthdate</th>
        <th>Phone Number</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($patients as $patient)
        <tr>
            <td>{!! $patient->name !!}</td>
            <td>{!! $patient->last_name !!}</td>
            <td>{!! $patient->gender !!}</td>
            <td>{!! $patient->birthdate !!}</td>
            <td>{!! $patient->phone_number !!}</td>
            <td>{!! $patient->user_id !!}</td>
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