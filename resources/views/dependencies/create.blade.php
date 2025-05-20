<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Dependency') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-lg font-bold mb-4">Create Product Dependency</h2>

            <form method="POST" action="{{ route('dependencies.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="product_id" class="block font-medium text-sm text-gray-700">Product</label>
                    <select name="product_id" id="product_id" class="form-select mt-1 block w-full" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="depends_on_id" class="block font-medium text-sm text-gray-700">Depends On</label>
                    <select name="depends_on_id" id="depends_on_id" class="form-select mt-1 block w-full" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none" style="color: green;">
                    Create Dependency
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
