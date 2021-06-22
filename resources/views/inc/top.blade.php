<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{asset('assets/images/popcorn.png')}}" type="image/gif" sizes="128x128">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <!--<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed&display=swap" rel="stylesheet">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zemlja filmova</title>
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
</head>

<body>
    <div id="wrapper">
        <div id="dashboard">
            <p>{{ session()->has('user') ? "Welcome, " . session()->get('user')->username . "!" : "You are not logged in" }}</p>
            <nav id="dashboardNav">
                @if(session()->has('user'))
                    @if(session()->get('user')->role_id === 1)
                        <a href="{{ route('admin-overview') }}">Admin</a>
                    @endif
                    <a href="{{ route('profile') }}">Profile</a>
                    <a href="{{ route('logout') }}">Log out</a>
                @else
                <a href="{{ route('login') }}">Log in</a> / <a href="{{ route('register') }}">Register</a>
                @endif
            </nav>
        </div>
        <header class="regular-padding">
            <div id="logo">
                <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo7.png') }}" alt=""></a>
            </div>
            <nav id="header-nav">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('browse') }}">Browse</a></li>
                    <li><a href="{{ route('author') }}">Contact</a></li>
                </ul>
            </nav>
            <div id="burger">
                <i class="fas fa-bars"></i>
            </div>
        </header>
        <main>
            <div id="drawer">
                <nav id="drawer-nav">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('browse') }}">Browse</a></li>
                        <li><a href="{{ route('author') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
