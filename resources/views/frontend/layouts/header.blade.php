



<header class="w-full bg-slate-400 h-28 ">
    <div class="container mx-auto h-full flex justify-between items-center">
        <h1 class="text-3xl font-bold text-white">Inventory Management</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="#" class="text-white hover:underline">Home</a></li>
                    <li><a href="#" class="text-white hover:underline">About</a></li>
                    <li><a href="#" class="text-white hover:underline">Contact</a></li>
                </ul>
            </nav>

                {{-- Authentication --}}
        <div class="flex space-x-4">
            <a href="{{ route('login') }}" class="text-white">Login</a>
            <a href="{{ route('register') }}" class="text-white">Register</a>
        </div>
    </div>
</header>
