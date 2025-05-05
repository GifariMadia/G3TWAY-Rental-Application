@extends('layouts.app')

@section('title', 'Daftar Mobil')

@section('content')
<div class="top-bar">
    <div class="menu" id="menuButton">
        <i class="fas fa-bars" id="menuIcon"></i>
        <span>Menu</span>
    </div>
    <div class="logo-wrapper">
        <img src="{{ asset('assets/Logo.png') }}" alt="G3TWAY Logo" height="100" width="200" />
    </div>
</div>

<div class="car-grid">
    @foreach($cars as $car)
        <div class="car-card">
            <a href="{{ route('rentals.update', $car->car_id) }}" style="text-decoration: none; color: inherit;">
                @if($car->photos->count() > 0)
                    <img src="{{ asset('storage/' . $car->photos->first()->photos_url) }}" alt="{{ $car->brand->brand_name }}">
                @else
                    <img src="{{ asset('assets/default-image.jpg') }}" alt="{{ $car->brand->brand_name }}">
                @endif
                <h3>{{ $car->brand->brand_name }}</h3>
            </a>
        </div>
    @endforeach

    <!-- Add new rental -->
    <a href="{{ route('rentals.create') }}" class="add-card" style="text-decoration: none; color: inherit;">
        <i class="fas fa-plus add-icon"></i>
    </a>
</div>
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
      top: 120px;
      margin: 0 auto 50px auto;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      width: 85%;
      max-width: 1200px;
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
      height: fit-content;
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

    /* Add new rental card style */
    .add-card {
      background: #a4a4a4;
      border-radius: 16px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 330px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
      position: relative;
      overflow: hidden;
    }

    .add-card:hover {
      background: #999999;
      box-shadow: 0 10px 18px rgba(0, 0, 0, 0.1);
    }

    .add-icon {
      font-size: 72px;
      color: white;
      user-select: none;
      position: relative;
      z-index: 2;
    }

    .add-card img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 12px;
      opacity: 0.4;
      z-index: 1;
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