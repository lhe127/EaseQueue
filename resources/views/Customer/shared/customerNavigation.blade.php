<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/Customer/navigation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>@yield('title')</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-mainbg">
        <a class="navbar-brand navbar-logo" href="#">EaseQueue</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                {{-- <div class="hori-selector">
                    <div class="left"></div>
                    <div class="right"></div>
                </div> --}}
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customerHome') }}"><i class="fas fa-tachometer-alt"></i>
                        Home</a>
                </li>
                {{-- <li class="nav-item {{ request()->is('history') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customerHistory') }}"><i class="fas fa-history"></i> History</a>
                </li> --}}
                <li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customerAbout') }}"><i class="fas fa-info-circle"></i> About</a>
                </li>
                <li class="nav-item {{ request()->is('logout') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customerLogin') }}"><i class="fas fa-arrow-alt-circle-left"></i> Log Out</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <!-- Add jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        $(document).ready(function () {
            function updateActiveTab() {
                var activeItem = $('.navbar-nav .nav-item.active');
                var horiSelector = $(".hori-selector");

                if (activeItem.length > 0) {
                    var pos = activeItem.position();
                    horiSelector.css({
                        top: pos.top + "px",
                        left: pos.left + "px",
                        height: activeItem.innerHeight() + "px",
                        width: activeItem.innerWidth() + "px"
                    });
                }
            }

            updateActiveTab();

            $(window).on('resize', function () {
                setTimeout(updateActiveTab, 200);
            });
        });
    </script>
</body>

</html>