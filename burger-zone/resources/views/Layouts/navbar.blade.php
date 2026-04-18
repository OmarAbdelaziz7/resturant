<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Feane Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Global Feane Style -->
    <link href="{{ asset('css/feane_menu.css') }}" rel="stylesheet" />
    <title>Burger Zone</title>
</head>
<body class="sub_page">
  <div class="hero_area">
    <div class="bg-box">
      <!-- Background image could be added here if needed -->
    </div>
    <!-- header section strats -->
    <header class="header_section" style="background-color: #222831; padding: 15px 0;">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container p-0">
          <a class="navbar-brand" href="{{ url('/') }}">
            <span style="font-family: 'Dancing Script', cursive; font-size: 32px; color: #ffffff;">
              Burger Zone
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="color: white; font-size: 24px;">☰</span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}" style="color: white; text-transform: uppercase;">Home </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="{{ url('/menu') }}" style="color: white; text-transform: uppercase;">Menu <span class="sr-only">(current)</span> </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" style="color: white; text-transform: uppercase;">About</a>
              </li>
            </ul>
            <div class="user_option" style="display: flex; align-items: center;">
              <a href="" class="user_link" style="color: white; margin-right: 15px; font-size: 18px;">
                <i class="fa fa-user" aria-hidden="true"></i>
              </a>
              <a class="cart_link" href="#" style="color: white; margin-right: 15px; font-size: 18px;">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
              </a>
              <a href="" class="order_online" style="display: inline-block; padding: 8px 30px; background-color: #ffbe33; color: #ffffff; border-radius: 45px; transition: all 0.3s; border: none; text-decoration: none;">
                Order Online
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <section class="container-fluid p-0">
      @yield('content')
  </section>

  <!-- jQuery must be loaded first -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Then Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  
  @yield('scripts')
</body>
</html>