<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Activity Sheet - Welcome</title>
  <link rel="icon" href="{{ asset('images/favicon.webp') }}" type="image/x-icon">

  <script src="https://cdn.tailwindcss.com"></script>
  <!-- core js -->
   <!-- Core JS CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/3.32.0/minified.js" integrity="sha512-k6r/cECg5yHEVZht/7YoCEppbAH8W5I4uLwrV90L+H5OPvgW/uwnYrp4LsESVWnTWrNIFGa3kOAl2yZdAghUVg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- nunito fomt -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: 'Nunito', sans-serif;
        }
    </style>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="bg-white">
      <!-- Navbar -->
  <nav class="fixed top-0 left-0 w-full bg-transparent z-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 py-4 flex justify-between items-center">
      <!-- Logo -->
      <a href="#" class="text-xl font-bold text-gray-800">Softnage Activity Sheet</a>
      <!-- Buttons -->
      <div class="flex gap-4">
        <button class="text-black px-4 py-2 rounded-full hover:bg-white hover:text-black"><a href="/login"><i class="fa-solid fa-arrow-right-to-bracket"></i></a></button>
        <button class="text-white px-4 py-2 rounded-full bg-blue-600 "><a href="/register"><i class="fa-solid fa-user-plus"></i></a></button>
      </div>
    </div>
  </nav>
  <section class="flex flex-col-reverse lg:flex-row items-center justify-between max-w-7xl mx-auto px-6 lg:px-12 py-16">
    <!-- Text Section -->
    <div class="lg:w-1/2 text-center lg:text-left">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Efficient and Organized Activity Tracker</h1>
<p class="text-lg text-gray-600 mb-6">Track your progress with ease using our activity sheets. Stay organized and motivated with every task.</p>
 <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
        <button class="bg-blue-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-blue-800 focus:ring focus:ring-green-300"><a href="/register">Get Started <i class="fa-solid fa-rocket"></i></a></button>
        <button class="flex items-center gap-2 text-gray-700 border border-gray-300 px-6 py-3 rounded-full shadow-lg hover:bg-gray-100 focus:ring focus:ring-gray-200">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-4.586-2.577A1 1 0 009 9.394v5.182a1 1 0 001.166.993l4.586-1.664a1 1 0 00.752-.994v-1.758a1 1 0 00-.752-.993z" />
          </svg>
          Watch Video
        </button>
      </div>
    </div>

    <!-- Image Section -->
    <div class="lg:w-1/2 flex justify-center">
      <img src="{{ asset('images/hero-img.png') }}" alt="Illustration" class="w-full max-w-md lg:max-w-lg">
    </div>
  </section>
</body>
</html>
