<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SchedNote.</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  
  <script src="{{ asset('js/init-alpine.js') }}"></script>
</head>
<body class="bg-gray-100 overflow-hidden">
  <!-- Fullscreen Landing Section -->
  <section class="min-h-screen flex flex-col justify-between bg-gray-50">
      <!-- Navbar -->
      <header class="absolute top-0 left-0 w-full flex justify-between items-center p-6 bg-white shadow-md">
          <h1 class="text-3xl font-bold text-indigo-600">SchedNote.</h1>
          <nav>
              <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600 px-3">Sign Up</a>
              <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-500">Login</a>
          </nav>
      </header>

      <!-- Hero Section -->
      <div class="flex-grow flex flex-col justify-center items-center text-center px-4">
          <h1 class="text-5xl font-extrabold text-indigo-600 mb-4">Schedule and Notebook, All in One Place</h1>
          <p class="text-xl text-gray-700 mb-6">Organize your notes and schedule your tasks efficiently with SchedNote.</p>
          <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-500">Get Started</a>
      </div>

      <!-- Features Section -->
      <section id="features" class="py-12 bg-white text-gray-900">
          <div class="max-w-7xl mx-auto px-4 text-center">
              <h2 class="text-4xl font-bold mb-8">Features</h2>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                  <!-- Feature 1 -->
                  <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                      <h3 class="text-2xl font-semibold text-indigo-600 mb-4">Task Scheduling</h3>
                      <p class="text-gray-600">Easily plan and manage your daily tasks with our built-in scheduling tool.</p>
                  </div>
                  <!-- Feature 2 -->
                  <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                      <h3 class="text-2xl font-semibold text-indigo-600 mb-4">Organized Notes</h3>
                      <p class="text-gray-600">Keep your notes well-organized and accessible anytime, anywhere.</p>
                  </div>
                  <!-- Feature 3 -->
                  <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                      <h3 class="text-2xl font-semibold text-indigo-600 mb-4">Real-time Sync</h3>
                      <p class="text-gray-600">Sync your notes and schedules across all devices for seamless access.</p>
                  </div>
              </div>
          </div>
      </section>

      <!-- Footer -->
      <footer class="bg-gray-900 text-white py-4 text-center">
          <p>&copy; 2024 SchedNote. All Rights Reserved.</p>
      </footer>
  </section>
</body>
</html>