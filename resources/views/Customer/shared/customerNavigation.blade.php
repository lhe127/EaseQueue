<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/customer/navigation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>@yield('title')</title>
</head>

<body>
    <nav class="navbar navbar-expand-custom navbar-mainbg">
        <a class="navbar-brand navbar-logo" href="#">EaseQueue</a>
        <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <div class="hori-selector">
                    <div class="left"></div>
                    <div class="right"></div>
                </div>
                <li class="nav-item active">
                    <a class="nav-link" href="#" data-url="{{route('customerHome')}}"><i class="fas fa-tachometer-alt"></i>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-url="{{route('customerHistory')}}"><i class="fas fa-history"></i>History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-url="{{route('customerAbout')}}"><i class="fas fa-info-circle"></i>About</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" id="content">
        @yield('content')
    </div>

    <script>
        // Responsive navbar active animation
        function test() {
            var tabsNewAnim = $('#navbarSupportedContent');
            var activeItemNewAnim = tabsNewAnim.find('.active');
            var itemPosNewAnim = activeItemNewAnim.position();
    
            // Debugging: Log positions and dimensions
            console.log("Active Item Position:", itemPosNewAnim);
            console.log("Active Item Dimensions:", {
                height: activeItemNewAnim.innerHeight(),
                width: activeItemNewAnim.innerWidth()
            });
    
            $(".hori-selector").css({
                "top": itemPosNewAnim.top + "px",
                "left": itemPosNewAnim.left + "px",
                "height": activeItemNewAnim.innerHeight() + "px",
                "width": activeItemNewAnim.innerWidth() + "px"
            });
    
            $("#navbarSupportedContent").on("click", "li", function () {
                $('#navbarSupportedContent ul li').removeClass("active");
                $(this).addClass('active');
                var itemPosNewAnim = $(this).position();
    
                // Debugging: Log positions and dimensions
                console.log("Clicked Item Position:", itemPosNewAnim);
                console.log("Clicked Item Dimensions:", {
                    height: $(this).innerHeight(),
                    width: $(this).innerWidth()
                });
    
                $(".hori-selector").css({
                    "top": itemPosNewAnim.top + "px",
                    "left": itemPosNewAnim.left + "px",
                    "height": $(this).innerHeight() + "px",
                    "width": $(this).innerWidth() + "px"
                });
            });
        }
    
        $(document).ready(function () {
            setTimeout(test);
        });
    
        $(window).on('resize', function () {
            setTimeout(test, 500);
        });
    
        $(".navbar-toggler").click(function () {
            $(".navbar-collapse").slideToggle(300);
            setTimeout(test);
        });
    
        // Load content dynamically based on navigation link click
        $(document).on('click', '.nav-link', function (e) {
            e.preventDefault();
            var url = $(this).data('url');
    
            if (url) {
                $('#content').load(url + ' #content > *', function (response, status, xhr) {
                    if (status === "error") {
                        alert("Sorry, but there was an error: " + xhr.status + " " + xhr.statusText);
                    } else {
                        history.pushState(null, '', url);
                        $('#navbarSupportedContent .nav-item').removeClass('active');
                        $('#navbarSupportedContent .nav-link[data-url="' + url + '"]').parent().addClass('active');
                        test(); // Re-run the test function to update the animation
                    }
                });
            } else {
                console.warn("No URL found for this navigation link.");
            }
        });
    
        // Handle back/forward navigation
        window.onpopstate = function () {
            var currentPath = location.pathname;
            $('#content').load(currentPath + ' #content > *', function (response, status, xhr) {
                if (status === "error") {
                    alert("Unable to load content: " + xhr.status + " " + xhr.statusText);
                } else {
                    test(); // Re-run the test function to update the animation
                }
            });
        };
    </script>
</body>

</html>