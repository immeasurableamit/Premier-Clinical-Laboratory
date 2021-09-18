@extends('web.layout.default')
@section('Title','Create Employee')


@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-6 col-xl-9 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Create  Employee</h3>
                </div>
                <div class="col-6 col-xl-3 mb-4 mb-xl-0">
                     {{-- <a href="{{ route('admin.employess.import.view') }}" class="btn btn-primary pull-right">
                        <i class="ti ti-import mr-1"></i>
                         Import Bulk </a> --}}
                </div>
            </div>
        </div>
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                {!! Form::open(['route' => [ 'admin.employess.store' ],'files' => true,'class' => 'validate'])	!!}
                    {{-- <form class="forms-sample"> --}}
                        @include('web.employee.form')
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
