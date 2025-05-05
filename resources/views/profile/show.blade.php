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
      margin: 50px auto 350px auto;
      width: 85%;
      max-width: 600px;
      background-color: #e6e9ed;
      border-radius: 24px;
      padding: 32px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      box-sizing: border-box;
      min-height: auto;
      color: black;
    }

    main label {
      font-weight: 700;
      font-size: 14px;
      margin-bottom: 6px;
      color: #4b4b4b;
      display: block;
    }

    main input {
      width: 100%;
      background: white;
      border: none;
      border-radius: 8px;
      padding: 12px 16px;
      font-weight: 400;
      font-size: 18px;
      color: black;
      box-sizing: border-box;
    }

    main input[readonly] {
      cursor: default;
    }

    #address {
      position: relative;
      background: white;
      border-radius: 8px;
      padding: 12px 48px 12px 16px;
      font-weight: 400;
      font-size: 18px;
      color: black;
      box-sizing: border-box;
      display: block;
      min-height: 48px;
      line-height: 1.3;
    }

    #address i {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 18px;
      color: black;
    }

    .upload-buttons {
      display: flex;
      gap: 12px;
      margin-top: 8px;
      flex-wrap: wrap;
    }

    .upload-button {
      display: flex;
      align-items: center;
      gap: 6px;
      background-color: black;
      border-radius: 6px;
      padding: 8px 14px;
      font-weight: 700;
      font-size: 14px;
      color: white;
      cursor: pointer;
      user-select: none;
      border: none;
    }

    .upload-button i {
      font-size: 16px;
    }

    @media (max-width: 640px) {
      main {
        width: 90%;
        padding: 24px;
      }

      .upload-buttons {
        justify-content: center;
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

    .submit-btn, .delete-btn {
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
      margin-top: 10px;
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
  <!-- Profile Form -->
  <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    <div>
      <label for="name">Name</label>
      <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" readonly />
    </div>

    <div>
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" readonly />
    </div>

    <div>
      <label for="phone">Phone Number</label>
      <input type="tel" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" />
    </div>

    <div>
      <label for="address">Address</label>
      <input type="text" id="address" name="address" value="{{ old('address', Auth::user()->address ?? '') }}" />
    </div>

    <div>
      <label for="name_bank">Bank Name</label>
      <input type="text" id="name_bank" name="name_bank" value="{{ old('name_bank', Auth::user()->name_bank ?? '') }}" />
    </div>

    <div>
      <label for="bank_number">Bank Account Number</label>
      <input type="text" id="bank_number" name="bank_number" value="{{ old('bank_number', Auth::user()->bank_number ?? '') }}" />
    </div>

    <div>
      <label for="password">New Password (leave blank if unchanged)</label>
      <input type="password" id="password" name="password" />
    </div>

    <div>
      <label for="identity_card">Identity Card (KTP)</label>
      <input type="file" id="identity_card" name="identity_card" />
      @if(Auth::user()->identity_card)
        <p>Current File: <a href="{{ Storage::url(Auth::user()->identity_card) }}" target="_blank">View Identity Card</a></p>
      @endif
    </div>

    <div>
      <label for="driving_license">Driving License (SIM)</label>
      <input type="file" id="driving_license" name="driving_license" />
      @if(Auth::user()->driving_license)
        <p>Current File: <a href="{{ Storage::url(Auth::user()->driving_license) }}" target="_blank">View Driving License</a></p>
      @endif
    </div>

    <button type="submit" class="submit-btn">Update Profile</button>
  </form>

  <!-- Delete Profile Form -->
  <form method="POST" action="{{ route('profile.destroy', ['id' => Auth::id()]) }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
    @csrf
    @method('DELETE')
    <button type="submit" style="margin-top: 20px; color: red;" class="delete-btn">Delete My Account</button>
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