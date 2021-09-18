@extends('web.layout.default')
@section('Title','Add Customer ')
@section('main')

<style>

.iti {

    width: 100%;
}

</style>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-6 col-xl-9 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Add  Customer</h3>
                </div>

            </div>
        </div>
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <form method="POST" action="{{ route('employee.customeraddlogic') }}" class="pt-3">
    @csrf
    {{-- {!! Form::open(['method'=> 'post','route' => ['employee.customeraddlogic'],['class' => 'pt-3']]) !!} --}}

    <div class="form-group">
        <input type="text" value="{{ old('firstname') }}" class="form-control form-control-lg" id="firstname" placeholder="First Name" required name="firstname">
    </div>
    <div class="form-group">
        <input type="text" value="{{ old('lastname') }}" class="form-control form-control-lg" id="lastname" placeholder="Last Name" required name="lastname">
    </div>
    <div class="form-group">
        <input type="date" value="{{ old('dob') }}" class="form-control form-control-lg" id="dob" placeholder="Date of birth" required name="dob">
    </div>
    <div class="form-group">
        <input type="email" value="{{ old('email') }}" class="form-control form-control-lg" id="email" placeholder="Email Address" required name="email">
    </div>
    <div class="form-group">
        <input type="phone" value="{{ old('phone') }}" class="form-control form-control-lg" placeholder="Phone Number" required name="phone">
    </div>
    {{-- <div class="form-group">
        <label for="">Select Date</label>
        {!! Form::date('date', null, ['class'=> 'form-control' ,'placeholder' => 'Please Select Date','required' => 'required']) !!}
    </div> --}}
    <div class="form-group">
        {!! Form::select('gender', config('constant.gender'), null, ['class'=> 'form-control' ,'placeholder' => 'Gender' ,'required' => 'required']) !!}
    </div>
    <div class="form-group">
        <label for="">Select Test type</label>
        {!! Form::select('package_type', config('constant.test-type'), $item->site_id ?? null, ['class'=> 'form-control']) !!}
    </div>


    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Add Customer</button>
    </div>




</form>
{{-- {!! Form::close() !!} --}}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
