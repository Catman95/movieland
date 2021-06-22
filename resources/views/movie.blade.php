@extends('layouts/main')
@section('sadrzaj')
<input type="hidden" id="movie_id" value="{{$movie->id}}">

<div id="movie-data-container">
    <div id="movie-data-top">
        <div id="movie-data-poster">
            <img src="{{ substr($movie->poster_url, 0, 4) == 'http' ? $movie->poster_url : '/' . $movie->poster_url}}" alt="Poster">
        </div>
        <div id="movie-data-details">
            <div class="movie-data-title">
                <h1>{{ $movie->title }} ({{ $movie->type }})</h1>
            </div>
            <ul>
                <li><div class="icon-holder"><i class="fas fa-star"></i></div>{{ $movie->imdb_rating }}</li>
                <li><div class="icon-holder"><i class="fas fa-film"></i></div>
                    @foreach($movie->genres as $genre)
                        <span class="genreSpan">{{$genre->genre}}</span>
                    @endforeach
                </li>
                <li><div class="icon-holder"><i class="fas fa-calendar"></i></div>{{ $movie->release_year }}</li>
                <li><div class="icon-holder"><i class="fas fa-clock"></i></div>{{ $movie->runtime }} min.</li>
                <li><div class="icon-holder"><i class="fas fa-glasses"></i></div>99%</li>
            </ul>
            <button class="watch-trailer-btn btn" data-url="{{ $movie->trailer_url }}" >Watch trailer</button>
            <button class="visit-imdb-btn btn" data-url="https://www.imdb.com/title/{{ $movie->imdb_id }}">IMDb page</button>
        </div>
    </div>
    <div id="movie-review">
        <p>{{ $movie->review }}</p>
    </div>
    <div id="movie-add-comment-form">
        @if(session()->has('user'))
        <form id="addComment">
            <input type="hidden" name="_token" value="QJH6MLbXSwvB9xclD1pl1ZAl8giDssE1iCdXV9VB">
            <textarea name="addComment" id="addCommentTextarea" cols="30" rows="10" spellcheck="false" placeholder="Your comment goes here..."></textarea>
            <div id="submit-comment-btn-holder">
                <button id="submit-comment" class="btn" data-movie-id="{{ $movie->id }}" data-user-id="{{ session()->get('user')->id }}">Submit</button>
            </div>
        </form>
        @else
        <div class="bubble infoBubble">
            <p>You have to log in in order to leave a comment.</p>
        </div>
        @endif
    </div>
    <h3>Comments:</h3>
    <div id="movie-comments">


    </div>
</div>

@endsection
