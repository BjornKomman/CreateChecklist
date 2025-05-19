<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products Overview') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-lg font-bold mb-1">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-600 mb-1">{{ $product->description }}</p>

                    <p class="text-sm"><strong>Rate:</strong> {{ $product->amount_per_minute }}/min</p>
                    <p class="text-sm"><strong>Start:</strong> {{ $product->started_at }}</p>
                    <p class="text-sm"><strong>End:</strong> {{ $product->finished_at }}</p>
                    <p class="text-sm text-gray-500">
                        <strong>Status:</strong> {{ $product->active ? '✅ Active' : '❌ Inactive' }}
                    </p>

                    @if($product->dependencies->count())
                        <p class="text-sm text-blue-600">
                            Depends on: {{ $product->dependencies->pluck('name')->join(', ') }}
                        </p>
                    @endif

                    <div class="mt-3 flex gap-3">
                        <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:underline">Update</a>
                        <form method="POST" action="{{ route('products.destroy', $product) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
