@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Statuses</h1>
            <a href="{{ route('statuses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Status
            </a>
        </div>

        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
            <table class="min-w-full w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Order</th>
                        <th class="py-3 px-6 text-left">Type</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse($statuses as $status)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <span class="font-medium">{{ $status->id }}</span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span>{{ $status->name }}</span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span>{{ $status->order }}</span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span>{{ $status->type?->name }}</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('statuses.show', $status) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('statuses.edit', $status) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('statuses.destroy', $status) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-4 transform hover:text-red-500 hover:scale-110">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 px-6 text-center text-gray-500">No statuses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
