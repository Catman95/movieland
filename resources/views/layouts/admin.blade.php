@include('inc/top')
<div id="adminWrapper">
    @include('inc/admin-nav')
    <div id="adminPanel">
        <div class="panelTop">
            <div class="icon-holder">
                @yield('panelTopIcon')
            </div>
            <p>@yield('panelTopTitle')</p>
        </div>
        <div id="panelContent">
            @yield('sadrzaj')
        </div>
    </div>
</div>
@include('inc/bottom')