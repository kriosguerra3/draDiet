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

