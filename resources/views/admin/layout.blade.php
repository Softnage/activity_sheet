<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins&display=swap');
        * {
            font-family: 'Nunito', sans-serif;
        }

        /* Additional styles for responsive sidebar */
        @media (max-width: 768px) {
            #sidebar {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="w-64 bg-gray-800 text-gray-200 h-screen fixed md:relative z-20 hidden md:flex flex-col">
            <div class="p-6 text-center text-2xl font-bold border-b border-gray-700">
                <i class="fas fa-user-shield"></i> Admin Panel
            </div>
            <nav class="flex flex-col mt-4 space-y-2 px-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="hover:bg-gray-700 p-2 rounded flex items-center {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-home mr-3"></i> Dashboard
                </a>
                <a href="{{ route('admin.manageUsers') }}"
                    class="hover:bg-gray-700 p-2 rounded flex items-center {{ request()->routeIs('admin.manageUsers') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-users mr-3"></i> Manage Users
                </a>
                <a href="{{ route('admin.assign-task') }}"
                    class="hover:bg-gray-700 p-2 rounded flex items-center {{ request()->routeIs('admin.assign-task') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-tasks mr-3"></i> Assign Tasks
                </a>
                <a href="{{ route('admin.viewAllActivities') }}"
                    class="hover:bg-gray-700 p-2 rounded flex items-center {{ request()->routeIs('admin.viewAllActivities') ? 'bg-gray-700' : '' }}">
                    <i class="fas fa-clipboard-list mr-3"></i> View Activities
                </a>
                <a href="{{ route('admin.viewAllTasks') }}"
                class="hover:bg-gray-700 p-2 rounded flex items-center {{ request()->routeIs('admin.tasks') ? 'bg-gray-700' : '' }}">
                <i class="fas fa-tasks mr-3"></i> View Tasks
            </a>
                <!-- Future routes can be uncommented and added here -->
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6 ml-64 md:ml-0">
            <button id="toggleSidebar" class="md:hidden bg-gray-800 text-white px-4 py-2 rounded">
                <i class="fas fa-bars"></i>
            </button>
            <div class="mt-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- JavaScript for Sidebar Toggle -->
    <script>
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.querySelector('#sidebar');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });
    </script>
</body>

</html>
