@extends('web.auth.app')

@section('Title','Signup')


@section('main')
<h4>Hello! let's get started</h4>
<h6 class="font-weight-light">Sign up to continue.</h6>
<form method="POST" action="{{ route('cust.signup.logic') }}" class="pt-3">
    @csrf
    {{-- {!! Form::open(['method'=> 'post','route' => ['cust.signup.logic'],['class' => 'pt-3']]) !!} --}}
    
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
        <input type="phone" value="{{ old('phone') }}" class="form-control form-control-lg" id="phone" placeholder="Phone Number" required name="phone">
    </div>
    
    
    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
    </div>
    

    <div class="text-center mt-4 font-weight-light">
         do you want login as customer? <a href="{{ route('cust.login.view') }}" class="">Click Here</a>
    </div>
    
</form>
{{-- {!! Form::close() !!} --}}
@endsection
