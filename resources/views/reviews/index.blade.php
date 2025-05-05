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
         margin-top: 10px;
      }

      .car-grid {
         position: relative;
         top: 100px;
         margin: 0 auto;
         display: grid;
         grid-template-columns: repeat(3, 1fr);
         gap: 24px;
         width: 85%;
         max-width: 1200px;
         padding-bottom: 50px;
      }


      .car-card {
         background: black;
         border: 1px solid #e0e0e0;
         border-radius: 16px;
         overflow: hidden;
         display: flex;
         flex-direction: column;
         align-items: center;
         padding: 16px;
         transition: all 0.3s ease;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
         cursor: pointer;
      }

      .car-card:hover {
         transform: translateY(-6px);
         box-shadow: 0 10px 18px rgba(0, 0, 0, 0.1);
      }

      .car-card img {
         width: 100%;
         height: 100%;
         object-fit: cover;
         border-radius: 12px;
      }

      .car-card h3 {
         margin-top: 16px;
         font-size: 18px;
         font-weight: 600;
         color: white;
         text-align: center;
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

      .review-button {
         margin-top: 10px;
         padding: 8px 16px;
         background-color: white;
         color: black;
         border: 1px solid black;
         border-radius: 6px;
         text-decoration: none;
         font-size: 14px;
         font-weight: 600;
         transition: background-color 0.3s, color 0.3s;
      }

      .review-button:hover {
         background-color: black;
         color: white;
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
         <div class="car-card">
            <img src="{{ asset('assets/porsche-911-gt1.jpeg') }}" alt="Porsche 911 GT1" />
            <h3>Porsche 911 GT1</h3>
            <a href="{{ route('reviews.create') }}" class="review-button">Review</a>
         </div>

         <div class="car-card">
            <img src="{{ asset('assets/lamborghini-revuelto.jpeg') }}" alt="Rolls Royce Spectre" />
            <h3>Lamborghini Revuelto</h3>
            <a href="{{ route('reviews.create') }}" class="review-button">Review</a>
         </div>

         <div class="car-card">
            <img src="{{ asset('assets/brabus-900.jpeg') }}" alt="Rolls Royce Spectre" />
            <h3>Brabus 900</h3>
            <a href="{{ route('reviews.create') }}" class="review-button">Review</a>
         </div>

         <div class="car-card">
            <img src="{{ asset('assets/mclaren-f1.jpeg') }}" alt="Rolls Royce Spectre" />
            <h3>McLaren F1</h3>
            <a href="{{ route('reviews.create') }}" class="review-button">Review</a>
         </div>

         <div class="car-card">
            <img src="{{ asset('assets/ferrari-sf90-stradable.jpeg') }}" alt="Rolls Royce Spectre" />
            <h3>Ferrari SF90 Stradale</h3>
            <a href="{{ route('reviews.create') }}" class="review-button">Review</a>
         </div>

         <div class="car-card">
            <img src="{{ asset('assets/rolls-royce-spectre.jpeg') }}" alt="Rolls Royce Spectre" />
            <h3>Rolls Royce Spectre</h3>
            <a href="{{ route('reviews.create') }}" class="review-button">Review</a>
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

      menuButton.addEventListener('click', () => {
         sidebarMenu.classList.toggle('active');
         menuButton.classList.toggle('active');
      });
   </script>

</body>

</html>