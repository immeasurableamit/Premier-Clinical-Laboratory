@extends('web.auth.app')

@section('Title','Login')


@section('main')
<h3> <b>Employee Login</b></h3>
<h6 class="font-weight-light">Sign in for Employee.</h6>
<form method="POST" action="{{ route('emp.login') }}" class="pt-3">
    @csrf
    {{-- {!! Form::open(['method'=> 'post','route' => ['login'],['class' => 'pt-3']]) !!} --}}
    <div class="form-group">
        <input type="email" value="{{ old('email') }}" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="email" required name="email">
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required name="password">
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
    </div>
    <div class="my-2 d-flex justify-content-between align-items-center">
        <div class="form-check">
            <label class="form-check-label text-muted">
                <input type="checkbox" class="form-check-input">
                Keep me signed in
            </label>
        </div>
        <a href="{{ route('forgot.emp') }}" class="auth-link text-black">Forgot password?</a>
    </div>

    {{-- <div class="text-center mt-4 font-weight-light">
         do you want login as site manger? <a href="{{ route('login.view') }}" class="">Click Here</a>
    </div> --}}
</form>
{{-- {!! Form::close() !!} --}}
@endsection
