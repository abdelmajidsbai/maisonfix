@extends('dashboard.layout')

@section('dashboard_content')
<h1>Edit Category</h1>

<form action="{{ route('dashboard.categories.update', $category->id) }}"  method="POST" class='form-formulaire' enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name', $category->name) }}">
    @error('name')<div>{{ $message }}</div>@enderror

    <label>Slug:</label>
    <input type="text" name="slug" value="{{ old('slug', $category->slug) }}">
    @error('slug')<div>{{ $message }}</div>@enderror

    <label>Image:</label>
    <input type="file" name="image">
    @if($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" width="50" />
    @endif
    @error('image')<div>{{ $message }}</div>@enderror

    <button type="submit" class="add">Update</button>
</form>
@endsection
