@extends('dashboard.layout')

@section('dashboard_content')
<div class="table-responsive">
    <div class="all-products-header">
        <h1>Gestion des produits</h1>
        <a href="{{ route('dashboard.products.create') }}" class="add">Add product</a>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif


    <div class="table-responsive">
    <table class="products-table" border="1">
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Description</th>
            <th>Category</th>
            <th>Option</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>
                @if($product->image)
                    <img src="{{ asset('images/' . $product->image) }}" width="50" />
                @endif
            </td>
            <td>{{ $product->price }}</td>
            <td> 
                <span class="short-desc" title="{{ $product->description }}">
                {{ Str::words($product->description, 5, '...') }}
                </span>
            </td>
            <td>{{ $product->category->name ?? '' }}</td>
            <td>
                <a href="{{ route('dashboard.products.edit', $product->id) }}" class='button-option-edit'><i class="icon-pencil" style="font-size:18px; color:#007bff; cursor:pointer;"></i></a>
                <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST" style="display:inline;">
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
