@extends('dashboard.layout')

@section('dashboard_content')
<h1>Create Service</h1>

<form action="{{ route('dashboard.services.store') }}" method="POST"  enctype="multipart/form-data">
    @csrf

    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name') }}">
    @error('name')<div>{{ $message }}</div>@enderror

    <label>Description:</label>
    <input type="text" name="description" value="{{ old('description') }}">
    @error('description')<div>{{ $message }}</div>@enderror

    <label>Details :</label>
    <input type="text" name="details" value="{{ old('details') }}">
    @error('details')<div>{{ $message }}</div>@enderror

    <label>Image:</label>
    <input type="file" name="image">
    @error('image')<div>{{ $message }}</div>@enderror

    <button type="submit" class="add">Create</button>
</form>
@endsection
