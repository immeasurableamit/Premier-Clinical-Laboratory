@extends('web.auth.app')

@section('Title','Login')


@section('main')
<h4>Hello! let's get started</h4>
<h6 class="font-weight-light">Set new password</h6>
<form method="POST" action="{{ route('update.password') }}" class="pt-3">
    @csrf
    {{-- {!! Form::open(['method'=> 'post','route' => ['login'],['class' => 'pt-3']]) !!} --}}


    {!! Form::hidden('user_token',$id)!!}
    <div class="form-group">
        <input type="password" value="{{ old('password') }}" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Enter your new password " required name="password">
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-lg" id="password" placeholder="Confirm  your new password" required name="password_confirmation">
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"> Update Password </button>
    </div>
    {{-- <div class="my-2 d-flex justify-content-between align-items-center">
        <div class="form-check">
            <label class="form-check-label text-muted">
                <input type="checkbox" class="form-check-input">
                Keep me signed in
            </label>
        </div>
         <a href="{{ route('forgot') }}" class="auth-link text-black">Forgot password?</a>
    </div>

  <div class="text-center mt-4 font-weight-light">
         do you want login as employee? <a href="{{ route('emp.login.view') }}" class="">Click Here</a>
    </div> --}}
</form>
{{-- {!! Form::close() !!} --}}
@endsection
