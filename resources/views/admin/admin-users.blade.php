@extends('layouts/admin')
@section('panelTopIcon')
<i class="fas fa-users"></i>
@endsection
@section('panelTopTitle')
Users
@endsection
@section('sadrzaj')
<input type="text" id="userSearch" placeholder="Find by username">
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>E-mail</th>
            <th>Role ID</th>
            <th>Online</th>
            <th colspan="2">Controls</th>
        </tr>
    </thead>
    <tbody id="admin-users-table">
        
    </tbody>
</table>
<div class="flex-neutralizer">
    <div class="pagination"></div>
</div>
@endsection