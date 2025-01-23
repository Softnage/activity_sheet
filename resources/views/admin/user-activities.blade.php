@extends('admin.layout')

@section('title', 'User Activities')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Activities for {{ $user->name }}</h1>

        <!-- Activities Table -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-200 p-2 text-left">Title</th>
                        <th class="border border-gray-200 p-2 text-left">Date</th>
                        <th class="border border-gray-200 p-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-200 p-2">{{ $activity->title }}</td>
                            <td class="border border-gray-200 p-2">{{ $activity->created_at->format('Y-m-d') }}</td>
                            <td class="border border-gray-200 p-2">{{ ucfirst($activity->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
