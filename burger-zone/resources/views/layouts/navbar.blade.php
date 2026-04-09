<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href={{ asset("css/bootstrap.min.css") }}> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href={{ asset("css/style.css") }}>
    <title>burger-zone</title>
</head>
<body class=" ">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light">
            <div class="container">
                <a class="navbar-brand" href="#">Burger Zone</a>
            <button
                class="navbar-toggler d-lg-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavId">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" aria-current="page">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    
                </ul>
                
            </div>
        </div>
    </nav>
    

    <section class="container-fluid">
        @yield('content')
    </section>
    {{-- <script src={{ asset("js/bootstrap.bundle.js") }}></script> --}}
</body>
</html>