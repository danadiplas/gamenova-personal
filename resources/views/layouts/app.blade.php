{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Gamenova - @yield('title')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Estilos personalizados con TU PALETA -->
    <style>
        :root {
            --color-fondo: #0a0e27;
            --color-purpura: #7c3aed;
            --color-rosa: #ec4899;
            --color-amarillo: #f59e0b;
            --color-verde: #10b981;
            --color-gris: #94a3b8;
            --color-tarjetas: #0f172a;
            --color-rojo: #ef4444;
        }

        /* Fondo Principal */
        body {
            background-color: var(--color-fondo) !important;
            color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        /* Sobrescribir colores de Bootstrap */
        .bg-dark {
            background-color: var(--color-fondo) !important;
        }

        .bg-primary {
            background-color: var(--color-purpura) !important;
        }

        .text-primary {
            color: var(--color-purpura) !important;
        }

        .border-primary {
            border-color: var(--color-purpura) !important;
        }

        .btn-primary {
            background-color: var(--color-purpura) !important;
            border-color: var(--color-purpura) !important;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: var(--color-rosa) !important;
            border-color: var(--color-rosa) !important;
        }

        /* Rosa para hover states */
        .text-danger {
            color: var(--color-rosa) !important;
        }

        .btn-outline-light:hover {
            background-color: var(--color-rosa) !important;
            border-color: var(--color-rosa) !important;
        }

        /* Amarillo para ratings */
        .text-warning {
            color: var(--color-amarillo) !important;
        }

        .bg-warning {
            background-color: var(--color-amarillo) !important;
            color: #000 !important;
        }

        /* Verde para precios/éxito */
        .text-success {
            color: var(--color-verde) !important;
        }

        .bg-success {
            background-color: var(--color-verde) !important;
        }

        /* Gris para texto secundario */
        .text-muted,
        .text-secondary {
            color: var(--color-gris) !important;
        }

        .bg-secondary {
            background-color: var(--color-gris) !important;
        }

        /* Fondo para tarjetas */
        .card.bg-dark {
            background-color: var(--color-tarjetas) !important;
        }

        /* Rojo para errores */
        .text-danger-soft {
            color: var(--color-rojo) !important;
        }

        .bg-danger {
            background-color: var(--color-rojo) !important;
        }

        /* Navegación específica */
        .navbar-dark.bg-dark {
            background-color: var(--color-tarjetas) !important;
        }

        .border-primary {
            border-color: var(--color-purpura) !important;
        }

        /* Estados activos */
        .list-group-item.active,
        .nav-link.active {
            background-color: var(--color-purpura) !important;
            border-color: var(--color-purpura) !important;
        }

        /* Badges personalizados */
        .badge.bg-info {
            background-color: rgba(124, 58, 237, 0.2) !important;
            color: var(--color-purpura) !important;
        }

        .badge.bg-purple {
            background-color: var(--color-purpura) !important;
            color: white !important;
        }

        /* Hover para tarjetas */
        .product-card:hover {
            border-color: var(--color-purpura) !important;
            box-shadow: 0 10px 20px rgba(124, 58, 237, 0.3) !important;
        }
    </style>

    @livewireStyles
</head>

<body>
    <!-- Navegación -->
    <x-navigation />

    <!-- Contenido Principal -->
    <main class="py-4">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5 border-top border-primary">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>GameNova</h5>
                    <p class="small text-muted">Tu tienda de videojuegos favorita. Todos los derechos reservados © 2024
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @livewireScripts
</body>

</html>
