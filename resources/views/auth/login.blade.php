<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | E-Shop</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }
    .animate-fadeIn { animation: fadeIn 0.8s ease-out; }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-100 to-purple-100 flex items-center justify-center relative overflow-hidden">

  <!-- Soft background shapes -->
  <div class="absolute top-0 left-0 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
  <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>

  <section class="z-10 w-11/12 sm:w-96 md:w-[400px] bg-white/80 backdrop-blur-xl rounded-2xl shadow-2xl p-8 animate-fadeIn">

    <!-- 🔙 Back to Home Button -->
    <div class="mb-6">
      <a href="{{ url('/') }}"
         class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-semibold transition group">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-5 w-5 mr-1 group-hover:-translate-x-1 transition-transform"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 19l-7-7 7-7" />
        </svg>
        Back to Home
      </a>
    </div>

    <div class="text-center mb-8">
      <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Welcome Back 👋</h1>
      <p class="text-gray-500 mt-2 text-sm">
        Login to your <span class="font-semibold text-indigo-600">E-Shop</span> account
      </p>
    </div>

    <form action="{{ route('login') }}" method="POST" class="space-y-6">
      @csrf

      <div>
        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
        @error('email')
          <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div>
        <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
        <input type="password" id="password" name="password" required
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
        @error('password')
          <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="flex items-center justify-between text-sm">
        <label class="flex items-center text-gray-600">
          <input type="checkbox" id="remember" name="remember" class="mr-2 accent-indigo-600">
          Remember Me
        </label>
        <a href="#" class="text-indigo-600 hover:underline font-medium">Forgot password?</a>
      </div>

      <button type="submit"
        class="w-full py-2.5 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition-all duration-300">
        Login
      </button>
    </form>

    <p class="text-center text-gray-600 mt-6 text-sm">
      Don’t have an account?
      <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:underline">Register</a>
    </p>
  </section>
</body>
</html>
