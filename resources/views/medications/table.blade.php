<table class="table table-responsive" id="medications-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Dose</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($medications as $medication)
        <tr>
            <td>{!! $medication->name !!}</td>
            <td>{!! $medication->dose !!}</td>
            <td>
                {!! Form::open(['route' => ['medications.destroy', $medication->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('medications.show', [$medication->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('medications.edit', [$medication->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>