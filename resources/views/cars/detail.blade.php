<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>G3TWAY</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
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
      background: #fff;
      overflow: auto;
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
      color: black;
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
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 24px;
      font-weight: 600;
      cursor: pointer;
      color: black;
      z-index: 3000;
    }

    .sign-in {
      border: 1.5px solid black;
      padding: 8px 18px;
      border-radius: 6px;
      text-decoration: none;
      color: black;
      font-weight: 600;
      font-size: 16px;
      z-index: 3000;
    }

    .sign-in:hover {
      background: black;
      color: white;
    }

    .logo-wrapper {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }

    .logo-wrapper img {
      height: 100px;
    }

    .detail-slider {
      position: relative;
      margin: 120px auto 24px;
      width: 85%;
      max-width: 1200px;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .detail-slider .swiper-slide img {
      width: 100%;
      height: fit-content;
      object-fit: cover;
    }

    .detail-info {
      position: relative;
      margin: 0 auto 40px;
      width: 85%;
      max-width: 1200px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #f3f4f6;
      padding: 20px 30px;
      border-radius: 0 0 16px 16px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .detail-info h1 {
      font-size: 28px;
      font-weight: 700;
      color: #111;
    }

    .detail-info p {
      font-size: 18px;
      color: #555;
      margin-top: 4px;
    }

    .book-btn {
      background: black;
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.2s;
    }

    .book-btn:hover {
      background: #333;
    }

    .sidebar-menu {
      position: fixed;
      top: 0;
      left: -320px;
      width: 300px;
      height: 100%;
      background: #fff;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
      padding: 100px 30px 30px;
      display: flex;
      flex-direction: column;
      gap: 40px;
      transition: left .4s;
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
      padding: 10px 0;
      border-bottom: 1px solid #eee;
    }

    .sidebar-menu a:hover {
      color: #555;
    }

    .sidebar-menu a::after {
      content: '>';
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

  <div class="overlay">
    <div class="top-bar">
      <div class="menu" id="menuButton">
        <i class="fas fa-bars"></i><span>Menu</span>
      </div>

      <div class="logo-wrapper">
        <img src="{{ asset('assets/Logo.png') }}" alt="G3TWAY Logo" />
      </div>

    </div>

    <!-- Detail Slider -->
<div class="detail-slider swiper mySwiper">
  <div class="swiper-wrapper">
    <!-- Loop through car images dynamically -->
    @foreach($car->photos as $photo)
      <div class="swiper-slide">
        <img src="{{ asset('storage/' . $photo->photos_url) }}" alt="Car Image" />
      </div>
    @endforeach
  </div>
  <!-- navigation -->
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
  <!-- pagination -->
  <div class="swiper-pagination"></div>
</div>


    <!-- Detail Info -->
    <div class="detail-info">
      <div>
      <h1>{{ $car->brand->brand_name ?? 'Brand Not Found' }} {{ $car->model_name }}</h1>
        <p>${{ $car->price_per_day }}/day</p>
      </div>
      <a href="{{ route('cars.booking', ['car' => $car->id]) }}">
        <button class="book-btn">Book</button>
      </a>
    </div>

  </div>

  <!-- Sidebar -->
  <div class="sidebar-menu" id="sidebarMenu">
    <a href="{{ route('cars.index') }}">View All Cars</a>
    <a href="{{ route('rentals.index') }}">Manage Rentals</a>
    <a href="{{ route('reviews.index') }}">Reviews</a>
    <a href="{{ route('profile.show') }}">Profile</a>
  </div>
  <!-- FontAwesome & Swiper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script>
    // sidebar toggle
    document.getElementById('menuButton').addEventListener('click', () => {
      document.getElementById('sidebarMenu').classList.toggle('active');
      document.getElementById('menuButton').classList.toggle('active');
    });
    // init swiper
    new Swiper('.mySwiper', {
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      spaceBetween: 30
    });
  </script>
</body>

</html>
