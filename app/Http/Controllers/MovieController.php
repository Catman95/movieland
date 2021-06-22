<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;

class MovieController extends HomeController
{
    public function __construct() {
        parent::__construct();
        $this->model = new Movie();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $movies = $this->model->home_movies();
            $this->data['flex1'] = $movies[0];
            $this->data['flex2'] = $movies[1];
            $this->data['flex3'] = $movies[2];
            return view("home", $this->data);
        }catch (\Exception $exception) {
            dd($exception->getMessage());
            self::log('Exception', $exception->getMessage());
            return view('errors.500');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.movies-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = new Movie();
        if($_FILES['addMoviePoster']['error'] == 4) {
            $poster = $request->input('addMoviePosterDefault');
        }else {
            $fileName = $_FILES['addMoviePoster']['name'];
            $tmpName = $_FILES['addMoviePoster']['tmp_name'];
            $fileSize = $_FILES['addMoviePoster']['size'];
            $fileType = $_FILES['addMoviePoster']['type'];
            $fileError = $_FILES['addMoviePoster']['error'];
            $uploadDir = "uploads/";
            $filePath = $uploadDir . $fileName;
            $result = move_uploaded_file($tmpName, $filePath);
            $poster = $filePath;
        }

        $imdb_id = $request->input('addMovieId');
        $title = $request->input('addMovieTitle');
        $type = $request->input('addMovieType');
        $rating = $request->input('addMovieRating');
        $review = $request->input('addMovieReview');
        $runtime = $request->input('addMovieRuntime');
        $year = $request->input('addMovieYear');
        $trailer = $request->input('addMovieTrailer');
        $genres = $request->input('addMovieGenres');
        //ODRADI VALIDACIJU
        $movie->insert($imdb_id, $title, $type, $rating, $review, $poster, $runtime, $year, $trailer, $genres);
        #Logger::log("New movie added");
        return redirect()->route('admin-movies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::where('imdb_id', $id)->first();
        $movie->genres = Genre::where('movie_id', $id)->get();
        return view('movie', ['movie' => $movie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
