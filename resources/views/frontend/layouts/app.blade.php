<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'E-Shop')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-800">

    @include('frontend.layouts.header')


    <main class="container mx-auto py-8">
        @yield('content')
    </main>


    <footer class="bg-gray-900 text-white py-4 text-center mt-10">
        @include('frontend.layouts.footer')
    </footer>
</body>
</html>
