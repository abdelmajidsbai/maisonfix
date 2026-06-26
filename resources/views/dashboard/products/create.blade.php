@extends('dashboard.layout')

@section('dashboard_content')
<h1>Create Product</h1>

<form action="{{ route('dashboard.products.store') }}" method="POST" class='form-formulaire' enctype="multipart/form-data">
    @csrf

    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name') }}">
    @error('name')<div>{{ $message }}</div>@enderror


    <label>Price:</label>
    <input type="text" name="price" value="{{ old('price') }}">
    @error('price')<div>{{ $message }}</div>@enderror

    <label>Description:</label>
    <input type="text" name="description" value="{{ old('description') }}">
    @error('description')<div>{{ $message }}</div>@enderror

    <label>Category:</label>
    <select name="category_id">
        <option value="">Select category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')<div>{{ $message }}</div>@enderror

    <label>Image:</label>
    <input type="file" name="image">
    @error('image')<div>{{ $message }}</div>@enderror

    <button type="submit" class="add">Create</button>
</form>
@endsection
