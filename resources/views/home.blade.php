@extends('layouts.master')

@section('content')
    <div class="main-content pt-4">
        <div class="row">
            <div class="col-md-10">
                <div class="breadcrumb">
                    <h1 class="mr-2">Dashboard</h1>
                    <!-- <ul>
                            <li><a href="{{ url('home') }}">Dashboard</a></li>
                            <li>Version 1</li>
                        </ul> -->
                </div>
            </div>
            <div class="col-md-2 sm:12 lg:2">
                <select class="form-control" id="filter">
                    <option value="daily">Today</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>
        </div>
        <div class="separator-breadcrumb border-top"></div>

        @include('partials.dashboard')
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let lineChart;

        function renderChart(labels, data) {
            const ctx = document.getElementById('earningLineChart').getContext('2d');
            if (lineChart instanceof Chart) {
                lineChart.destroy(); // Destroy old chart instance
            } // Destroy old chart
            lineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Revenue',
                        data: data,
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0,123,255,0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function loadDashboardData(filter) {
            $.ajax({
                url: "{{ route('dashboard.filter') }}",
                data: {
                    filter
                },
                success: function(response) {
                    $('.main-content .row.mb-4').html(response.view);
                    renderChart(response.chart.labels, response.chart.data);
                },
                error: function() {
                    alert('Failed to load dashboard data.');
                }
            });
        }

        $(document).ready(function() {
            $('#filter').on('change', function() {
                const filter = $(this).val();
                loadDashboardData(filter);
            });

            // Initial load
            loadDashboardData($('#filter').val());
        });
    </script>
@endsection
