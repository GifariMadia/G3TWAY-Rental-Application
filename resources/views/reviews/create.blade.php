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
      background-color: white;
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

    .car-grid {
      position: relative;
      top: 30px;
      margin: 0 auto;
      width: 85%;
      max-width: 1200px;
      display: flex;
      gap: 10px;
      background-color: #e9ebf0;
      border-radius: 24px;
      padding: 32px;
      flex-wrap: wrap;
      align-items: flex-start;
    }

    .car-card {
      background: white;
      border-radius: 24px;
      padding: 24px 24px 16px 24px;
      max-width: 1130px;
      flex: 1 1 100%;
      display: flex;
      flex-direction: column;
      gap: 12px;
      box-sizing: border-box;
      margin-bottom: 12px;
    }

    .car-card img {
      width: 100%;
      height: 100%;
      aspect-ratio: 5 / 2;
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

    .stars {
      display: flex;
      gap: 8px;
      font-size: 24px;
      color: #999999;
      margin-top: 4px;
    }

    .rental-info {
      background: white;
      border-radius: 24px;
      padding: 24px 20px;
      width: 100%;
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

    .rental-info textarea {
      background: #e0e0e0;
      border: none;
      border-radius: 12px;
      padding: 12px;
      font-weight: 400;
      font-size: 12px;
      color: black;
      resize: none;
      height: 160px;
      width: 1090px;
      top: 5px;
      line-height: 1.2;
      cursor: default;
    }

    .submit-review {
      background-color: black;
      color: white;
      font-weight: 700;
      font-size: 12px;
      border: none;
      border-radius: 8px;
      padding: 8px 16px;
      cursor: pointer;
      width: max-content;
      align-self: center;
      margin-top: 12px;
    }

    @media (max-width: 1024px) {
      .car-grid {
        flex-direction: column;
        padding: 24px;
      }

      .car-card {
        max-width: 100%;
      }

      .rental-info {
        width: 100%;
        flex-direction: column;
        gap: 12px;
      }

      .rental-info label {
        width: 100%;
        margin-bottom: 0;
      }

      .rental-info textarea {
        flex: 1 1 100%;
        height: 120px;
      }

      .submit-review {
        width: 100%;
        margin-top: 8px;
      }
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
      <div class="car-card car-info">
        <img src="{{ asset('assets/porsche-911-gt1.jpeg') }}" alt="Black Lamborghini Revuelt with doors open on a sunny road with trees in background" />
        <h3>Lamborghini Revueltо</h3>
        <div>
          <div id="starRating" style="font-size: 24px; color: gold; cursor: pointer;">
            <i class="fa-regular fa-star" data-value="1"></i>
            <i class="fa-regular fa-star" data-value="2"></i>
            <i class="fa-regular fa-star" data-value="3"></i>
            <i class="fa-regular fa-star" data-value="4"></i>
            <i class="fa-regular fa-star" data-value="5"></i>
          </div>
          <input type="hidden" name="rating" id="rating" value="0">
        </div>

      </div>
      <div class="rental-info">

        <form action="{{ route('reviews.store') }}" method="POST">
          @csrf
          <input type="hidden" name="rating" id="rating" value="0"> <!-- Ini akan diisi dari JS -->

          <label for="comment">Comment:</label>
          <textarea id="comment" name="comment" required placeholder="Write your review here..."></textarea>

          <button class="submit-review" type="submit">Submit Review</button>
        </form>
      </div>
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
    const stars = document.querySelectorAll('#starRating i');
    const ratingInput = document.getElementById('rating');

    menuButton.addEventListener('click', () => {
      sidebarMenu.classList.toggle('active');
      menuButton.classList.toggle('active');
    });

    stars.forEach((star, index) => {
      star.addEventListener('click', () => {
        const ratingValue = index + 1;
        ratingInput.value = ratingValue;

        stars.forEach((s, i) => {
          if (i < ratingValue) {
            s.classList.add('fa-solid');
            s.classList.remove('fa-regular');
          } else {
            s.classList.remove('fa-solid');
            s.classList.add('fa-regular');
          }
        });
      });
    });
  </script>

</body>

</html>