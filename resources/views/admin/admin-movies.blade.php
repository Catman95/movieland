@extends('layouts/admin')
@section('panelTopIcon')
<i class="fas fa-film"></i>
@endsection
@section('panelTopTitle')
Movies
@endsection
@section('sadrzaj')
<a href="{{route('movies-create')}}" id="createMovieBtn" class="btn">Add a new movie</a>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Review</th>
            <th>Type</th>
            <th>Rating <i class="fas fa-sort"></i></th>
            <th>Runtime <i class="fas fa-sort"></i></th>
            <th>Year <i class="fas fa-sort"></i></th>
            <th colspan="3">Controls</th>
        </tr>
    </thead>
    <tbody id="admin-movies-table">
        <tr>
            <td colspan="6">Rezultati će se pojaviti ovde</td>
        </tr>
    </tbody>
</table>
<div class="flex-neutralizer"><div class="pagination"></div></div>
@endsection