@extends('layouts/main')
@section('sadrzaj')
<form action="{{route('do-login')}}" class="authForm" method="post">
    @csrf
    <h1>Log in</h1>

    <div class="inputHolder">
        <div class="icon-holder">
            <i class="fas fa-at"></i>
        </div>
        <input type="email" placeholder="E-mail" name="email">
    </div>

    <div class="inputHolder">
        <div class="icon-holder">
            <i class="fas fa-lock"></i>
        </div>
        <input type="password" placeholder="Password" name="password">
    </div>

    <input type="submit" class="btn" value="Log in">

    <p><a href="{{ route('register') }}">Register</a></p>
    <p><a href="{{ route('password-reset-form') }}">Reset password</a></p>
    @error('email')
        <p class="errorBubble bubble">{{ $message }}</p>
    @enderror
    @error('password')
        <p class="errorBubble bubble">{{ $message }}</p>
    @enderror
</form>
@endsection
