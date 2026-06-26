@extends('dashboard.layout')

@section('dashboard_content')
<h1>Demandes de services non validées</h1>
@include('dashboard.service_orders.services_orders_table', ['services' => $services])
@endsection