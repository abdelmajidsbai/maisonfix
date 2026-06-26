@extends('dashboard.layout')

@section('dashboard_content')
<h1>ervices validées</h1>
@include('dashboard.service_orders.services_orders_table', ['services' =>$services])
@endsection