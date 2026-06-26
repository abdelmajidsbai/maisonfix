<div class="table-responsive">
<table border="1" class="orders-table">
    <tr>
        <th>Customer</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Products</th>
        <th>Total</th>
        <th>Date</th>
        <th>Status</th>
        <th>Option</th>
    </tr>
    @foreach($orders as $order)
    <tr>
        <td>{{ $order->customer_name }}</td>
        <td>{{ $order->customer_phone }}</td>
        <td>{{ $order->customer_address }}</td>
        <td>
            @foreach($order->products as $product)
                {{ $product->name }} ({{ $product->pivot->quantity }})<br>
            @endforeach
        </td>
        <td>
            {{ $order->products->sum(fn($p)=> $p->pivot->price * $p->pivot->quantity) }} MAD
        </td>
        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
        <td>{{ ucfirst($order->status) }}</td>
        
        <td class='option-td'>
            @if($order->status == 'pending')
            <form action="{{ route('dashboard.orders.validate', $order->id) }}" method="POST" >
                @csrf
                <button type="submit" class='btn-validate'>Validate</button>
            </form>
            @endif
            <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="POST" >
                @csrf
                @method('DELETE')
                <button type="submit"  class='btn-delete' onclick="return confirm('Delete order?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
</div>