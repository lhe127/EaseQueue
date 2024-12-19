<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgb(50, 183, 224);
            color: white;
            padding: 20px 40px;
        }
        .date, .time {
            margin: 0;
        }
    </style>
</head>
<body>

<header>
    <h2 class="date text-2xl font-bold">{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</h2>
    <h2 class="time text-2xl font-bold" id="time"></h2>
</header>
@yield('content')

<script>
    function updateTime() {
        const now = new Date();
        document.getElementById('time').textContent = now.toLocaleTimeString();
    }

    // Update time immediately
    updateTime();

    // Update time every second
    setInterval(updateTime, 1000);
</script>

</body>
</html>