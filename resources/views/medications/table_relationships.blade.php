<h3 class="text-center">Medicamentos</h3>
<h3 class="pull-right">
	<a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('medications.create') !!}"><i class="glyphicon glyphicon-plus"></i> Nuevo Medicamento</a>
</h3>
<table class="table table-responsive" id="medications-table">
    <thead class="">
        <tr>
            <th>Nombre</th>
        	<th>Dosis</th>
            <th colspan="3">Acción</th>
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
                        <a href="{!! route('relationships.create', [$medication->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-link"></i></a>                    
                        <a href="{!! route('medications.edit', [$medication->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
    	@endforeach    		
    </tbody>
</table>