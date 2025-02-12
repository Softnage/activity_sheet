<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        /* Sidebar styles */
        #sidebar {
            /* background-color: #fff; */
            color: #fff;
        }

        #sidebar a {
            font-weight: 500;
        }

        #sidebar a.active,
        #sidebar a:hover {
            background-color: #3730a3;
            color: #ffffff;
        }

        /* Button styles */
        button {
            transition: all 0.3s ease-in-out;
        }

        button:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-white">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="w-64 h-screen fixed md:relative z-20 hidden md:flex flex-col bg-blue-700">
            <div class="p-6 text-center text-2xl font-bold border-b border-white/20">
                <i class="fas fa-user-shield"></i> Admin Panel
            </div>
            <nav class="flex flex-col mt-6 space-y-2 px-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="p-3 rounded-lg flex items-center gap-3 transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white text-gray-800 shadow-md' : 'hover:bg-white/20' }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="{{ route('admin.manageUsers') }}"
                    class="p-3 rounded-lg flex items-center gap-3 transition-all {{ request()->routeIs('admin.manageUsers') ? 'bg-white text-gray-800 shadow-md' : 'hover:bg-white/20' }}">
                    <i class="fas fa-users"></i> Manage Users
                </a>
                <a href="{{ route('admin.assign-task') }}"
                    class="p-3 rounded-lg flex items-center gap-3 transition-all {{ request()->routeIs('admin.assign-task') ? 'bg-white text-gray-800 shadow-md' : 'hover:bg-white/20' }}">
                    <i class="fas fa-tasks"></i> Assign Tasks
                </a>
                <a href="{{ route('admin.viewAllActivities') }}"
                    class="p-3 rounded-lg flex items-center gap-3 transition-all {{ request()->routeIs('admin.viewAllActivities') ? 'bg-white text-gray-800 shadow-md' : 'hover:bg-white/20' }}">
                    <i class="fas fa-clipboard-list"></i> View Activities
                </a>
                <a href="{{ route('admin.viewAllTasks') }}"
                    class="p-3 rounded-lg flex items-center gap-3 transition-all {{ request()->routeIs('admin.tasks') ? 'bg-white text-gray-800 shadow-md' : 'hover:bg-white/20' }}">
                    <i class="fas fa-tasks"></i> View Tasks
                </a>
                <a href="{{ route('admin.showCreateMeetingForm') }}"
                    class="p-3 rounded-lg flex items-center gap-3 transition-all {{ request()->routeIs('admin.showCreateMeetingForm') ? 'bg-white text-gray-800 shadow-md' : 'hover:bg-white/20' }}">
                    <i class="fas fa-calendar-plus"></i> Create Meeting
                </a>
                <!-- <a href="{{ route('admin.storeMeeting') }}"
                    class="p-3 rounded-lg flex items-center gap-3 transition-all {{ request()->routeIs('admin.storeMeeting') ? 'bg-white text-gray-800 shadow-md' : 'hover:bg-white/20' }}">
                    <i class="fas fa-calendar-check"></i> Manage Meetings
                </a> -->
            </nav>
        </div>

        <!-- Main Content -->
        <div id="mainContent" class="flex-1 p-6 ml-64 md:ml-0 transition-all duration-300">
            <!-- Toggle Sidebar -->
            <button id="toggleSidebar" class="md:hidden bg-blue-600 text-white px-4 py-2 rounded-md">
                <i class="fas fa-bars"></i>
            </button>
            <div class="mt-4">
                <!-- <h1 class="text-3xl font-semibold text-gray-700">@yield('header', 'Admin Dashboard')</h1> -->
                <div class="mt-6">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Sidebar Toggle -->
    <script>

        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.querySelector('#sidebar');
        const mainContent = document.querySelector('#mainContent');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            if (sidebar.classList.contains('hidden')) {
                mainContent.classList.remove('ml-64');
                mainContent.classList.add('ml-0');
            } else {
                mainContent.classList.remove('ml-0');
                mainContent.classList.add('ml-64');
            }
        });
    </script>
</body>


</html>
