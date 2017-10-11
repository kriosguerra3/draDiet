<table class="table table-responsive" id="visits-table">
    <thead>
        <tr>
            <th>Patient Id</th>
        <th>Date</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($visits as $visit)
        <tr>
            <td>{!! $visit->patient_id !!}</td>
            <td>{!! $visit->date !!}</td>
            <td>{!! $visit->user_id !!}</td>
            <td>
                {!! Form::open(['route' => ['visits.destroy', $visit->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('visits.show', [$visit->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('visits.edit', [$visit->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>