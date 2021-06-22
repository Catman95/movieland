@extends('layouts/main')
@section('sadrzaj')


<h3>Username: {{ $user->username }}</h3>
<h3>E-mail: {{ $user->email }}</h3>
<h3>Role ID: {{ $user->role_id }}</h3>
<h3>Online status: {{ $user->online }}</h3>



@endsection