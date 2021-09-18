@extends('web.auth.app')

@section('Title','Login')


@section('main')
<h4>Forgot password?</h4>
<h6 class="font-weight-light">Reset password in two quick steps</h6>

<form method="get" action="{{ route('user.check.mail') }}" class="pt-3">
    @csrf
    {{-- {!! Form::open(['method'=> 'post','route' => ['login'],['class' => 'pt-3']]) !!} --}}
    <div class="form-group">
        <input type="email" value="{{ old('email') }}" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Enter you email" required name="email">
    </div>
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Reset password</button>
    </div>
    <div class="text-center mt-4 font-weight-light">
          <a class="btn btn-info" href="{{ route('login.view') }}" class="">Back</a>
    </div>
</form>
{{-- {!! Form::close() !!} --}}
@endsection
