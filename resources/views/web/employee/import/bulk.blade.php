@extends('web.layout.default')
@section('Title','Import Employees Bulk')


@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 col-xl-9 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Import Employees </h3>

                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h5>*Download Sample File <a download href="{{ asset('demos/demo.xlsx') }}">  Download</a>   </h5>

                    <hr>
                        {!! Form::open(['route' => 'admin.employess.import.store','method' => 'post','files' => true]) !!}

                        <div class="form-group row">
                            <label for="emp_name" class="col-sm-3 col-form-label">Upload file</label>
                            <div class="col-sm-9">
                             {!! Form::file('import', ['required'=> 'required']) !!}
                            </div>
                        </div>


                        {!! Form::submit('Import', ['class' => 'btn btn-primary']) !!}

                        {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
