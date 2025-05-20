<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products Overview') }}
        </h2>
    </x-slot>

    <!-- More top padding to push cards down -->
    <div class="pt-12 px-4 sm:px-6 lg:px-8">
        <!-- Increased gap for more space between cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($products as $product)
                <div class="bg-white shadow-md rounded-lg p-6 mt-6">
                    <h3 class="text-lg font-bold mb-2">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $product->description }}</p>

                    <p class="text-sm mb-1"><strong>Rate:</strong> {{ $product->amount_per_minute }}/min</p>
                    <p class="text-sm mb-1"><strong>Start:</strong> {{ $product->started_at }}</p>
                    <p class="text-sm mb-1"><strong>End:</strong> {{ $product->finished_at }}</p>
                    <p class="text-sm text-gray-500 mb-2">
                        <strong>Status:</strong> {{ $product->active ? '✅ Active' : '❌ Inactive' }}
                    </p>

                    @if($product->dependencies->count())
                        <p class="text-sm text-blue-600 mb-2">
                            Depends on: {{ $product->dependencies->pluck('name')->join(', ') }}
                        </p>
                    @endif

                    <div class="mt-4 flex gap-4">
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
