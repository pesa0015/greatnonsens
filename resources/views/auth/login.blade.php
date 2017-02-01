@extends('layouts.standard')

@section('content')

<form class="form-horizontal" method="POST" action="login">
    {{ csrf_field() }}
    <input type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
    <input id="password" type="password" class="form-control" name="password" required>
    @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
    <input type="submit" value="Logga in">
    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
</form>
@endsection
