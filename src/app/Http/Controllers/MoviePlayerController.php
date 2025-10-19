<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoviePlayerController extends Controller
{
    /**
     * Show the movie player page.
     */
    public function index()
    {
        // Default example video (you can replace it later)
        // $movieUrl = asset('movie/Thor - Ragnarok.mp4');
        // $movieUrl = asset('films/Thor - Ragnarok.mp4');
        // $movieTitle = 'Thor - Ragnarok';
        // $movieDescription = 'Thor: Ragnarok adalah film pahlawan super Amerika tahun 2017 yang merupakan sekuel dari Thor dan Thor: The Dark World, serta film ketujuh belas dalam Marvel Cinematic Universe (MCU). Film ini disutradarai oleh Taika Waititi dan bercerita tentang Thor yang harus berjuang untuk menghentikan kehancuran Asgard, yang disebut "Ragnarök", dari ancaman Hela, Dewi Kematian. Untuk pulang dan menyelamatkan Asgard, Thor harus terlebih dahulu memenangkan pertarungan gladiator melawan sesama Avenger, Hulk. ';

        // return view('pages.index', compact('movieUrl', 'movieTitle', 'movieDescription'));
        $genres = [
            [
                'name' => 'Action',
                'slug' => 'action',
                'movies' => [
                    ['title' => 'Mad Max: Fury Road', 'poster' => 'images/movies/madmax.jpg'],
                    ['title' => 'John Wick 4', 'poster' => 'images/movies/johnwick4.jpg'],
                    ['title' => 'Extraction 2', 'poster' => 'images/movies/extraction2.jpg'],
                    ['title' => 'The Batman', 'poster' => 'images/movies/thebatman.jpg'],
                ]
            ],
            [
                'name' => 'Romance',
                'slug' => 'romance',
                'movies' => [
                    ['title' => 'The Notebook', 'poster' => 'images/movies/thenotebook.jpg'],
                    ['title' => 'La La Land', 'poster' => 'images/movies/lalaland.jpg'],
                    ['title' => 'Titanic', 'poster' => 'images/movies/titanic.jpg'],
                ]
            ],
            [
                'name' => 'Science Fiction',
                'slug' => 'sci-fi',
                'movies' => [
                    ['title' => 'Interstellar', 'poster' => 'images/movies/interstellar.jpg'],
                    ['title' => 'Inception', 'poster' => 'images/movies/inception.jpg'],
                    ['title' => 'Dune', 'poster' => 'images/movies/dune.jpg'],
                ]
            ],
            [
                'name' => 'Animation',
                'slug' => 'animation',
                'movies' => [
                    ['title' => 'Inside Out', 'poster' => 'images/movies/insideout.jpg'],
                    ['title' => 'Spirited Away', 'poster' => 'images/movies/spiritedaway.jpg'],
                    ['title' => 'Toy Story 4', 'poster' => 'images/movies/toystory4.jpg'],
                ]
            ],
        ];

        // Contoh "Other Movies" untuk bagian bawah halaman
        $moviesToShow = collect($genres)->pluck('movies')->flatten(1)->shuffle()->take(10);

        return view('pages.index', compact('genres', 'moviesToShow'));
    }

    /**
     * Stream video directly from Google Drive link (or local path).
     * Example URL format for Google Drive:
     * https://drive.google.com/uc?export=download&id=YOUR_FILE_ID
     */
    public function play(Request $request)
    {
        $url = $request->query('url');

        if (!$url) {
            abort(404, 'Video URL not provided');
        }

        // Sanitize URL to prevent injection
        $movieUrl = filter_var($url, FILTER_SANITIZE_URL);

        $movieTitle = $request->query('title', 'Untitled Movie');
        $movieDescription = $request->query('desc', 'No description available.');

        return view('pages.watch', compact('movieUrl', 'movieTitle', 'movieDescription'));
    }
}
