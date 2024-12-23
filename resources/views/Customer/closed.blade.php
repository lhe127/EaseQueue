<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Closed</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="text-center bg-white p-6 rounded shadow-lg">
        <h1 class="text-3xl font-bold text-red-500 mb-4">System Closed</h1>
        <p class="text-lg">Our system is currently unavailable. Please visit us during our operational hours.</p>
        <p class="mt-4 text-gray-600">Operational Hours: {{$openTimeFrom}} - {{$openTimeTo}}</p>
    </div>
</body>

</html>