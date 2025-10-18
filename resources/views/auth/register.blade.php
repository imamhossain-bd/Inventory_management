<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | E-Commerce</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
  <section class="flex flex-col md:flex-row bg-white shadow-2xl rounded-2xl overflow-hidden w-full max-w-5xl animate-fade-in">

    <!-- Left side (Form) -->
    <div class="w-full md:w-1/2 p-10">
      <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Create Your Account</h1>
      <form action="{{ route('register') }}" method="POST" class="space-y-5">
        @csrf

        <div>
          <label for="name" class="block text-gray-600 font-medium mb-1">Name</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          @error('name')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <label for="email" class="block text-gray-600 font-medium mb-1">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          @error('email')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <label for="password" class="block text-gray-600 font-medium mb-1">Password</label>
          <input type="password" id="password" name="password" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          @error('password')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <label for="password_confirmation" class="block text-gray-600 font-medium mb-1">Confirm Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <button type="submit"
                class="w-full py-2 mt-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition-transform transform hover:scale-[1.02] duration-200">
          Register
        </button>
      </form>

      <p class="text-center mt-5 text-gray-600">
        Already have an account?
        <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Login here</a>
      </p>
    </div>

    <!-- Right side (Design Section) -->
    <div class="hidden md:flex w-1/2 bg-gradient-to-br from-blue-600 to-indigo-700 text-white flex-col items-center justify-center p-10 relative">
      <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1605902711622-cfb43c4437f0?auto=format&fit=crop&w=900&q=80')] bg-cover bg-center opacity-20"></div>
      <div class="relative z-10 text-center animate-slide-up">
        <h2 class="text-4xl font-extrabold mb-4">Welcome to ShopSphere</h2>
        <p class="text-lg text-blue-100 mb-6">Join our community and experience the best online shopping platform.</p>
        <div class="flex justify-center space-x-3">
          <span class="h-3 w-3 bg-white rounded-full animate-pulse"></span>
          <span class="h-3 w-3 bg-white rounded-full animate-pulse delay-150"></span>
          <span class="h-3 w-3 bg-white rounded-full animate-pulse delay-300"></span>
        </div>
      </div>
    </div>

  </section>

  <!-- Tailwind custom animations -->
  <style>
    @keyframes fade-in {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
      animation: fade-in 0.6s ease-out;
    }
    @keyframes slide-up {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-up {
      animation: slide-up 0.8s ease-out forwards;
    }
  </style>
</body>
</html>
