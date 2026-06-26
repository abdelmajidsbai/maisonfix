@extends('dashboard.layout')

@section('dashboard_content')
<h1>Create Category</h1>

<form action="{{ route('dashboard.categories.store') }}" method="POST" class='form-formulaire' enctype="multipart/form-data">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name') }}">
    @error('name')<div>{{ $message }}</div>@enderror

    <label>Slug:</label>
    <input type="text" name="slug" value="{{ old('slug') }}">
    @error('slug')<div>{{ $message }}</div>@enderror

    <label>Image:</label>
    <input type="file" name="image">
    @error('image')<div>{{ $message }}</div>@enderror

    <button type="submit" class="add">Create</button>
</form>
@endsection
