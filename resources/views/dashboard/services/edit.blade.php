@extends('dashboard.layout')

@section('dashboard_content')
<h1>Edit Service</h1>

<form action="{{ route('dashboard.services.update', $service->id) }}" method="POST" class='form-formulaire' enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name', $service->name) }}">
    @error('name')<div>{{ $message }}</div>@enderror

    <label>Description:</label>
    <input type="text" name="description" value="{{ old('description', $service->description) }}">
    @error('description')<div>{{ $message }}</div>@enderror

    <label>Details :</label>
    <input type="text" name="details" value="{{ old('details', $service->details) }}">
    @error('details')<div>{{ $message }}</div>@enderror

    <label>Image:</label>
    <input type="file" name="image">
    @if($service->image)
        <img src="{{ asset('storage/' . $service->image) }}" width="50" />
    @endif
    @error('image')<div>{{ $message }}</div>@enderror

    <button type="submit" class="add">Update</button>
</form>
@endsection
