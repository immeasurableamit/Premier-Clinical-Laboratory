@extends('web.layout.default')
@section('Title','add Employee')


@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 col-xl-9 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Add </h3>
                </div>
            </div>
        </div>
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                {!! Form::open(['route' => [ 'admin.manage.store' ],'files' => true])	!!}
                    {{-- <form class="forms-sample"> --}}
                        @include('web.employee.site.form')
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="button" class="btn btn-light cancel">Cancel</button>
                    {{-- </form> --}}
            {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
