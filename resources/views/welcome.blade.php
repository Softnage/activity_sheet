<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softnage's Activity Sheet</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <section class="relative h-screen bg-gradient-to-r from-purple-500 to-indigo-500 flex items-center justify-center">
        <!-- Background image -->
        <div class="absolute inset-0 bg-cover bg-center" 
             style="background-image: url('http://softnage.com/images/team/team-full.png');">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        </div>
    
        <!-- Glassmorphic Content -->
        <div class="relative z-10 bg-white bg-opacity-20 backdrop-blur-lg rounded-2xl shadow-lg p-8 text-center max-w-3xl">
            <h1 class="text-5xl font-extrabold text-white mb-6">Welcome to Softnage Activity Sheet</h1>
            <p class="text-lg text-gray-200 mb-8">
                Organize, track, and manage activities effortlessly with a sleek and modern interface.
            </p>
            
            <a href="/login" 
               class="px-6 py-3 bg-white text-indigo-600 font-medium rounded-lg shadow-md hover:bg-gray-100 transition">
                Get Started
            </a>
        </div>
    
        <!-- Bottom navigation or link -->
        <div class="absolute bottom-4 left-0 right-0 w-full text-center">
            <p class="text-sm text-gray-200">
                New here? <a href="/register" class="text-white underline">Sign up now</a>.
            </p>
        </div>
    </section>
    

    <!-- About Section -->
    <section class="py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-semibold mb-6">About the Project</h2>
            <p class="text-lg mb-8 text-gray-600">
                Softnage's Activity Sheet is your one-stop solution for tracking tasks, managing responsibilities, and collaborating efficiently across teams.
            </p>
            <div class="flex justify-center">
                <img src="https://www.slideteam.net/wp/wp-content/uploads/2023/12/Pre-Event-Planning-Activity-Sheet.png" 
                     alt="Activity Sheet" 
                     class="rounded-lg shadow-lg w-full sm:w-3/4 lg:w-2/3">
            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-semibold text-center mb-12">Key Features</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Task Management -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transform hover:scale-105 transition">
                    <i class="fas fa-tasks text-5xl text-purple-600 mb-6"></i>
                    <h3 class="text-xl font-bold mb-4">Task Management</h3>
                    <p class="text-gray-600">Assign, track, and manage tasks effortlessly, ensuring smooth workflows and timely completions.</p>
                </div>
    
                <!-- Team Collaboration -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transform hover:scale-105 transition">
                    <i class="fas fa-users text-5xl text-indigo-600 mb-6"></i>
                    <h3 class="text-xl font-bold mb-4">Team Collaboration</h3>
                    <p class="text-gray-600">Stay connected, share updates, and collaborate in real-time to achieve your team goals.</p>
                </div>
    
                <!-- Progress Tracking -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transform hover:scale-105 transition">
                    <i class="fas fa-chart-line text-5xl text-teal-600 mb-6"></i>
                    <h3 class="text-xl font-bold mb-4">Progress Tracking</h3>
                    <p class="text-gray-600">Visualize your progress and monitor task completions with ease using built-in tools.</p>
                </div>
            </div>
        </div>
    </section>
    

    <!-- Call to Action Section -->
    <section class="py-20 bg-gradient-to-r from-teal-500 to-blue-500 text-black">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-semibold mb-6">Join Us and Get Started</h2>
            <p class="text-lg mb-8">Sign up today and take the first step towards a more organized and productive workflow.</p>
            <a href="/register" class="px-8 py-3 bg-white text-teal-600 text-lg font-medium rounded-lg shadow-lg hover:bg-gray-100 transition">
                Sign Up Now
            </a>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-gray-900 text-gray-300 py-8">
        <div class="container mx-auto px-6 text-center">
            <p class="text-sm">© 2024 Softnage Activity Sheet. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
