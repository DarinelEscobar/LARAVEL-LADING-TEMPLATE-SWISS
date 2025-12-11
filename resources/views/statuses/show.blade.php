@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Status Details</h1>
            <a href="{{ route('statuses.index') }}" class="text-blue-600 hover:underline">Back to list</a>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <p class="mb-2"><strong>ID:</strong> {{ $status->id }}</p>
            <p class="mb-2"><strong>Name:</strong> {{ $status->name }}</p>
            <p class="mb-2"><strong>Order:</strong> {{ $status->order }}</p>
            <p class="mb-2"><strong>Type:</strong> {{ $status->type?->name }}</p>
        </div>
    </div>
@endsection
