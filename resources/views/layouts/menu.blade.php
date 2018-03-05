<li class="{{ Request::is('patients*') ? 'active' : '' }}">
    <a href="{!! route('patients.index') !!}"><i class="fa fa-edit"></i><span>Pacientes</span></a>    
</li>
<li class="{{ Request::is('relationships*') ? 'active' : '' }}">
	<a href="{!! route('relationships.index') !!}"><i class="fa fa-edit"></i><span>Relaciones</span></a>
</li>

