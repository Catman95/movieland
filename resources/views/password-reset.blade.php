@extends('layouts.main')
@section('sadrzaj')
    <form action="{{route('password-reset')}}" method="post" class="coolForm">
        @csrf
        <h1>Password reset</h1>
        <p>We will send you a new password. You will be able to change it later.</p>
        <input type="email" name="email" placeholder="E-mail">
        @error('email')
        <p class="error">{{$message}}</p>
        @enderror
        <input type="submit" class="btn">
    </form>
@endsection
