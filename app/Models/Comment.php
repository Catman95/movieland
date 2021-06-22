<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function insert($movie_id, $user_id, $text) {

        \DB::table('comments')
            ->insert([
                'movie_id' => $movie_id,
                'author_id' => $user_id,
                'text' => $text
            ]);
    }

    public function get_all($movie_id) {
        return \DB::table('comments')
            ->where('movie_id', $movie_id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function comment_search($text) {
        if($text == ""){
            return \DB::table('all_comments_view')
                ->where('comment_content', 'LIKE', '')
                ->get();
        }
        return \DB::table('all_comments_view')
            ->where('comment_content', 'LIKE', '%' . $text . '%')
            ->get();
    }

    public function comment_delete($id) {
        \DB::table('comments')
            ->where('id', $id)
            ->delete();
    }
}
