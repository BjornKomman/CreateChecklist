@extends('layouts.app')

@section('content')
    <h2>Create Product Dependency</h2>

    <form method="POST" action="{{ route('dependencies.store') }}">
        @csrf

        <div class="mb-3">
            <label for="product_id">Product</label>
            <select name="product_id" id="product_id" class="form-control" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="depends_on_id">Depends On</label>
            <select name="depends_on_id" id="depends_on_id" class="form-control" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Dependency</button>
    </form>
@endsection
