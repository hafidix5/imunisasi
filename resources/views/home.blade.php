@extends('adminlte::page')
@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Halo') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Selamat Datang di Aplikasi imunisasi') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pesan Terkirim</span>
                            <span class="info-box-number">{{ $pesan_terkirim[0]->jumlah }}</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-hand-holding-medical"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Imunisasi</span>
                            <span class="info-box-number">{{ $imunisasi[0]->jumlah }}</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Anak</span>
                            <span class="info-box-number">{{ $anak[0]->jumlah }}</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fa fa-user-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Ibu</span>
                            <span class="info-box-number">{{ $ibu[0]->jumlah }}</span>
                        </div>

                    </div>

                </div>

            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">


                        <div class="card card-primary">
                            <div class="card-header">
                                <h1 class="card-title">Imunisasi Berdasarkan Jenis</h1>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>

                        </div>




                    </div>

                    <div class="col-md-6">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Anak Berdasarkan Jenis Kelamin</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>

                        </div>
                        
                    </div>

                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Imunisasi per Bulan</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="speedChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>

                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Ketepatan Waktu Imunisasi</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="tepatChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>

                        </div>
                        
                    </div>

                </div>

            </div>
    </section>
    <script src="https://adminlte.io/themes/v3/plugins/chart.js/Chart.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js?v=3.2.0"></script>
    <script>
        $(function() {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */
            var speedCanvas = $('#speedChart').get(0).getContext('2d')
            
            var dataSecond = {
                label: "Jumlah Imunisasi",
                data: [
                    @foreach ($imunisasi_bulans as $imunisasi_bulan)
                        {{$imunisasi_bulan->jumlah}},
                    @endforeach
                ],
                lineTension: 0,
                fill: false,
                borderColor: 'blue'
            };

            var speedData = {
                labels: [ 
                @foreach ($imunisasi_bulans as $imunisasi_bulan)
                 @if($imunisasi_bulan->bulan=='01')
                 "Jan",
                 @elseif($imunisasi_bulan->bulan=='02')
                 "Feb",
                 @elseif($imunisasi_bulan->bulan=='03')
                 "Mar",
                 @elseif($imunisasi_bulan->bulan=='04')
                 "Apr",
                 @elseif($imunisasi_bulan->bulan=='05')
                 "Mei",
                 @elseif($imunisasi_bulan->bulan=='06')
                 "Jun",
                 @elseif($imunisasi_bulan->bulan=='07')
                 "Jul",
                 @elseif($imunisasi_bulan->bulan=='08')
                 "Agus",
                 @elseif($imunisasi_bulan->bulan=='09')
                 "Sept",
                 @elseif($imunisasi_bulan->bulan=='10')
                 "Okt",
                 @elseif($imunisasi_bulan->bulan=='11')
                 "Nov",
                 @elseif($imunisasi_bulan->bulan=='12')
                 "Des",
                 @endif   
                @endforeach
                    
                ],
                datasets: [dataSecond]
            };

            var chartOptions = {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 80,
                        fontColor: 'black'
                    }
                }
            };


            var lineChart = new Chart(speedCanvas, {
                type: 'line',
                data: speedData,
                options: chartOptions
            });



            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    @foreach ($jenisimuns as $jenisimun)
                        "{{ $jenisimun->nama }}",
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach ($jenisimuns as $jenisimun)
                            {{ $jenisimun->jumlah }},
                        @endforeach
                    ],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de',
                        '#C1D5A4', '#B270A2', '#CA955C', '#CCD6A6'
                    ],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

             //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#tepatChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    @foreach ($tepat_waktus as $tepat_waktu)
                        "{{ $tepat_waktu->status }}",
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach ($tepat_waktus as $tepat_waktu)
                            {{ $tepat_waktu->jumlah }},
                        @endforeach
                    ],
                    backgroundColor: ['#7FB77E', '#FFC090'
                    ],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = {
                labels: [
                    "Laki-Laki", "Perempuan"
                ],
                datasets: [{
                    data: [
                        @foreach ($anaks as $anak)
                            {{ $anak->jumlah }},
                        @endforeach
                    ],
                    backgroundColor: ['#D2001A', '#277BC0'],
                }]
            }
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })




        })
    </script>
@endsection
