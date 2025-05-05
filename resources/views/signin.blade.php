<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>G3TWAY | Sign In</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    * {
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      background: url('{{ asset('assets/Sign.png') }}') no-repeat center center/cover;
    }

    .overlay {
      height: 100%;
      width: 100%;
      background: rgba(0, 0, 0, 0.5);
      display: flex;
      flex-direction: column;
      color: white;
    }

      .top-bar {
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 70px;
        padding: 0 40px;
        margin-top: 10px;
        z-index: 2000;
      }

    .menu {
      position: relative;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 22px;
      font-weight: 500;
      cursor: pointer;
      color: white;
      z-index: 3000;
    }

    .menu i {
      font-size: 24px;
    }

    .logo-wrapper {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }

    .logo-wrapper img {
      height: 100px;
    }

    .sidebar-menu {
      position: fixed;
      top: 0;
      left: -320px;
      width: 300px;
      height: 100%;
      background-color: white;
      box-shadow: 2px 0 10px rgba(0,0,0,0.2);
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
      font-size: 20px;
      font-weight: 500;
      padding: 10px 0;
      border-bottom: 1px solid #eee;
    }

    .sidebar-menu a:hover {
      color: #555;
    }

    .menu.active {
      color: black;
    }

    /* Content */
    .content-wrapper {
      flex: 1;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      padding: 0 100px 80px 100px;
    }

    .auth-container {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 30px;
      border-radius: 20px;
      width: 350px;
    }

    .tab-buttons {
      display: flex;
      margin-bottom: 20px;
    }

    .tab-buttons button {
      flex: 1;
      padding: 10px;
      background-color: transparent;
      border: 1.5px solid white;
      color: white;
      cursor: pointer;
      font-weight: 600;
      transition: 0.3s;
      border-radius: 0;
    }

    .tab-buttons button:first-child {
      border-right: none;
    }

    .tab-buttons button.active,
    .tab-buttons button:hover {
      background-color: white;
      color: black;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1.5px solid white;
      border-radius: 8px;
      background-color: transparent;
      color: white;
    }

    .form-group input::placeholder {
      color: #ccc;
    }

    .submit-btn {
      background-color: white;
      color: black;
      padding: 10px;
      width: 100%;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
      font-weight: 600;
    }

    .submit-btn:hover {
      background-color: #00ccff;
      color: white;
    }

    .hidden {
      display: none;
    }
  </style>
</head>

<body>
  <div class="overlay">

    <div class="top-bar">
      

      <div class="logo-wrapper">
        <a href="{{ url('/') }}">
          <img src="{{ asset('assets/Logo_White.png') }}" alt="G3TWAY Logo" />
        </a>
      </div>

      <div style="visibility: hidden;">
        <span>Menu</span>
      </div>
    </div>
<div class="content-wrapper">
    <div class="auth-container">
        <div class="tab-buttons">
            <button id="btn-signin" class="active">Sign In</button>
            <button id="btn-signup">Sign Up</button>
        </div>

        <!-- Form Sign In -->
        <form id="form-signin" method="POST" action="{{ route('signin.process') }}">
            @csrf
            <div class="form-group">
                <input type="email" name="email" placeholder="Enter your email" required>
                @error('email') 
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Enter your password" required>
                @error('password') 
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="submit-btn">Sign In</button>
        </form>

        <!-- Form Sign Up -->
        <form id="form-signup" class="hidden" method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="name" placeholder="Enter your name" required>
                @error('name') 
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Enter your email" required>
                @error('email') 
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="phone" placeholder="Enter your phone number" required>
                @error('phone') 
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Enter your password" required>
                @error('password') 
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="submit-btn">Register</button>
        </form>
    </div>
</div>

  </div>

  <!-- Script -->
  <script>
    // Toggle between Sign In and Sign Up
    const btnSignin = document.getElementById("btn-signin");
    const btnSignup = document.getElementById("btn-signup");
    const formSignin = document.getElementById("form-signin");
    const formSignup = document.getElementById("form-signup");

    btnSignin.addEventListener("click", () => {
      formSignin.classList.remove("hidden");
      formSignup.classList.add("hidden");
      btnSignin.classList.add("active");
      btnSignup.classList.remove("active");
    });

    btnSignup.addEventListener("click", () => {
      formSignup.classList.remove("hidden");
      formSignin.classList.add("hidden");
      btnSignup.classList.add("active");
      btnSignin.classList.remove("active");
    });

    // Toggle Sidebar
    const menuButton = document.getElementById('menuButton');
    const sidebarMenu = document.getElementById('sidebarMenu');

    menuButton.addEventListener('click', () => {
      sidebarMenu.classList.toggle('active');
      menuButton.classList.toggle('active');
    });
  </script>
</body>
</html>
