<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('products.update', $product) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input name="name" value="{{ $product->name }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $product->description }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Amount per Minute</label>
                <input name="amount_per_minute" value="{{ $product->amount_per_minute }}" type="number" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Start Date</label>
                <input name="started_at" type="datetime-local" value="{{ \Carbon\Carbon::parse($product->started_at)->format('Y-m-d\TH:i') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">End Date</label>
                <input name="finished_at" type="datetime-local" value="{{ \Carbon\Carbon::parse($product->finished_at)->format('Y-m-d\TH:i') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Active</label>
                <select name="active" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="1" {{ $product->active ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$product->active ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700" style="color: green;">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
