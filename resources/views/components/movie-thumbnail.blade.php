<div class="card" data-id="{{ $movie->imdb_id }}">
    <div class="image">
        <img src="{{ $movie->poster_url }}" alt="poster">
        <div class="data">
            <p class="thumbnailRating"><span>IMDb</span> {{ $movie->imdb_rating }}</p>
            <ul class="thumbnailGenres">
                @foreach($movie->genres as $genre)
                    <li>{{ $genre->genre }}</li>
                @endforeach
            </ul>
            <button>Open</button>
        </div>
    </div>
    <p class="thumbnailTitle">{{ strlen($movie->title) > 30 ? substr($movie->title, 0, 28). "..." : $movie->title }}</p>
    <p class="thumbnailYear">{{ $movie->release_year }}</p>
</div>
