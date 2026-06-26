@extends('dashboard.layout')

@section('dashboard_content')
<h1>Edit Offre</h1>

<form action="{{ route('dashboard.offres.update', $offre->id) }}" method="POST" class='form-formulaire' enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Title :</label>
    <input type="text" name="title" value="{{ old('title', $offre->title) }}">
    @error('title')<div>{{ $message }}</div>@enderror

    <label>Description :</label>
    <input type="text" name="description" value="{{ old('description', $offre->description) }}">
    @error('description')<div>{{ $message }}</div>@enderror

    <label>Image :</label>
    <input type="file" name="image">
    @if($offre->image)
        <img src="{{ asset('storage/' . $offre->image) }}" width="50" />
    @endif
    @error('image')<div>{{ $message }}</div>@enderror

    <button type="submit" class="add">Update</button>
</form>
@endsection
