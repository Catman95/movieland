<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Comment;

class ApiController extends Controller
{
    public function browse(Request $request) {
        $page = $request->input('page');
        $genre = $request->input('genre');
        $sort = $request->input('sort');
        $direction = $request->input('direction');
        $rating = $request->input('rating');
        $per_page = $request->input('per_page');

        $model = new Movie();
        $result = $model->get_all($page, $genre, $sort, $direction, $rating, $per_page);
        return response()->json(['movies' => $result['movies'], 'pages_needed' => $result['pages_needed']]);
    }

    public function get_genres() {
        $model = new Genre();
        $genres = $model->get();
        return response()->json(['genres' => $genres]);
    }

    public function comments_get($movie_id) {
        $model = new Comment();
        $comments = $model->get_all($movie_id);
        foreach ($comments as $comment){
            $comment->author_username = User::find($comment->author_id)->username;
        }
        return response()->json(['comments' => $comments]);
    }

    public function admin_get_users($current_page){
        $model = new User();
        $result = $model->get($current_page);
        return response()->json($result);
    }

    public function admin_get_movies($current_page){
        $model = new Movie();
        $result = $model->get($current_page);
        return response()->json($result);
    }

    public function comment_add(Request $request) {

        $user_id = $request->input('user_id');
        $movie_id = $request->input('movie_id');
        $text = $request->input('text');

        $model = new Comment();
        $result = $model->insert($movie_id, $user_id, $text);
        #Logger::log("Comment added");
        return response()->json(['result' => 'success']);

    }
}
