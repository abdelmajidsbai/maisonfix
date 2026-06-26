@extends('dashboard.layout')

@section('dashboard_content')
<div class="table-responsive">
  <div class="all-categories-header">
    <h1>Gestion des catégories</h1>
    <a href="{{ route('dashboard.categories.create') }}"><button class="add">Ajouter catégorie</button></a>
  </div>

  <table class="categories-table">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Image</th>
        <th>Slug</th>
        <th>Option</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $cat)
      <tr>
        <td>{{ $cat->name }}</td>
        <td>
          @if($cat->image)
            <img src="{{ asset('images/'.$cat->image) }}" width="60">
          @endif
        </td>
        <td>{{ $cat->slug }}</td>
        <td>
          <a href="{{ route('dashboard.categories.edit', $cat->id) }}" class='button-option-edit'><i class="icon-pencil" style="font-size:18px; color:#007bff; cursor:pointer;"></i></a>
          <form action="{{ route('dashboard.categories.destroy', $cat->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class='button-option-del'><i class="icon-close" style="font-size:18px; color:red;"></i></button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
