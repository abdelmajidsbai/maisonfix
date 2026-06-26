@extends('dashboard.layout')

@section('dashboard_content')
<h1>Pending Orders</h1>
<div class='form-orders'>
<form method="GET" action="{{ route('dashboard.orders.index') }}" class="filter-form">
  
    <label for="date">Filter by Date :</label>
    <div class='filter-div' >
      <input type="date" id="date" name="date" value="{{ request('date') }}">
      <button type="submit">Filter</button>
    </div>
    <div class='reset-div'>
      <a href="{{ route('dashboard.orders.index') }}" class="btn-reset">Reset</a>
    </div>
    
</form>
</div>

@include('dashboard.orders.orders_table', ['orders'=>$orders])
@endsection