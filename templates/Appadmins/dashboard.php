<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Campaign Dashboard</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .content-wrapper {
            padding: 20px;
        }
        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .chart-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="content-wrapper">
    <!-- Header Section -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">School Campaign Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Metrics Row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Students</h5>
                            <h2 class="text-primary"><i class="fas fa-user-graduate"></i> 1,240</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Teachers</h5>
                            <h2 class="text-success"><i class="fas fa-chalkboard-teacher"></i> 145</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Ongoing Campaigns</h5>
                            <h2 class="text-warning"><i class="fas fa-bullhorn"></i> 12</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Completed Campaigns</h5>
                            <h2 class="text-info"><i class="fas fa-check-circle"></i> 28</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="row chart-container">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">Participation Breakdown</div>
                        <div class="card-body">
                            <canvas id="participationChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">Campaign Growth</div>
                        <div class="card-body">
                            <canvas id="growthChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Table Section -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Recent Campaigns</div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="campaignTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Campaign Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Example PHP Dynamic Content -->
                                    <?php
                                    $campaigns = [
                                        ['name' => 'Clean the Campus', 'start' => '2024-01-10', 'end' => '2024-01-15', 'status' => 'Active'],
                                        ['name' => 'Tree Plantation', 'start' => '2023-12-20', 'end' => '2023-12-25', 'status' => 'Upcoming'],
                                        ['name' => 'Save Water Drive', 'start' => '2023-11-15', 'end' => '2023-11-20', 'status' => 'Completed']
                                    ];
                                    foreach ($campaigns as $index => $campaign) {
                                        echo "<tr>
                                                <td>" . ($index + 1) . "</td>
                                                <td>{$campaign['name']}</td>
                                                <td>{$campaign['start']}</td>
                                                <td>{$campaign['end']}</td>
                                                <td><span class='badge badge-" . 
                                                    ($campaign['status'] === 'Active' ? 'success' : 
                                                    ($campaign['status'] === 'Upcoming' ? 'warning' : 'danger')) . 
                                                    "'>{$campaign['status']}</span></td>
                                            </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function () {
        // Initialize DataTable
        $('#campaignTable').DataTable();

        // Initialize Charts
        var ctx1 = document.getElementById('participationChart').getContext('2d');
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Students', 'Teachers', 'Volunteers'],
                datasets: [{
                    data: [60, 25, 15],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107']
                }]
            }
        });

        var ctx2 = document.getElementById('growthChart').getContext('2d');
        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Campaign Growth',
                    data: [5, 15, 25, 35, 45, 60],
                    borderColor: '#007bff',
                    fill: false
                }]
            }
        });
    });
</script>
</body>
</html>
