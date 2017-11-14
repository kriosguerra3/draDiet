<table class="table table-responsive" id="malaises-table">
    <thead>
        <tr>
            <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($malaises as $malaise)
        <tr>
            <td>{!! $malaise->name !!}</td>
            <td>
                {!! Form::open(['route' => ['malaises.destroy', $malaise->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('malaises.show', [$malaise->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('malaises.edit', [$malaise->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>