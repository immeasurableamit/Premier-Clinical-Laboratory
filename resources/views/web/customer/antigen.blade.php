@extends('web.layout.default')
@section('Title','Request Antigen Test')

@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 col-xl-9 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">{{ $title }} </h3>
                </div>
            </div>
        </div>
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                {!! Form::open(['route' => 'customer.antigen.store','files' => true,'method'=> 'post'])	!!}
                        @include('web.customer.form')
                        <button type="submit" class="btn btn-primary mr-2">Send</button>
                        <button type="button" class="btn btn-light cancel">Cancel</button>
                {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
