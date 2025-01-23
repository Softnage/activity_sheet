@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center h-screen bg-gray-50">
    <div class="text-center">
        <!-- Animation Section -->
        <div class="relative h-64 w-full flex justify-center items-center mb-6">
            <div class="animate-bounce text-blue-500 text-9xl font-bold">
                404
            </div>
            <img src="{{ asset('images/lost.jpg') }}" alt="Lost Character" 
                class="absolute top-0 h-40 animate-float" 
                style="animation-duration: 3s;">
        </div>

        <!-- Message Section -->
        <h1 class="text-3xl font-semibold text-gray-800 mb-4">Page Not Found</h1>
        <p class="text-gray-600 mb-6">Oops! The page you're looking for doesn't exist. It might have been moved or deleted.</p>

        <!-- Back to Home Button -->
        <a href="{{ route('dashboard') }}" 
            class="px-6 py-3 bg-blue-500 text-white rounded-lg shadow-lg hover:bg-blue-600 transition duration-300">
            Go to Dashboard
        </a>
    </div>
</div>
@endsection
