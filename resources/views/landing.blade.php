<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>G3TWAY</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body,
    html {
      height: 100%;
      overflow: hidden;
    }

    .video-bg {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
    }

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      padding: 0 40px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      color: white;
    }

    .top-bar {
      position: fixed;
      width: 100%;
      padding: 0 5% 0 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 70px;
      margin-top: 10px;
      z-index: 2000;
    }

    .menu {
      position: relative;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 24px;
      font-weight: 600;
      cursor: pointer;
      z-index: 3000;
      color: white;
    }

    .menu img {
      height: 30px;
    }

    .sign-in {
      border: 1.5px solid white;
      padding: 8px 18px;
      border-radius: 6px;
      text-decoration: none;
      color: white;
      font-weight: 600;
      font-size: 16px;
      z-index: 3000;
    }

    .sign-in:hover {
      background-color: white;
      color: black;
    }

    .logo-wrapper {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }

    .logo-wrapper img {
      height: 100px;
    }

    .text-area {
      position: absolute;
      bottom: 20%;
      left: 140px;
      max-width: 500px;
    }

    .text-area h1 {
      font-size: 32px;
      font-weight: 300;
      line-height: 1.5;
    }

    .book-now {
      margin-top: 30px;
      padding: 12px 36px;
      border: 2px solid white;
      background: transparent;
      margin-left: 80px;
      color: white;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
    }

    .book-now:hover {
      background-color: white;
      color: black;
    }

    .sidebar-menu {
      position: fixed;
      top: 0;
      left: -320px;
      width: 300px;
      height: 100%;
      background-color: white;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
      padding: 100px 30px 30px 30px;
      display: flex;
      flex-direction: column;
      gap: 40px;
      transition: left 0.4s ease;
      z-index: 1000;
    }

    .sidebar-menu.active {
      left: 0;
    }

    .sidebar-menu a {
      text-decoration: none;
      color: black;
      font-size: 22px;
      font-weight: 500;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid #eee;
    }

    .sidebar-menu a:hover {
      color: #555;
    }

    .sidebar-menu a::after {
      content: ">";
      font-size: 20px;
      margin-left: auto;
      color: gray;
    }

 
    .menu.active {
      color: black;
    
    }

    .menu.active img {
      filter: brightness(0) invert(1);
     
    }

    .sidebar-menu.active a:hover {
      color: black;
     
    }
  </style>
</head>

<body>
  <video autoplay muted loop class="video-bg">
    <source src="{{ asset('assets/Landing_page.mp4') }}" type="video/mp4" />
  </video>

  <div class="overlay">
    <div class="top-bar">
    <div class="menu" id="menuButton">
        <i class="fas fa-bars" id="menuIcon"></i>
        <span>Menu</span>
      </div>

      <div class="logo-wrapper">
        <img src="{{ asset('assets/Logo_White.png') }}" alt="G3TWAY Logo" />
      </div>

    </div>

    <div class="text-area">
    <a href="{{ route('signin') }}"><button class="book-now">Book Now</button></a>

    </div>
  </div>

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