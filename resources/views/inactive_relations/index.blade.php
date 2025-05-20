<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inactive Relations') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($relations->isEmpty())
                <p>No inactive relations found.</p>
            @else
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Product</th>
                            <th class="border px-4 py-2">Missing Dependency</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($relations as $relation)
                            <tr>
                                <td class="border px-4 py-2">{{ $relation->product->name ?? 'Unknown' }}</td>
                                <td class="border px-4 py-2">{{ $relation->missingDependency->name ?? 'Unknown' }}</td>
                                <td class="border px-4 py-2 space-x-2">
                                    <form action="{{ route('inactive-relations.reactivate', $relation) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:underline" onclick="return confirm('Are you sure you want to reactivate this product?')">Reactivate</button>
                                    </form>

                                    <form action="{{ route('inactive-relations.force-delete', $relation) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this inactive relation?')">Delete</button>
                                    </form>

                                    <form action="{{ route('inactive-relations.set-inactive', $relation) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="text-yellow-600 hover:underline" onclick="return confirm('Set product inactive again?')">Set Inactive</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
