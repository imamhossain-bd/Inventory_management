<nav class="w-full bg-white border-b shadow-sm h-16 flex items-center justify-between px-6 sticky top-0 z-50">
  <!-- Left: Logo + Title -->
  <div class="flex items-center space-x-3">
    <input type="search" placeholder="Search..." class="border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
  </div>

  <!-- Right: Profile + Logout + Avatar -->
  <div class="flex items-center space-x-6">
    <a href="#" class="text-gray-700 hover:text-indigo-600 font-medium transition">Profile</a>

    <a href="#"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="text-red-600 hover:text-red-700 font-medium transition">
      Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
      @csrf
    </form>

    <!-- Avatar -->
    <div class="w-10 h-10 rounded-full bg-indigo-500 text-white flex items-center justify-center font-semibold shadow">
      {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
    </div>
  </div>
</nav>
