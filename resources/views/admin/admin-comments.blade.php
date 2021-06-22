@extends('layouts/admin')
@section('panelTopIcon')
<i class="fas fa-comments"></i>
@endsection
@section('panelTopTitle')
Comments
@endsection
@section('sadrzaj')
<input type="text" id="commentSearch" placeholder="Comment search">
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Comment</th>
            <th>User</th>
            <th>Movie</th>
            <th>Time <i class="fas fa-sort"></i></th>
            <th>Controls</th>
        </tr>
    </thead>
    <tbody id="admin-comments-table">
        <tr>
            <td colspan="6">Rezultati će se pojaviti ovde</td>
        </tr>
    </tbody>
</table>
@endsection