@extends('dashboard.layout')

@section('dashboard_content')
<h1>All Orders</h1>
<div class='form-orders'>
<form method="GET" action="{{ route('dashboard.orders.index') }}" class="filter-form">
  
    <label for="date">Filter by Date :</label>
    <div class='filter-div' >
      <input type="date" id="date" name="date" value="{{ request('date') }}">
      <select id="status" name="status">
          <option value="">All</option>
          <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="validated" {{ request('status') == 'validated' ? 'selected' : '' }}>Validated</option>
      </select>



      <button type="submit">Filter</button> 
    </div>
    <div class='reset-div'>
      <a href="{{ route('dashboard.orders.index') }}" class="btn-reset">Reset</a>
    </div>
    
</form>
</div>

@include('dashboard.orders.orders_table', ['orders'=>$orders])

<script>
  document.getElementById('filter-date').addEventListener('change', function() {
    const selectedDate = this.value; // format: "YYYY-MM-DD"
    const rows = document.querySelectorAll('.orders-table tbody tr');

    rows.forEach(row => {
        const dateCell = row.cells[5].textContent; // Date column
        const rowDate = new Date(dateCell).toISOString().split('T')[0];

        if (!selectedDate || rowDate === selectedDate) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
@endsection