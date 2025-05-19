<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product Dependencies
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($dependencies->isEmpty())
                    <p>No dependencies found.</p>
                    <a href="{{ route('dependencies.create') }}" class="text-blue-600 hover:underline" style="color: green;">Add Dependency</a>
                @else
                    <table class="table-auto w-full border">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Product</th>
                                <th class="border px-4 py-2">Depends On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dependencies as $dependency)
                                <tr>
                                    <td class="border px-4 py-2">{{ $dependency->product->name ?? 'Unknown' }}</td>
                                    <td class="border px-4 py-2">{{ $dependency->dependency->name ?? 'Unknown' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
