<table class="table table-responsive" id="habits-table">
    <thead>
        <tr>
            <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($habits as $habit)
        <tr>
            <td>{!! $habit->name !!}</td>
            <td>
                {!! Form::open(['route' => ['habits.destroy', $habit->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('habits.show', [$habit->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('habits.edit', [$habit->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>