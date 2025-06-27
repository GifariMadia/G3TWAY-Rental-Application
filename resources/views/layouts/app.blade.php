<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'G3TWAY')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Styles & fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="overlay">
        @yield('content')
    </div>

    {{-- Sidebar dan script --}}
    <div class="sidebar-menu" id="sidebarMenu">
        <a href="{{ route('cars.index') }}">View All Cars</a>
        <a href="{{ route('rentals.index') }}">Manage Rentals</a>
        <a href="{{ route('reviews.index') }}">Reviews</a>
        <a href="{{ route('profile.show') }}">Profile</a>
    </div>

    <script>
        const menuButton = document.getElementById('menuButton');
        const sidebarMenu = document.getElementById('sidebarMenu');

        menuButton.addEventListener('click', () => {
            sidebarMenu.classList.toggle('active');
            menuButton.classList.toggle('active');
        });
    </script>
</body>
</html>
