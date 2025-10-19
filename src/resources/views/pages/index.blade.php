@extends('layouts.app')

@section('title', 'MyFilms - Beranda')

@section('content')
    <div class="container py-4">

        {{-- Hero Section --}}
        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary mb-2">🎬 Selamat Datang di <span class="text-gradient">MyFilms</span></h1>
            <p class="text-muted">Temukan film favoritmu berdasarkan genre dan nikmati pengalaman sinema digital terbaik.</p>
        </div>

        {{-- Genre Navigation --}}
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
            @foreach ($genres as $genre)
                {{-- <a href="{{ route('genre.show', $genre['slug']) }}"
                    class="btn btn-outline-primary rounded-pill px-3 py-1 fw-semibold genre-btn">
                    {{ $genre['name'] }}
                </a> --}}
                <a href="#" class="btn btn-outline-primary rounded-pill px-3 py-1 fw-semibold genre-btn">
                    {{ $genre['name'] }}
                </a>
            @endforeach
        </div>

        {{-- Movie Sections by Genre --}}
        @foreach ($genres as $genre)
            <section class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-semibold text-primary mb-0">
                        <i class="bi bi-film"></i> {{ $genre['name'] }}
                    </h4>
                    {{-- <a href="{{ route('genre.show', $genre['slug']) }}" class="text-decoration-none small text-muted">
                        Lihat semua <i class="bi bi-chevron-right"></i>
                    </a> --}}
                    <a href="#" class="text-decoration-none small text-muted">
                        Lihat semua <i class="bi bi-chevron-right"></i>
                    </a>
                </div>

                <div class="d-flex overflow-auto pb-3 smooth-scroll">
                    @foreach ($genre['movies'] as $movie)
                        <div class="movie-card flex-shrink-0 me-3 text-center">
                            <div class="poster-container">
                                <img src="{{ asset($movie['poster'] ?? 'images/player-placeholder.png') }}"
                                    class="movie-poster rounded" alt="{{ $movie['title'] }}">
                                <div class="overlay d-flex justify-content-center align-items-center">
                                    <button class="btn btn-light btn-sm fw-semibold shadow-sm">
                                        <i class="bi bi-play-fill text-primary fs-5"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-2 movie-title text-truncate" title="{{ $movie['title'] }}">
                                {{ $movie['title'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

    </div>
@endsection

@push('styles')
    <style>
        .text-gradient {
            background: linear-gradient(45deg, #007bff, #6610f2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .genre-btn:hover {
            background-color: #007bff;
            color: #fff !important;
            transform: translateY(-2px);
            transition: all 0.2s;
        }

        .movie-card {
            width: 120px;
            min-width: 120px;
            position: relative;
            transition: transform 0.2s ease, box-shadow 0.3s;
        }

        .movie-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .poster-container {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }

        .movie-poster {
            width: 100%;
            height: 170px;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .poster-container:hover .movie-poster {
            transform: scale(1.05);
        }

        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .poster-container:hover .overlay {
            opacity: 1;
        }

        .movie-title {
            font-size: 0.85rem;
            font-weight: 500;
        }

        .smooth-scroll {
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        @media (max-width: 576px) {
            h1 {
                font-size: 1.6rem;
            }

            .movie-card {
                width: 100px;
                min-width: 100px;
            }

            .movie-poster {
                height: 150px;
            }
        }
    </style>
@endpush
