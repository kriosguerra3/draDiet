<li class="{{ Request::is('assessments*') ? 'active' : '' }}">
    <a href="{!! route('assessments.index') !!}"><i class="fa fa-edit"></i><span>Assessments</span></a>
</li>

<li class="{{ Request::is('exercises*') ? 'active' : '' }}">
    <a href="{!! route('exercises.index') !!}"><i class="fa fa-edit"></i><span>Exercises</span></a>
</li>

<li class="{{ Request::is('foods*') ? 'active' : '' }}">
    <a href="{!! route('foods.index') !!}"><i class="fa fa-edit"></i><span>Foods</span></a>
</li>

<li class="{{ Request::is('habits*') ? 'active' : '' }}">
    <a href="{!! route('habits.index') !!}"><i class="fa fa-edit"></i><span>Habits</span></a>
</li>

<li class="{{ Request::is('illnesses*') ? 'active' : '' }}">
    <a href="{!! route('illnesses.index') !!}"><i class="fa fa-edit"></i><span>Illnesses</span></a>
</li>

<li class="{{ Request::is('medications*') ? 'active' : '' }}">
    <a href="{!! route('medications.index') !!}"><i class="fa fa-edit"></i><span>Medications</span></a>
</li>

<li class="{{ Request::is('patients*') ? 'active' : '' }}">
    <a href="{!! route('patients.index') !!}"><i class="fa fa-edit"></i><span>Patients</span></a>
</li>

<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Roles</span></a>
</li>

<li class="{{ Request::is('schedules*') ? 'active' : '' }}">
    <a href="{!! route('schedules.index') !!}"><i class="fa fa-edit"></i><span>Schedules</span></a>
</li>

<li class="{{ Request::is('supplements*') ? 'active' : '' }}">
    <a href="{!! route('supplements.index') !!}"><i class="fa fa-edit"></i><span>Supplements</span></a>
</li>

<li class="{{ Request::is('visits*') ? 'active' : '' }}">
    <a href="{!! route('visits.index') !!}"><i class="fa fa-edit"></i><span>Visits</span></a>
</li>

