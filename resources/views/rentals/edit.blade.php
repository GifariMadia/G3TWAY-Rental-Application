<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Rentals</title>
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
      justify-content: space-between;
      color: white;
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

   
    main {
      position: relative;
      margin: 0 auto 350px auto;
      width: 85%;
      max-width: 600px;
      background-color: #eeeff2;
      border-radius: 24px;
      padding: 32px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      box-sizing: border-box;
      min-height: auto;
    }

    main label {
      font-weight: 700;
      font-size: 14px;
      margin-bottom: 6px;
      color: black;
      display: block;
    }

    main input {
      width: 100%;
      background: white;
      border: none;
      border-radius: 8px;
      padding: 12px 16px;
      font-weight: 400;
      font-size: 16px;
      color: black;
      box-sizing: border-box;
    }

    main input[readonly] {
      cursor: default;
    }

    .upload-buttons {
      display: flex;
      gap: 16px;
      margin-top: 8px;
      flex-wrap: wrap;
    }

    .upload-button {
      display: flex;
      align-items: center;
      gap: 6px;
      border: 1.5px solid black;
      border-radius: 8px;
      padding: 8px 14px;
      font-weight: 600;
      font-size: 14px;
      background: white;
      cursor: pointer;
      user-select: none;
    }

    .upload-button i {
      font-size: 16px;
    }

    .post-button {
      background-color: black;
      color: white;
      border-radius: 8px;
      padding: 10px 24px;
      font-weight: 600;
      font-size: 14px;
      border: none;
      cursor: pointer;
      margin-left: auto;
      margin-top: 8px;
      user-select: none;
    }

    
    @media (max-width: 640px) {
      main {
        width: 90%;
        padding: 24px;
      }

      .upload-buttons {
        justify-content: center;
      }

      .post-button {
        margin-left: 0;
        width: 100%;
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

    <main>
<form action="{{ route('rentals.update', $car->car_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label for="car_type">Tipe Mobil</label>
        <input type="text" id="car_type" name="car_type" value="{{ old('car_type', $car->type->type_name) }}" required>
    </div>
    <div>
        <label for="brand_name">Nama Brand</label>
        <input type="text" id="brand_name" name="brand_name" value="{{ old('brand_name', $car->brand->brand_name) }}" required>
    </div>
    <div>
        <label for="price_per_day">Harga per Hari</label>
        <input type="number" id="price_per_day" name="price_per_day" value="{{ old('price_per_day', $car->price_per_day) }}" required min="0">
    </div>
    <div>
        <label for="specifications">Spesifikasi</label>
        <textarea id="specifications" name="specifications">{{ old('specifications', $car->specifications) }}</textarea>
    </div>
    <div>
        <label for="stnk">Dokumen STNK (PDF)</label>
        <input type="file" id="stnk" name="stnk" accept=".pdf">
    </div>
    <div>
        <label for="photos_url">Foto Mobil (Maksimal 3)</label>
        <input type="file" id="photos_url" name="photos_url[]" multiple accept="image/*">
    </div>
    <button type="submit" class="post-button">Update</button>
</form>

<form action="{{ route('rentals.destroy', $car->car_id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mobil ini?');">
    @csrf
    @method('DELETE')
    <button type="submit">Hapus</button>
</form>
</main>

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
