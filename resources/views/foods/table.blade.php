<table class="table table-responsive" id="foods-table">
    <thead>
        <tr>
            <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($foods as $food)
        <tr>
            <td>{!! $food->name !!}</td>
            <td>
                {!! Form::open(['route' => ['foods.destroy', $food->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('foods.show', [$food->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('foods.edit', [$food->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>