<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product Dependencies
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="mb-4 text-green-600 font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                @if($dependencies->isEmpty())
                    <p>No dependencies found.</p>
                    <a href="{{ route('dependencies.create') }}" class="text-blue-600 hover:underline" style="color: green;">Add Dependency</a>
                @else
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('dependencies.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600" style="color: green;">Add Dependency</a>
                    </div>

                    <table class="table-auto w-full border">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Product</th>
                                <th class="border px-4 py-2">Depends On</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dependencies as $dependency)
                                <tr>
                                    <td class="border px-4 py-2">{{ $dependency->product->name ?? 'Unknown' }}</td>
                                    <td class="border px-4 py-2">{{ $dependency->dependency->name ?? 'Unknown' }}</td>
                                    <td class="border px-4 py-2 text-center space-x-2">
                                        <a href="{{ route('dependencies.edit', $dependency->id) }}" class="text-blue-600 hover:text-blue-800 font-bold text-lg">Edit</a>

                                        <form action="{{ route('dependencies.destroy', $dependency->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this dependency?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Delete" class="text-red-600 hover:text-red-800 font-bold text-lg">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
