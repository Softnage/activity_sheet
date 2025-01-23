@extends('admin.layout')

@section('title', 'All Tasks')

@section('content')
@include('components.export-activities')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-4">All Assigned Tasks</h1>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 p-2 text-left">Task ID</th>
                    <th class="border border-gray-200 p-2 text-left">Title</th>
                    <th class="border border-gray-200 p-2 text-left">Assigned User</th>
                    <th class="border border-gray-200 p-2 text-left">Description</th>
                    <th class="border border-gray-200 p-2 text-left">Priority</th>
                    <th class="border border-gray-200 p-2 text-left">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-200 p-2">{{ $task->id }}</td>
                        <td class="border border-gray-200 p-2">{{ $task->title }}</td>
                        <td class="border border-gray-200 p-2">{{ $task->user->name }}</td>
                        <td class="border border-gray-200 p-2">{{$task->task_description}}</td>
                        <td class="border border-gray-200 p-2">{{ $task->priority }}</td>
                        <td class="border border-gray-200 p-2">{{ $task->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
