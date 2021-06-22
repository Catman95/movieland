@extends('layouts/main')
@section('sadrzaj')
<div id="author">
    <h1>Aleksandar Stanković 33/17</h1>
    <div id="author-img">
        <img src="{{ asset('assets/images/prva.jpg') }}" alt="">
    </div>
    <div id="author-text">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
    <div id="author-social">
        <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
        <a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a>
        <a href="#" target="_blank"><i class="fab fa-github-square"></i></a>
        <a href="#" target="_blank"><i class="fab fa-twitter-square"></i></a>
    </div>
    <div id="contact-div">
        <h3>Contact me</h3>
        <form action="/contact-author" method="post" id="contact-form">
            @csrf
            <input type="email" placeholder="E-mail" name="email">
            <input type="text" placeholder="Full name" name="name">
            <textarea id="contact-text" placeholder="Your message goes here" name="message"></textarea>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>
@endsection