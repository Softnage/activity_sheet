@extends('admin.layout')

@section('title', 'Manage Users')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Manage Users</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2 bg-gray-100">ID</th>
                    <th class="border px-4 py-2 bg-gray-100">Name</th>
                    <th class="border px-4 py-2 bg-gray-100">Email</th>
                    <th class="border px-4 py-2 bg-gray-100">Role</th>
                    <th class="border px-4 py-2 bg-gray-100">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                        <td class="border px-4 py-2">{{ $user->id }}</td>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                        <td class="border px-4 py-2 text-center">
                            <a href="{{ route('admin.editUser', $user->id) }}" 
                               class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" 
                                  class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline ml-2"
                                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border px-4 py-2 text-center">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
