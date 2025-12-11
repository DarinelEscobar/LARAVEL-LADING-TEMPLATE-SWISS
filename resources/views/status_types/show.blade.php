@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Status Type Details</h1>
            <a href="{{ route('status-types.index') }}" class="text-blue-600 hover:underline">Back to list</a>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <p class="mb-2"><strong>ID:</strong> {{ $statusType->id }}</p>
            <p class="mb-2"><strong>Name:</strong> {{ $statusType->name }}</p>
        </div>
    </div>
@endsection
