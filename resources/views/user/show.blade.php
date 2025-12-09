@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">User Details</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Name
                </label>
                <p class="text-gray-900 border-b pb-2">{{ $user->name }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Email
                </label>
                <p class="text-gray-900 border-b pb-2">{{ $user->email }}</p>
            </div>
            <div class="flex items-center justify-between mt-6">
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" href="{{ route('users.edit', $user) }}">
                    Edit
                </a>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('users.index') }}">
                    Back to List
                </a>
            </div>
        </div>
    </div>
@endsection
