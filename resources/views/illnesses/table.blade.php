<table class="table table-responsive" id="illnesses-table">
    <thead>
        <tr>
            <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($illnesses as $illness)
        <tr>
            <td>{!! $illness->name !!}</td>
            <td>
                {!! Form::open(['route' => ['illnesses.destroy', $illness->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('illnesses.show', [$illness->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('illnesses.edit', [$illness->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>