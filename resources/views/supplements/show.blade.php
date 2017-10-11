@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Supplement
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('supplements.show_fields')
                    <a href="{!! route('supplements.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
