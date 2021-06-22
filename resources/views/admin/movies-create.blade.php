@extends('layouts/admin')
@section('panelTopIcon')
<i class="fas fa-film"></i>
@endsection
@section('panelTopTitle')
Movies
@endsection
@section('sadrzaj')
<form action="/admin/movies/store" method="post" id="addMovieForm" enctype="multipart/form-data">
    @csrf
    <h1>Add a new movie</h1>
    <label for="addMovieId">IMDB id of the movie</label>
    <input type="text" placeholder="Example: tt0372183" id="addMovieId" name="addMovieId">
    <label for="addMovieTrailer">Trailer URL (optional)</label>
    <input type="text" placeholder="URL of a trailer" id="addMovieTrailer" name="addMovieTrailer">
    <label for="addMovieReview">Your review</label>
    <textarea placeholder="This one is required. Write your own impressions." id="addMovieReview" name="addMovieReview"></textarea>
    <label for="addMoviePoster">Add a poster (optional)</label>
    <input type="file" id="addMoviePoster" name="addMoviePoster">
    <button class="btn" id="addMovieBtn">Add movie</button>
    <input type="hidden" id="addMovieTitle" name="addMovieTitle">
    <input type="hidden" id="addMovieType" name="addMovieType">
    <input type="hidden" id="addMovieYear" name="addMovieYear">
    <input type="hidden" id="addMovieRuntime" name="addMovieRuntime">
    <input type="hidden" id="addMovieRating" name="addMovieRating">
    <input type="hidden" id="addMoviePosterDefault" name="addMoviePosterDefault">
    <input type="hidden" id="addMovieGenres" name="addMovieGenres">
</form>
@endsection