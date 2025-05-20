<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Dependency
        </h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto">
        <form method="POST" action="{{ route('dependencies.update', $dependency->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="product_id" class="block font-medium text-sm text-gray-700">Product</label>
                <select name="product_id" id="product_id" class="form-control w-full border rounded" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $dependency->product_id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_id') <p class="text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="depends_on_id" class="block font-medium text-sm text-gray-700">Depends On</label>
                <select name="depends_on_id" id="depends_on_id" class="form-control w-full border rounded" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $dependency->depends_on_id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                @error('depends_on_id') <p class="text-red-600">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" style="color: green;">
                Update Dependency
            </button>
        </form>
    </div>
</x-app-layout>
