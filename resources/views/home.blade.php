@extends('layouts/main')
@section('sadrzaj')
<h3><i class="fas fa-film">&nbsp;</i>Recently added</h3>
<div class="testRow">
    @for($i = 0; $i < 4; $i++)
        @component('components.movie-thumbnail', [
            'movie' => $flex1[$i]
        ])
        @endcomponent
    @endfor
</div>
<h3><i class="fas fa-star">&nbsp;</i>Best rated</h3>
<div class="testRow">
    @for($i = 0; $i < 4; $i++)
        @component('components.movie-thumbnail', [
            'movie' => $flex2[$i]
        ])
        @endcomponent
    @endfor
</div>
<h3><i class="fas fa-comment">&nbsp;</i>Most commented</h3>
<div class="testRow">
    @for($i = 0; $i < 4; $i++)
        @component('components.movie-thumbnail', [
            'movie' => $flex3[$i]
        ])
        @endcomponent
    @endfor
</div>
<!--<h3><i class="fas fa-comment">&nbsp;</i>Most commented</h3>
<div class="testRow">
    <div class="card">
        <img src="uploads/jumanjui.jpg">
    </div>
    <div class="card">
        <img src="uploads/jumanjui.jpg">
    </div>
    <div class="card">
        <img src="uploads/jumanjui.jpg">
    </div>
    <div class="card">
        <img src="uploads/jumanjui.jpg">
    </div>
</div>-->
@endsection
