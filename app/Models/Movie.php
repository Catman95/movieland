<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;

class Movie extends Model
{
    use HasFactory;

    public function get_all($page, $genre, $sort, $direction, $rating, $per_page) {

        $with_that_genre = \DB::table('genres')
            ->select('movie_id')
            ->where('genre', 'like', '%' . $genre)
            ->get();

        $id_of_movies_genre_filtered = [];

        foreach($with_that_genre as $movie) {
            array_push($id_of_movies_genre_filtered, $movie->movie_id);
        }

        $count = \DB::table('movies')
            ->whereIn('imdb_id', $id_of_movies_genre_filtered)
            ->where('imdb_rating', '>=', $rating)
            ->count();

        $pages_needed = ceil($count / $per_page);

        $movies = \DB::table('movies')
            ->whereIn('id', $id_of_movies_genre_filtered)
            ->where('imdb_rating', '>=', $rating)
            ->orderBy($sort, $direction)
            ->offset((intval($page) - 1) * $per_page)
            ->limit($per_page)
            ->get();

        foreach($movies as $movie) {
            $arr = [];
            $genres = \DB::table('genres')
                ->where('movie_id', $movie->id)
                ->get();
            foreach($genres as $genre) {
                array_push($arr, $genre->genre);
            }
            $movie->genres = $arr;
        }

        return ['movies' => $movies, 'pages_needed' => $pages_needed];
    }

    public function home_movies() {
        $recently_added = \DB::table('movies')
            ->orderBy('created_at', 'desc')
            ->get();
        $best_rated = \DB::table('movies')
            ->orderBy('imdb_rating', 'desc')
            ->get();
        $most_commented = \DB::table('movies')
            ->join('comments', 'movies.id', '=', 'comments.movie_id')
            ->selectRaw('movies.*, COUNT(comments.id) AS no_of_comments')
            ->orderBy('no_of_comments', 'desc')
            ->groupBy('title')
            ->get();

        $all = [$recently_added, $best_rated, $most_commented];

        foreach($all as $group){
            /*foreach($group as $movie){
                $genres = \DB::table('genres')
                    ->select('genre')
                    ->where('movie_id', $movie->imdb_id)
                    ->get();

                $movie->genres = [];

                foreach($genres as $genre){
                    array_push($movie->genres, $genre->genre);
                }
            }*/
            foreach ($group as $movie){
                $movie->genres = Genre::where('movie_id', $movie->imdb_id)->get();
            }
        }

        return $all;
    }

    public function get($current_page) {
        $per_page = 5;

        $count = \DB::table('movies')->count();
        $pages_needed = ceil($count / $per_page);

        $movies = \DB::table('movies')
            ->orderBy('created_at', 'desc')
            ->offset((intval($current_page) - 1) * $per_page)
            ->limit($per_page)
            ->get();

        foreach($movies as $movie) {
            $arr = [];
            $genres = \DB::table('genres')
                ->select('genre')
                ->where('movie_id', $movie->imdb_id)
                ->get();

            $movie->genres = [];

            foreach($genres as $genre){
                array_push($movie->genres, $genre->genre);
            }
        }

        return ['movies' => $movies, 'pages_needed' => $pages_needed];
    }

    public function insert($imdb_id, $title, $type, $rating, $review, $poster, $runtime, $year, $trailer, $genres) {
        $movie = \DB::table('movies')
            ->insertGetId([
                'imdb_id' => $imdb_id,
                'title' => $title,
                'type' => $type,
                'imdb_rating' => $rating,
                'review' => $review,
                'runtime' => $runtime,
                'release_year' => $year,
                'trailer_url' => $trailer,
                'poster_url' => $poster
            ]);

        $genresArr = explode("/", $genres);
        foreach($genresArr as $genre) {
            \DB::table('genres')
                ->insert([
                    'movie_id' => $movie,
                    'genre' => $genre
                ]);
        }
    }
}
