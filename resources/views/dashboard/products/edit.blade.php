@extends('dashboard.layout')

@section('dashboard_content')
<h1>Edit Product</h1>

<form action="{{ route('dashboard.products.update', $product->id) }}" method="POST" class='form-formulaire' enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name', $product->name) }}">
    @error('name')<div>{{ $message }}</div>@enderror


    <label>Price:</label>
    <input type="text" name="price" value="{{ old('price', $product->price) }}">
    @error('price')<div>{{ $message }}</div>@enderror

    <label>Description:</label>
    <input type="text" name="description" value="{{ old('description', $product->description) }}">
    @error('description')<div>{{ $message }}</div>@enderror


    <label>Category:</label>
    <select name="category_id">
        <option value="">Select category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')<div>{{ $message }}</div>@enderror

    <label>Image:</label>
    <input type="file" name="image">
    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" width="50" />
    @endif
    @error('image')<div>{{ $message }}</div>@enderror

    <button type="submit" class="add">Update</button>
</form>
@endsection
