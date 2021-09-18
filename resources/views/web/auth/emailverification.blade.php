@extends('web.auth.app')

@section('Title','Verify OTP')


@section('main')
<p>Six Digit OTP has been sent to your email <span>  {{ Session::get('email') }} </span></p>
@if (Session::get('phone'))
<p>And also your Phone number <span>  {{ Session::get('phone') }} </span></p>

@endif
<h6 class="font-weight-light">Please verify to continue.</h6>
<form method="POST" action="{{ route('verifymethod') }}" class="pt-3">
    @csrf
    {{-- {!! Form::open(['method'=> 'post','route' => ['verifymethod'],['class' => 'pt-3']]) !!} --}}
    <div class="form-group">
        <input type="hidden" value="{{ Session::get('email') }}" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Enter OTP" required name="email">
    </div>

    <div class="form-group">
        <input type="text" value="{{ old('otp') }}" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Enter OTP" required name="emailotp">
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Click to Verify</button>
    </div>



</form>
{{-- {!! Form::close() !!} --}}
@endsection
