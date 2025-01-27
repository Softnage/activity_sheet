<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: #333;
        }

        .header {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e5e5;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #4a4a4a;
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            padding: 1rem 2rem;
        }

        .navigation a {
            text-decoration: none;
            color: #4a4a4a;
            margin: 0 1rem;
            /* font-weight: 500; */
        }

        .navigation a:hover {
            color: #007bff;
        }

        .main-content {
            margin: 2rem auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .main-content h2 {
            font-size: 1.5rem;
            /* font-weight: 600; */
            margin-bottom: 1rem;
        }

        .footer {
            background-color: #ffffff;
            border-top: 1px solid #e5e5e5;
            text-align: center;
            padding: 1rem;
            margin-top: 2rem;
            color: #4a4a4a;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
        </style>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body>
        <header class="header">
        @include('layouts.navigation')
        </header>

        <main class="main-content">
            @isset($header)
                <header>
                    <h2>{{ $header }}</h2>
                </header>
            @endisset

            <section>
                @yield('content')
            </section>
        </main>

        <footer class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
        </footer>
    </body>
</html>