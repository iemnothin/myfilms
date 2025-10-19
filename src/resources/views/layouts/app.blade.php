<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyFilms')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fb;
            color: #333;
        }

        nav.navbar {
            background: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 600;
            color: #6c63ff !important;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            color: #6c63ff;
        }

        /* Desktop dropdown hover */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            animation: fadeIn 0.2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Dropdown arrow rotation */
        .navbar .dropdown-toggle::after {
            transition: transform 0.2s;
        }

        .navbar .dropdown:hover .dropdown-toggle::after {
            transform: rotate(-180deg);
        }

        /* Bottom nav */
        .bottom-genre-nav {
            overflow-x: auto;
            white-space: nowrap;
        }

        .bottom-genre-nav::-webkit-scrollbar {
            display: none;
        }

        .genre-btn {
            font-size: 0.75rem;
            margin: 0 0.25rem;
            background: #f0f0ff;
            border-radius: 0.5rem;
            min-width: 60px;
        }

        .genre-dropdown-mobile {
            background: #fff;
            padding: 0.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .genre-dropdown-mobile a {
            display: block;
            margin-bottom: 0.25rem;
            font-size: 0.8rem;
        }
    </style>

    @stack('styles')
</head>

<body>

    @php
        $genres = [
            'Action' => ['Thor', 'Avengers', 'Black Panther', 'Captain Marvel', 'Guardians of the Galaxy'],
            'Adventure' => ['Doctor Strange', 'Jumanji', 'Indiana Jones', 'Pirates of the Caribbean'],
            'Sci-Fi' => ['Avengers: Endgame', 'Interstellar', 'Star Wars: The Rise of Skywalker', 'Avatar'],
            'Fantasy' => ['Harry Potter', 'The Lord of the Rings', 'The Hobbit', 'Fantastic Beasts'],
            'Horror' => ['The Conjuring', 'It', 'A Quiet Place', 'The Exorcist'],
            'Comedy' => ['Deadpool', 'Guardians of the Galaxy Vol.2', 'The Hangover', 'Superbad'],
            'Drama' => ['The Pursuit of Happyness', 'Forrest Gump', 'Joker', 'The Godfather'],
        ];
    @endphp

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            {{-- <a class="navbar-brand" href="{{ url('/') }}">🎬 MyFilms</a> --}}
            <!-- Brand Centered on Mobile -->
            <a class="navbar-brand mx-auto d-block d-md-none text-center" href="{{ url('/') }}">
                🎬 MyFilms
            </a>

            <!-- Brand Left on Desktop -->
            <a class="navbar-brand d-none d-md-block" href="{{ url('/') }}">
                🎬 MyFilms
            </a>
            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> --}}

            <!-- Desktop Navbar -->
            <div class="collapse navbar-collapse justify-content-end d-none d-lg-flex" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    @foreach ($genres as $genre => $movies)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $genre }}"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $genre }}</a>
                            <ul class="dropdown-menu shadow-sm rounded-3 p-2">
                                @foreach ($movies as $movie)
                                    <li><a class="dropdown-item"
                                            href="{{ url('/movies/' . urlencode($movie)) }}">{{ $movie }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Bottom Genre Nav with Icons -->
    <div class="d-lg-none fixed-bottom py-2 bg-white shadow-sm border-top">
        <div class="d-flex bottom-genre-nav px-2">
            @php
                $genreIcons = [
                    'Action' => 'bi-lightning-charge',
                    'Adventure' => 'bi-compass',
                    'Sci-Fi' => 'bi-rocket',
                    'Fantasy' => 'bi-stars',
                    'Horror' => 'bi-emoji-frown',
                    'Comedy' => 'bi-emoji-laughing',
                    'Drama' => 'bi-film',
                ];
            @endphp

            @foreach ($genres as $genre => $movies)
                <div class="me-3 text-center">
                    <button class="btn btn-sm genre-btn d-flex flex-column align-items-center" data-bs-toggle="collapse"
                        data-bs-target="#genreCollapse{{ $loop->index }}">
                        <i class="bi {{ $genreIcons[$genre] ?? 'bi-film' }} fs-5"></i>
                        <span class="small text-truncate mt-1">{{ $genre }}</span>
                    </button>

                    <div class="collapse genre-dropdown-mobile mt-1">
                        <div id="genreCollapse{{ $loop->index }}">
                            @foreach ($movies as $movie)
                                <a class="d-block small mb-1" href="{{ url('/movies/' . urlencode($movie)) }}">
                                    {{ $movie }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Content -->
    <main class="flex-grow-1 py-5 pt-2">
        @yield('content')
        @yield('watchPlayer')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container text-center py-3">
            <p class="mb-0">
                © {{ date('Y') }} <strong>MyFilms</strong> by <a href="https://abimanyu.abiila.com"
                    target="_blank">Abimanyu Okysaputra Rachman</a> 🎥
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
