@extends('layouts/main')
@section('sadrzaj')

    <div class="profileCard">
        <div class="left">
            <img src="{{session()->get('user')->avatar}}" alt="">
        </div>
        <div class="right">
            <form action="{{route('user-update', session()->get('user')->id)}}" method="post" class="coolForm">
                @csrf
                @method('PATCH')
                <label for="username" class="firstLabel">Username</label>
                <input type="text" id="username" disabled value="{{session()->get('user')->username}}">
                <label for="email">E-mail</label>
                <input type="text" id="email" disabled value="{{ session()->get('user')->email }}" name="email">
                <label for="oldPassword">Old Password</label>
                <input type="password" id="oldPassword" name="old_password">
                @error('old_password')
                <div class="error">{{ $message }}</div>
                @enderror
                <label for="password">New Password</label>
                <input type="password" id="password" name="password">
                @error('password')
                <div class="error">{{ $message }}</div>
                @enderror
                <label for="password">Confirm New Password</label>
                <input type="password" id="password" name="password_confirmation">
                @error('password_confirmation')
                <div class="error">{{ $message }}</div>
                @enderror
                <input type="submit" value="Update password" class="btn">
            </form>
        </div>
    </div>

@endsection
