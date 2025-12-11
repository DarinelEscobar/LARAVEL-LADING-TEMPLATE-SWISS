@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Create Status</h1>

        <form method="POST" action="{{ route('statuses.store') }}" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf
            <div>
                <label class="block font-semibold mb-1" for="name">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="order">Order</label>
                <input id="order" name="order" type="number" min="1" value="{{ old('order', 1) }}" class="w-full border rounded px-3 py-2" required>
                @error('order')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="status_type_id">Status Type</label>
                <select id="status_type_id" name="status_type_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select a type</option>
                    @foreach($statusTypes as $id => $name)
                        <option value="{{ $id }}" @selected(old('status_type_id') == $id)>{{ $name }}</option>
                    @endforeach
                </select>
                @error('status_type_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-2">
                <a href="{{ route('statuses.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">Cancel</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Save</button>
            </div>
        </form>
    </div>
@endsection
