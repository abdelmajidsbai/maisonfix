@extends('dashboard.layout')

@section('dashboard_content')

<div class='donees-stat'>
        <h2>Statistique globale</h2>
        <div class='all-stat'>
          <div class='orders-total'>
            <h4>totale des orders</h4>
            <span>{{$totalorders}}</span>
          </div>
          <div class='services-total'>
            <h4>totale des services</h4>
            <span>{{$totalservices}}</span>
          </div>
          <div class='client-total'>
            <h4>Totale des visiteur</h4>
            <span>{{$total}}</span>
          </div>
        </div>
      </div>

      <div class='orders-stat'>
        <h2>Orders Statiques</h2>
          <canvas id="ordersChart" class="orders-diagrame" width="400" height="200"></canvas>
      </div>

      <div class='services-stat'>
        <h2>services Statiques</h2>
        <canvas id="servicesChart" class="orders-diagrame" width="400" height="200"></canvas>
      </div>

      <div class='clients-stat'>
        <h2>Statistiques des visiteurs</h2>
        <canvas id="visiteursChart" class="orders-diagrame" width="400" height="200"></canvas>
      </div>






      
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx_o = document.getElementById('ordersChart').getContext('2d');
    const ordersChart = new Chart(ctx_o, {
        type: 'bar', 
        data: {
            labels: @json($labels_o),   
            datasets: [{
                label: 'Total Orders',
                data: @json($totals_o),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });

    const ctx_s = document.getElementById('servicesChart').getContext('2d');
    const servicesChart = new Chart(ctx_s, {
        type: 'bar',  
        data: {
            labels: @json($labels_s),   
            datasets: [{
                label: 'Total services',
                data: @json($totals_s),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });

    const ctx_v = document.getElementById('visiteursChart').getContext('2d');
    const visiteursChart = new Chart(ctx_v, {
        type: 'bar',  
        data: {
            labels: @json($labels_v),   
            datasets: [{
                label: 'Total visiteurs',
                data: @json($totals_v),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>

@endsection

