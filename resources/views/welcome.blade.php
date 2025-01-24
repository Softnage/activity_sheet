<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- robot font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Hero Section -->
    <section class="h-screen bg-gradient-to-r from-green-400 to-blue-500 flex items-center justify-center relative">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        </div>

        <div class="relative z-10 text-center px-6 max-w-3xl">
            <h1 class="text-6xl font-bold text-white mb-6">Welcome to Your Activity Dashboard</h1>
            <p class="text-xl text-gray-100 mb-8">
                Track, manage, and organize your activities effortlessly with a beautiful and intuitive interface.
            </p>
            <a href="#features" class="px-8 py-4 bg-white text-blue-600 font-medium rounded-lg shadow-lg hover:bg-gray-200 transition">
                Explore Features
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-12">Key Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition">
                    <div class="text-6xl text-green-500 mb-4">
                        &#128197;
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Schedule Management</h3>
                    <p class="text-gray-600">Easily manage your schedules and stay ahead of deadlines.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition">
                    <div class="text-6xl text-blue-500 mb-4">
                        &#128640;
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Goal Tracking</h3>
                    <p class="text-gray-600">Set your goals and visualize your progress with our intuitive tools.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition">
                    <div class="text-6xl text-yellow-500 mb-4">
                        &#128187;
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Data Insights</h3>
                    <p class="text-gray-600">Gain valuable insights into your activities with detailed analytics.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="bg-gradient-to-r from-purple-500 to-pink-500 py-20 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Get Started Today</h2>
            <p class="text-lg mb-8">Take control of your activities and boost your productivity. Sign up now to begin your journey.</p>
            <a href="/register" class="px-8 py-4 bg-white text-purple-600 font-medium rounded-lg shadow-lg hover:bg-gray-200 transition">
                Sign Up Now
            </a>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-gray-800 text-gray-400 py-8">
        <div class="container mx-auto px-6 text-center">
            <p class="text-sm">&copy; 2025 Activity Dashboard. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>