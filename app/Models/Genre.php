<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres';

    public function get() {
        return \DB::table('genres')
            ->select('genre')
            ->distinct()
            ->get();
    }
}
