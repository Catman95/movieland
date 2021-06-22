@extends('layouts/admin')
@section('panelTopIcon')
<i class="fas fa-film"></i>
@endsection
@section('panelTopTitle')
Movies
@endsection
@section('sadrzaj')
<form action="/admin/movies/update" method="post" id="editMovieForm" enctype="multipart/form-data">
    @csrf
    <h1>Edit a movie</h1>
    <label for="editMovieId">IMDB id of the movie</label>
    <input type="text" placeholder="Example: tt0372183" id="editMovieId" value="{{ $data->imdb_id }}" disabled class="disabled">
    <input type="hidden" value="{{ $data->imdb_id }}" name="id">
    <label for="editMovieTrailer">Trailer URL (optional)</label>
    <input type="text" placeholder="URL of a trailer" id="editMovieTrailer" value="{{ $data->trailer_url }}" name="trailer_url">
    <label for="editMovieReview">Edit the review (optional)</label>
    <textarea placeholder="This one is required. Write your own impressions." id="editMovieReview" name="review">{{ $data->review }}</textarea>
    <label for="editMoviePoster">Edit the poster (optional)</label>
    <input type="file" id="editMoviePoster" name="editMoviePoster">
    <button class="btn" id="editMovieBtn">Edit the movie</button>
</form>
@endsection