<section class="content">

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Proses izin berjalan</h3>
                    <div class="box-tools pull-right">
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">
                    <canvas id="barVerifikasi" width="400" height="200"></canvas>
                    <br>
                    <table class="table">
                        <tr>
                            <td> Upload Dokumen.</td>
                            <td><span class="label label-danger">{{ $countUploadDoc }}</span> </td>
                        </tr>
                        <tr>
                            <td> Verifikasi Dokumen.</td>
                            <td><span class="label label-info">{{ $countVerifikasiDoc }}</span></td>
                        </tr>
                        <tr>
                            <td> Verifikasi Teknis.</td>
                            <td><span class="label label-warning">{{ $countDocDiterima }}</span></td>
                        </tr>
                        <tr>
                            <td> Aproval Pimpinan.</td>
                            <td><span class="label label-success">{{ $countIzinTerbit }}</span></td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Penerbitan Izin</h3>
                    <div class="box-tools pull-right">
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">
                    <canvas id="barTerbit" width="400" height="200"></canvas>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-solid box-primary">
                
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">
                    <table class="table " style="font-size: 12pt !important">

                        <tbody>
                            <tr>
                                <td>Total Pengguna</td>
                                <td><span class="label label-default">{{ $countUser }}</span></td>
                            </tr>
                            <tr>
                                <td>Jumlah Layanan</td>
                                <td><span class="label label-default">{{ $countService }}</span></td>
                            </tr>
                            <tr>
                                <td>Total Izin Terbit</td>
                                <td><span class="label label-success">{{ $countIzinTerbit }}</span></td>
                            </tr>

                        

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
       

    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Status Verifikasi Berkas</h3>
                    <div class="box-tools pull-right">
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">
                    <canvas id="donatStatusDoc" width="400" height="200"></canvas>
                    <br>
                    <table class="table">
                        <tr>
                            <td> Dokumen Ditolak.</td>
                            <td><span class="label label-danger">{{ $countDocDitolak }}</span> </td>
                        </tr>
                        <tr>
                            <td> Dokumen DIterima</td>
                            <td><span class="label label-info">{{ $countDocDiterima }}</span></td>
                        </tr>
                        <tr>
                            <td> Menunggu Verifikasi.</td>
                            <td><span class="label label-warning">{{ $countVerifikasiDoc }}</span></td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Status Verikasi Tim Teknis</h3>
                    <div class="box-tools pull-right">
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">
                    <canvas id="donatStatusTeknis" width="400" height="200"></canvas>
                    <br>
                    <table class="table">
                        <tr>
                            <td> Ditolak.</td>
                            <td><span class="label label-danger">{{ $countTeknisDitolak }}</span> </td>
                        </tr>
                        <tr>
                            <td> Panggilan Konsultasi.</td>
                            <td><span class="label label-warning">{{ $countTeknisKonsultasi }}</span> </td>
                        </tr>
                        <tr>
                            <td> DIterima</td>
                            <td><span class="label label-info">{{ $countTeknisDiterima }}</span></td>
                        </tr>
                        <tr>
                            <td> Menunggu Verifikasi Teknis.</td>
                            <td><span class="label label-default">{{ $countVerifikasiTeknis }}</span></td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

       

        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Approval Pimpinan</h3>
                    <div class="box-tools pull-right">
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">
                    <canvas id="donatApproval" width="400" height="200"></canvas>
                    <br>
                    <table class="table">
                        <tr>
                            <td> Kepala Seksi.</td>
                            <td><span class="label label-danger">{{ $countKasi }}</span> </td>
                        </tr>
                        <tr>
                            <td> Kepala Bidang</td>
                            <td><span class="label label-warning">{{ $countKabid }}</span> </td>
                        </tr>
                        <tr>
                            <td> Sekretaris</td>
                            <td><span class="label label-warning">{{ $countSekretaris }}</span></td>
                        </tr>
                        <tr>
                            <td> Kepala Dinas.</td>
                            <td><span class="label label-success">{{ $countKadis }}</span></td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>



<script>
    $(function() {
        var ctx = document.getElementById("barVerifikasi").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Upload Dokumen", "Verifikasi Dokumen", "Verifikasi Teknis", "Approval Pimpinan"],
                datasets: [{
                    label: '# Daftar Tunggu',
                    data: [{{ $countUploadDoc }}, {{ $countVerifikasiDoc }},
                        {{ $countVerifikasiTeknis }}, {{ $countVerifikasiSignature }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',

                    ],
                    borderColor: [
                        'rgba(255,99,132,0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctx = document.getElementById("donatStatusDoc").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Dokumen Ditolak", "Dokumen Diterima", "Menunggu Verifikasi"],
                datasets: [{
                    label: '# Status Verifikasi Dokumen',
                    data: [{{ $countDocDitolak }}, {{ $countDocDiterima }},
                        {{ $countVerifikasiDoc }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',


                    ],
                    borderColor: [
                        'rgba(255,99,132,0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',


                    ],
                    borderWidth: 1
                }]
            },

        });

        var ctx = document.getElementById("donatStatusTeknis").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [" Ditolak", "Diterima", "Konsultasi",
                    "Menunggu Verifikasi"
                ],
                datasets: [{
                    label: '# Status Verifikasi Teknis',
                    data: [{{ $countTeknisDitolak }}, {{ $countTeknisDiterima }}, {{ $countTeknisKonsultasi }},
                        {{ $countVerifikasiTeknis }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        


                    ],
                    
                    borderWidth: 1
                }]
            },

        });

        var ctx = document.getElementById("donatApproval").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    "Kepala Seksi", 
                    "Kepala Bidang",
                    "Sekretaris",
                    "Kepala Dinas",
                   
                ],
                datasets: [{
                    label: '# Approval Pimpinan',
                    data: [{{ $countKasi }}, {{ $countKabid }}, {{ $countSekretaris }}, {{ $countKadis }}, ],
                    backgroundColor: [
                        'rgba(255, 51, 51, 0.8)',
                        'rgba(255, 153, 51, 0.8)',
                        'rgba(255, 255, 51, 0.8)',
                        'rgba(153, 255, 51, 0.8)',
                        


                    ],
                    
                    borderWidth: 1
                }]
            },

        });

        var ctx = document.getElementById("barTerbit").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
                datasets: [{
                    label: '# Penerbitan Izin',
                    data: [
                        0
                    ],
                    backgroundColor: [
                        
                        'rgba(54, 162, 235, 0.2)',
                        

                    ],
                    borderColor: [
                        
                        'rgba(54, 162, 235, 0.8)',
                        

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>
