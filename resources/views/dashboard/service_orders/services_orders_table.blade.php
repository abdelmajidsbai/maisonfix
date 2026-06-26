<div class="table-responsive">
<table border="1" style="width:100%; border-collapse:collapse;"  class="services-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Service</th>
            <th>Client</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
         @forelse($services as $serviceOr)
            <tr>
                <td>{{ $serviceOr->id }}</td>
                <td>{{ $serviceOr->service->name }}</td>
                <td>{{ $serviceOr->customer_name }}</td>
                <td>{{ $serviceOr->customer_phone }}</td>
                <td>{{ $serviceOr->customer_address }}</td>
                <td>{{ $serviceOr->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $serviceOr->status }}</td>
                <td class='option-td'>
                    @if($serviceOr->status !== 'validated')
                    <form action="{{ route('dashboard.service_orders.validate', $serviceOr->id) }}" method="POST" >
                        @csrf
                        <button type="submit" class="btn-validate">Valider</button>
                    </form>
                    @endif
                    <form action="{{ route('dashboard.service_orders.destroy', $serviceOr->id) }}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Delete service?')">Delete</button>
                    </form>
                </td>
            </tr>
         @empty
            <tr>
                <td colspan="7">Aucune demande</td>
            </tr>
         @endforelse
    </tbody>
</table>
</div>
