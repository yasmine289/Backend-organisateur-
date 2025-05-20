<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Manager - Organisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: rgba(0, 0, 0, 0.85) !important;
            backdrop-filter: blur(10px);
        }

        .main-content {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
            margin-bottom: 2rem;
            flex: 1;
        }

        .card-hover {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .nav-link {
            position: relative;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.15) !important;
        }

        .nav-link:hover:not(.active) {
            background: rgba(255, 255, 255, 0.05);
        }

        footer {
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(10px);
            margin-top: auto;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-light">
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="fas fa-calendar-alt me-2"></i>Events Manager
            </a>
            
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->is('evenements*') ? 'active' : '' }}" href="{{ route('evenements.index') }}">
                            <i class="fas fa-list me-1"></i>Événements
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->is('paiements*') ? 'active' : '' }}" href="{{ route('paiements.index') }}">
                            <i class="fas fa-credit-card me-1"></i>Paiements
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <i class="fas fa-users me-1"></i>Utilisateurs
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="py-4">
        <div class="container main-content py-4">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-3">
        <div class="container text-center text-white-80">
            <p class="mb-0">&copy; {{ date('Y') }} Events Manager. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>