@extends('layouts/admin')
@section('panelTopIcon')
<i class="fas fa-chart-pie"></i>
@endsection
@section('panelTopTitle')
Overview
@endsection
@section('sadrzaj')
<div id="fancyCards">
    @for($i = 0; $i < 4; $i++)
    <div class="fancyCard">
        <div class="fancyCardTop">
        <i class="fas fa-users"></i>
        <p>123</p>
        </div>
        <div class="fancyCardBottom">
            <p>Users</p>
        </div>
    </div>
    @endfor
</div>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Activity</th>
            <th>User</th>
            <th>IP address</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody id="activity-log-table">
        <tr>
            <td colspan="6">Rezultati će se pojaviti ovde</td>
        </tr>
    </tbody>
</table>
@endsection