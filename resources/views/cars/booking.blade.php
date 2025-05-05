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

    body, html {
      height: 100%;
      background-color: white; /* ganti background putih */
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
      justify-content: flex-start;
      color: black;
    }

    .top-bar {
      position: relative;
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
      color: black;
    }

    .menu img {
      height: 30px;
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
      background-color: black;
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

    /* New car-grid styling and structure */
    .car-grid {
      position: relative;
      top: 120px;
      margin: 0 auto;
      width: 85%;
      max-width: 1200px;
      display: flex;
      gap: 24px;
      background-color: #e6efef;
      border-radius: 24px;
      padding: 32px;
      align-items: flex-start;
      min-height: 360px;
    }

    .car-card {
      background: white;
      border-radius: 24px;
      padding: 16px;
      max-width: 600px;
      flex: 1 1 0;
      display: flex;
      flex-direction: column;
      gap: 12px;
      box-sizing: border-box;
    }

    .car-card img {
      width: 100%;
      aspect-ratio: 4 / 2.5;
      object-fit: cover;
      border-radius: 24px;
      border: 8px solid black;
    }

    .car-card h3 {
      font-weight: 700;
      font-size: 20px;
      color: black;
      margin-top: 8px;
    }

    .car-card p {
      font-weight: 400;
      font-size: 14px;
      color: black;
      margin-top: -4px;
    }

    .car-info {
      flex: 1;
    }

    .rental-info {
      background: white;
      border-radius: 24px;
      padding: 24px 20px;
      width: 220px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      box-sizing: border-box;
      font-size: 14px;
      font-weight: 600;
      color: black;
    }

    .rental-info label {
      font-weight: 700;
      font-size: 12px;
      margin-bottom: 4px;
    }

    .rental-info select,
    .rental-info input {
      background: #e0e0e0;
      border: none;
      border-radius: 8px;
      padding: 8px 12px;
      font-weight: 400;
      font-size: 14px;
      color: black;
      appearance: none;
      cursor: pointer;
    }

    .rental-info input[readonly] {
      cursor: default;
    }

    .total {
      font-weight: 700;
      font-size: 16px;
      margin-top: 12px;
    }

    .total span {
      font-weight: 900;
      font-size: 20px;
      display: block;
      margin-top: 4px;
    }

    .pay-button {
      background-color: black;
      color: white;
      font-weight: 700;
      font-size: 14px;
      border: none;
      border-radius: 8px;
      padding: 10px 24px;
      cursor: pointer;
      width: max-content;
      margin-top: 12px;
      align-self: flex-start;
    }

    @media (max-width: 1024px) {
      .car-grid {
        flex-direction: column;
        padding: 24px;
        min-height: auto;
      }

      .car-card {
        max-width: 100%;
      }

      .rental-info {
        width: 100%;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 12px 16px;
        font-size: 12px;
      }

      .rental-info label {
        width: 100%;
        margin-bottom: 0;
      }

      .rental-info select,
      .rental-info input {
        flex: 1 1 45%;
      }

      .total {
        width: 100%;
        margin-top: 8px;
      }

      .pay-button {
        width: 100%;
        margin-top: 8px;
      }

      .pay-button:hover {
        background-color: #333;
      }
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
      left: 0
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
      color: #555
    }

    .sidebar-menu a::after {
      content: '>';
      margin-left: auto;
      color: gray
    }

    .menu.active {
      color: black
    }

    .menu.active img {
      filter: brightness(0) invert(1)
    }

    .sidebar-menu.active a:hover {
      color: black
    }
  </style>
</head>

<body>

  <div class="overlay">
    <div class="top-bar">
      <div class="menu" id="menuButton">
        <i class="fas fa-bars" id="menuIcon"></i>
        <span>Menu</span>
      </div>

      <div class="logo-wrapper">
        <img src="{{ asset('assets/Logo.png') }}" alt="G3TWAY Logo" />
      </div>
    </div>

    <div class="car-grid">
    @foreach ($cars as $car)
    <div class="car-card car-info">
        <img src="{{ asset($car->photos->first()->photos_url ?? 'default_image.jpg') }}" alt="{{ $car->brand->brand_name }} {{ $car->car_name }}" />
        <h3>{{ $car->car_name }}</h3>
        <p>${{ $car->price_per_day }}/day</p>

        <form action="{{ route('rentals.create') }}" method="POST">
            @csrf
            <input type="hidden" name="car_id" value="{{ $car->car_id }}">
            <input type="hidden" name="price_per_day" value="{{ $car->price_per_day }}">
            
            <label for="rental-duration">Rental Duration:</label>
            <select id="rental-duration" name="rental-duration" aria-label="Rental Duration">
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <!-- Tambahkan pilihan durasi lainnya sesuai kebutuhan -->
            </select>

            <label for="start-date">Start date:</label>
            <input type="text" id="start-date" name="start-date" value="20 April 2025" readonly aria-label="Start date" />

            <label for="end-date">End date:</label>
            <input type="text" id="end-date" name="end-date" value="22 April 2025" readonly aria-label="End date" />

            <p class="total">Total: <span>$<span id="total-price">{{ $car->price_per_day * 2 }}</span></span></p>

            <button type="submit" class="pay-button">Pay</button>
        </form>
    </div>
    @endforeach
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