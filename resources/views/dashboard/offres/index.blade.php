@extends('dashboard.layout')

@section('dashboard_content')
<div class="table-responsive">
    <div class="all-offres-header">
        <h1>Gestion des offres</h1>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <table class="offres-table" border="1">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Option</th>
        </tr>
        @foreach($offres as $offre)
        <tr>
            <td>{{ $offre->title }}</td>
            <td class="description-col">{{ $offre->description }}</td>
            <td class="img-col">
                @if($offre->image)
                    <img src="{{ asset('images/' . $offre->image) }}"  />
                @endif
            </td>
            <td class="option-col">
                <a href="{{ route('dashboard.offres.edit', $offre->id) }}" class='button-option-edit' ><i class="icon-pencil" style="font-size:18px; color:#007bff; cursor:pointer;"></i></a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
