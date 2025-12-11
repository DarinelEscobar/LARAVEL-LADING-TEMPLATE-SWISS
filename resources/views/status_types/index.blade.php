@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Status Types</h1>
            <a href="{{ route('status-types.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Status Type
            </a>
        </div>

        <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
            <table class="min-w-full w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse($statusTypes as $statusType)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <span class="font-medium">{{ $statusType->id }}</span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span>{{ $statusType->name }}</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('status-types.show', $statusType) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('status-types.edit', $statusType) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('status-types.destroy', $statusType) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
                            <td colspan="3" class="py-4 px-6 text-center text-gray-500">No status types found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
