@extends('layouts.main')

@section('content')
    <style>
        .chart {
            width: 100%;
            /* Membuat elemen chart selebar div card-body */
            height: 100%;
            /* Membuat chart (canvas) setinggi card-body */
            display: flex;
            /* Flexbox digunakan agar konten dalamnya bisa mengisi tinggi penuh */
            justify-content: center;
            align-items: center;
        }

        #myDonutChart {
            width: 100%;
            /* Lebar canvas mengikuti lebar induknya */
            height: 100%;
            /* Tinggi canvas mengikuti tinggi induknya */
        }

        .card-body {
            height: 68vh;
            /* Membuat card-body memiliki tinggi penuh dari viewport, sesuaikan dengan kebutuhan */
        }
    </style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="m-2"><i class="fas fa-chart-line"></i> <b>Simper</b>
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $simper_data }}</h3>
                                    <p>Total Submission</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-share-square"></i>
                                </div>
                                <a href="" class="small-box-footer">View Data <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>22</h3>
                                    <p>1 Months to Expired</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-week"></i>
                                </div>
                                <a href="" class="small-box-footer">View Data <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>22</h3>
                                    <p>2 Months to Expired</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-share-square"></i>
                                </div>
                                <a href="" class="small-box-footer">View Data <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <h1 class="m-2"><i class="fas fa-chart-line"></i> <b>Mine Permit</b>
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $minepermit_data }}</h3>
                                    <p>Total Submission</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-share-square"></i>
                                </div>
                                <a href="" class="small-box-footer">View Data <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>22</h3>
                                    <p>1 Months to Expired</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-week"></i>
                                </div>
                                <a href="" class="small-box-footer">View Data <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>22</h3>
                                    <p>2 Months to Expired</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-share-square"></i>
                                </div>
                                <a href="" class="small-box-footer">View Data <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <h1 class="m-2"><i class="fas fa-chart-line"></i> <b>Outstanding Process</b>
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>{{ $totaloutstanding }}</h3>
                                    <p>Total Outstanding</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-share-square"></i>
                                </div>
                                <a href="" class="small-box-footer">View Data <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $sheprosess }}</h3>
                                    <p>SHE Prosess</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-share-square"></i>
                                </div>
                                <a href="" class="small-box-footer">View Data <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $pjoprosess }}</h3>
                                    <p>PJO Prosess</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-share-square"></i>
                                </div>
                                <a href="" class="small-box-footer">View Data <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $becprosess }}</h3>
                                    <p>BEC Prosess</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-share-square"></i>
                                </div>
                                <a href="" class="small-box-footer">View Data <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $kttprosess }}</h3>
                                    <p>KTT Prosess</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-share-square"></i>
                                </div>
                                <a href="" class="small-box-footer">View Data <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="col-sm-12">
                        <h4 class="m-2"><i class="fas fa-chart-line"></i> <b>Total Mine Permit & Simper</b></h4>
                    </div><!-- /.col -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Donut Chart Simper & Mine Permit</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="myDonutChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Statistik Pengajuan SIMPER & Mine Permit</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="position: relative; height:300px;">
                                <canvas id="simperMinePermitChart"></canvas>
                            </div>

                            <!-- Filter tahunan (opsional) -->
                            {{-- <div class="mt-3">
                                <select id="yearFilter" class="form-control" style="width: 150px;">
                                    <option value="2025">2025</option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                </select>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.


        document.addEventListener('DOMContentLoaded', function() {
            // Referensi ke elemen filter tahun
            const yearFilter = document.getElementById('yearFilter');

            // Get context untuk chart
            var ctx = document.getElementById('simperMinePermitChart').getContext('2d');

            // Inisialisasi chart dengan data awal (kosong)
            var simperMinePermitChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        'January', 'February', 'March', 'April', 'May', 'June',
                        'July', 'August', 'September', 'October', 'November', 'December'
                    ],
                    datasets: [{
                            label: 'Pengajuan SIMPER',
                            data: [], // Kosong, akan diisi dari database
                            borderColor: '#3498db',
                            fill: false,
                            tension: 0.1
                        },
                        {
                            label: 'Pengajuan Mine Permit',
                            data: [], // Kosong, akan diisi dari database
                            borderColor: '#00a65a',
                            fill: false,
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Pengajuan'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                        },
                        tooltip: {
                            callbacks: {
                                title: function(tooltipItems) {
                                    return tooltipItems[0].label + ' ' + yearFilter.value;
                                }
                            }
                        }
                    }
                }
            });

            // Fungsi untuk mengambil data berdasarkan tahun yang dipilih
            function fetchDataByYear(year) {
                fetch(`/api/permit-requests?year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        // Perbarui data chart
                        simperMinePermitChart.data.datasets[0].data = data.simper;
                        simperMinePermitChart.data.datasets[1].data = data.minePermit;

                        // Update chart
                        simperMinePermitChart.update();
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }

            // Panggil untuk data tahun yang dipilih saat halaman dimuat
            fetchDataByYear(yearFilter.value);

            // Event listener untuk perubahan filter tahun
            yearFilter.addEventListener('change', function() {
                fetchDataByYear(this.value);
            });
        });

        // donat
        var donutChartCanvas = $('#myDonutChart').get(0).getContext('2d')
        var donutData = {
            labels: [
                'SIMPER',
                'Mine Permit',
            ],
            datasets: [{
                data: [{{ $simper }},
                    {{ $minepermit }}
                ], // Ganti dengan data SIMPER dan Mine Permit Anda
                backgroundColor: ['#3498db', '#00a65a'], // Warna untuk SIMPER dan Mine Permit
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        // Create doughnut chart
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    </script>
@endsection
