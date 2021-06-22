@extends('layouts/main')
@section('sadrzaj')
<h1>Mail uspešno poslat!</h1>
<h2>{{$data['email']}}</h2>
<h2>{{$data['full_name']}}</h2>
<p>{{$data['message']}}</p>
@endsection