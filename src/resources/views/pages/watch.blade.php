@extends('layouts.app')

@section('title', 'MyFilms | Movie Player')

@section('watchPlayer')
    <div class="min-vh-100 d-flex flex-column align-items-center bg-light py-4 pt-0"
        style="font-family: 'Poppins', sans-serif;">

        @php
            $defaultMovies = [
                ['title' => 'Thor (2011)', 'poster' => 'images/thor_2011.jpg'],
                ['title' => 'Avengers (2012)', 'poster' => 'images/avengers_2012.jpg'],
                ['title' => 'Thor: The Dark World (2013)', 'poster' => 'images/thor_dark_world_2013.jpg'],
                ['title' => 'Avengers: Age of Ultron (2015)', 'poster' => 'images/avengers_age_ultron_2015.jpg'],
                ['title' => 'Avengers: Infinity War (2018)', 'poster' => 'images/avengers_infinity_war_2018.jpg'],
                ['title' => 'Avengers: Endgame (2019)', 'poster' => 'images/avengers_endgame_2019.jpg'],
                ['title' => 'Thor: Love and Thunder (2022)', 'poster' => 'images/thor_love_thunder_2022.jpg'],
            ];

            $moviesToShow = $otherMovies ?? $defaultMovies;
        @endphp

        <!-- DESKTOP VERSION (Card Layout) -->
        <div class="card shadow-lg border-0 rounded-4 w-100 d-none d-md-block"
            style="max-width: 1200px; background: #fdfdfd;">
            <div class="card-body p-3 p-md-5">

                <!-- Video Container -->
                <div class="position-relative rounded-4 overflow-hidden shadow-sm w-100 ratio ratio-16x9">
                    <video id="moviePlayer" class="w-100 h-100 rounded-4" style="background-color: #000;"
                        poster="{{ asset('images/player-placeholder.png') }}">
                        <source src="{{ $movieUrl ?? '' }}" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>

                    <!-- Custom Play Button -->
                    <button id="customPlayBtn"
                        class="position-absolute top-50 start-50 translate-middle border-0 rounded-circle d-flex align-items-center justify-content-center shadow"
                        style="width: 80px; height: 80px; background: rgba(255,255,255,0.85); transition: all 0.2s;">
                        <i class="bi bi-play-fill fs-2" style="color: #6c63ff;"></i>
                    </button>

                    <!-- Overlay Gradient -->
                    <div class="position-absolute top-0 start-0 w-100 h-100"
                        style="background: linear-gradient(to bottom, rgba(255,255,255,0.1), rgba(255,255,255,0)); pointer-events:none;">
                    </div>
                </div>

                <!-- Movie Info -->
                <div class="mt-4">
                    <h4 class="fw-semibold text-primary">🎬 {{ $movieTitle ?? 'Unknown Title' }}</h4>
                    <p class="text-secondary small">{{ $movieDescription ?? 'No description available.' }}</p>
                </div>

                <!-- Horizontal Movie List -->
                <div class="mt-4">
                    <h5 class="fw-semibold mb-2 text-primary">Other Movies</h5>
                    <div class="d-flex overflow-auto pb-2">
                        @foreach ($moviesToShow as $other)
                            <div class="card flex-shrink-0 me-3" style="width: 150px; min-width: 150px;">
                                <img src="{{ asset($other['poster'] ?? 'images/player-placeholder.png') }}"
                                    class="card-img-top rounded" alt="{{ $other['title'] }}">
                                <div class="card-body p-2 text-center">
                                    <h6 class="card-title mb-1" style="font-size: 0.85rem;">{{ $other['title'] }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        <!-- MOBILE VERSION (Full Width, No Card) -->
        <div class="w-100 d-block d-md-none px-2">
            <h4 class="fw-semibold text-primary">🎬 {{ $movieTitle ?? 'Unknown Title' }}</h4>

            <!-- Video -->
            <div class="position-relative overflow-hidden w-100 ratio ratio-16x9 rounded-3 mb-3">
                <video id="moviePlayerMobile" class="w-100 h-100 rounded-3" style="background-color: #000;"
                    poster="{{ asset('images/player-placeholder.png') }}">
                    <source src="{{ $movieUrl ?? '' }}" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>

                <!-- Custom Play Button -->
                <button id="customPlayBtnMobile"
                    class="position-absolute top-50 start-50 translate-middle border-0 rounded-circle d-flex align-items-center justify-content-center shadow"
                    style="width: 70px; height: 70px; background: rgba(255,255,255,0.85); transition: all 0.2s;">
                    <i class="bi bi-play-fill fs-3" style="color: #6c63ff;"></i>
                </button>
            </div>

            <!-- Movie Info -->
            <div class="mb-3">
                {{-- <h4 class="fw-semibold text-primary mb-1">🎬 {{ $movieTitle ?? 'Unknown Title' }}</h4> --}}
                <p class="text-secondary small">{{ $movieDescription ?? 'No description available.' }}</p>
            </div>

            <!-- Horizontal Movie List -->
            <div>
                <h5 class="fw-semibold mb-2 text-primary">Other Movies</h5>
                <div class="d-flex overflow-auto pb-2">
                    @foreach ($moviesToShow as $other)
                        <div class="flex-shrink-0 me-3 text-center" style="width: 120px; min-width: 120px;">
                            <img src="{{ asset($other['poster'] ?? 'images/player-placeholder.png') }}"
                                class="rounded mb-1 w-100" alt="{{ $other['title'] }}">
                            <div style="font-size: 0.8rem;">{{ $other['title'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

    @push('scripts')
        <script>
            // Desktop video
            const player = document.getElementById('moviePlayer');
            const customPlayBtn = document.getElementById('customPlayBtn');

            customPlayBtn.addEventListener('click', () => player.play());
            player.addEventListener('play', () => {
                customPlayBtn.style.opacity = '0';
                customPlayBtn.style.pointerEvents = 'none';
                player.controls = true;
            });
            player.addEventListener('pause', () => {
                customPlayBtn.style.opacity = '1';
                customPlayBtn.style.pointerEvents = 'auto';
            });
            player.controls = false;

            // Mobile video
            const playerMobile = document.getElementById('moviePlayerMobile');
            const customPlayBtnMobile = document.getElementById('customPlayBtnMobile');

            customPlayBtnMobile.addEventListener('click', () => playerMobile.play());
            playerMobile.addEventListener('play', () => {
                customPlayBtnMobile.style.opacity = '0';
                customPlayBtnMobile.style.pointerEvents = 'none';
                playerMobile.controls = true;
            });
            playerMobile.addEventListener('pause', () => {
                customPlayBtnMobile.style.opacity = '1';
                customPlayBtnMobile.style.pointerEvents = 'auto';
            });
            playerMobile.controls = false;
        </script>
    @endpush
@endsection
