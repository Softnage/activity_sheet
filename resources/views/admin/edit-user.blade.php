@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Edit User</h1>
    
    <form action="{{ route('admin.updateUser', $user->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block font-medium">Name</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" 
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring">
        </div>
        
        <div>
            <label for="email" class="block font-medium">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" 
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring">
        </div>
        
        <div>
            <label for="is_admin" class="block font-medium">Role</label>
            <select name="is_admin" id="is_admin" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="0" {{ !$user->is_admin ? 'selected' : '' }}>User</option>
                <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        
        <div class="text-right">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>
@endsection
