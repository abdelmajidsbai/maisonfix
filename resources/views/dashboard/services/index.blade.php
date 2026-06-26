@extends('dashboard.layout')

@section('dashboard_content')
<div >
    <div class="all-services-header">
        <h1>Gestion des services</h1>
        <a href="{{ route('dashboard.services.create') }}" class="add">Add service</a>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

 <div class="table-responsive">
    <table class="services-table" border="1">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>detailes</th>
            <th>Image</th>
            <th>Option</th>
        </tr>
        @foreach($services as $service)
        <tr>
            <td>{{ $service->name }}</td>
            <td>
                <span class="short-desc" title="{{$service->description }}">
                {{ Str::words($service->description, 5, '...') }}
                </span>
            </td>
            <td>
                <span class="short-desc" title="{{$service->details }}">
                {{ Str::words($service->details, 5, '...') }}
                </span>
            </td>
            <td>
                @if($service->image)
                    <img src="{{ asset('images/' . $service->image) }}" width="50" />
                @endif
            </td>
            <td>
                <a href="{{ route('dashboard.services.edit', $service->id) }}" class='button-option-edit'><i class="icon-pencil" style="font-size:18px; color:#007bff; cursor:pointer;"></i></a>
                <form action="{{ route('dashboard.services.destroy', $service->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class='button-option-del'><i class="icon-close" style="font-size:18px; color:red;"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    </div>
</div>
@endsection
