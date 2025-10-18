<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>@yield('title', 'Admin Dashboard')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col font-[Inter]">

  <div class="flex min-h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#fff] text-gray-100 flex flex-col fixed inset-y-0 left-0 z-40">
      @include('backend.sidebar.sidebar')
    </aside>

    <!-- Main Section -->
    <div class="flex-1 ml-64 flex flex-col h-screen">

      <!-- Header (Top Navbar) -->
      <header class="sticky top-0 z-30">
        @include('backend.layouts.header')
      </header>

      <!-- Main Content -->
      <main class="flex-1 bg-gray-50 overflow-y-auto p-8">
        @yield('content')
      </main>

    </div>
  </div>

</body>
</html>
