@extends('layouts/main')
@section('sadrzaj')
<form action="/register" class="authForm" method="post">
    @csrf
    <h1>Register</h1>
    
    <div class="inputHolder">
        <div class="icon-holder">
            <i class="fas fa-user"></i>
        </div>
        <input type="text" placeholder="Username" name="username">
    </div>

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

    <div class="inputHolder">
        <div class="icon-holder">
            <i class="fas fa-key"></i>
        </div>
        <input type="password" placeholder="Confirm password" name="password_confirmation">
    </div>
    
    <input type="submit" class="btn" value="Register">

    <p><a href="{{ route('login') }}">Log in</a></p>

    @error('username')
        <p class="bubble errorBubble">{{ $message }}</p>
    @enderror
    @error('email')
        <p class="bubble errorBubble">{{ $message }}</p>
    @enderror
    @error('password')
        <p class="bubble errorBubble">{{ $message }}</p>
    @enderror
    @error('confirm_password')
        <p class="bubble errorBubble">{{ $message }}</p>
    @enderror

</form>

@endsection