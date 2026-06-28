<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="container-fluid">
                <!-- Stat Cards Row -->
                <div class="row">
                    <!-- Permohonan Masuk -->
                    <div class="col-md-3">
                        <div class="stat-card border-amber position-relative" style="min-height: 110px;">
                            <div class="stat-label">Permohonan Masuk</div>
                            <div class="stat-value"><?= $total_peminjaman_hariini; ?></div>
                            <div style="color: #94a3b8; font-size: 0.8rem;">Peminjaman Hari Ini</div>
                            <?php if ($total_pending > 0) { ?>
                            <a href="listpeminjaman" class="position-absolute badge rounded-pill bg-danger" style="top: 12px; right: 12px; font-family: 'JetBrains Mono', monospace;">
                                <?= $total_pending; ?>
                            </a>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Total Users -->
                    <div class="col-md-3">
                        <div class="stat-card border-purple" style="min-height: 110px;">
                            <div class="stat-label">Total Users</div>
                            <div class="stat-value"><?= $total_users; ?></div>
                            <div style="color: #94a3b8; font-size: 0.8rem;">Akun Terdaftar</div>
                        </div>
                    </div>

                    <!-- Total Aset -->
                    <div class="col-md-3">
                        <div class="stat-card border-red" style="min-height: 110px;">
                            <div class="stat-label">Total Aset</div>
                            <div class="stat-value"><?= $total_aset; ?></div>
                            <div style="color: #94a3b8; font-size: 0.8rem;">Aset Terdata</div>
                        </div>
                    </div>

                    <!-- Total Peminjaman -->
                    <div class="col-md-3">
                        <div class="stat-card border-accent" style="min-height: 110px;">
                            <div class="stat-label">Total Peminjaman</div>
                            <div class="stat-value"><?= $total_peminjaman; ?></div>
                            <div style="color: #94a3b8; font-size: 0.8rem;">Riwayat Transaksi</div>
                        </div>
                    </div>
                </div>

                <p></p>

                <!-- Tables Row -->
                <div class="row">
                    <!-- Aset yang sering dipinjam -->
                    <div class="col-md-6">
                        <div class="ibox shadow">
                            <div class="ibox-title">
                                <h5 class="font-mono" style="margin: 0; color: #e2e8f0;"><i class="fa fa-cube text-cyan"></i> Aset yang Sering Dipinjam</h5>
                            </div>
                            <div class="ibox-content">
                                <table class="table table-striped table-bordered table-hover" style="margin-bottom: 0;">
                                    <thead>
                                        <tr>
                                            <th>Aset</th>
                                            <th class="font-mono">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($top_aset as $aset) : ?>
                                            <tr>
                                                <td><?= $aset['nama']; ?></td>
                                                <td class="font-mono" style="color: #00d4ff;"><?= $aset['total']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Total Kondisi Aset -->
                    <div class="col-md-6">
                        <div class="ibox shadow">
                            <div class="ibox-title">
                                <h5 class="font-mono" style="margin: 0; color: #e2e8f0;"><i class="fa fa-heartbeat text-green"></i> Total Kondisi Aset</h5>
                            </div>
                            <div class="ibox-content">
                                <table class="table table-striped table-bordered table-hover" style="margin-bottom: 0;">
                                    <thead>
                                        <tr>
                                            <th>Kondisi</th>
                                            <th class="font-mono">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php foreach ($kondisi_aset as $kondisi) : ?>
                                            <tr>
                                                <td><?= $kondisi['kondisi']; ?></td>
                                                <td class="font-mono" style="color: #00d4ff;"><?= $kondisi['total']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <p></p>

                <!-- Charts Row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="ibox shadow">
                            <div class="ibox-title">
                                <h5 class="font-mono" style="margin: 0; color: #e2e8f0;"><i class="fa fa-pie-chart text-cyan"></i> Distribusi Data</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <canvas id="asetChart" height="200"></canvas>
                                    </div>
                                    <div class="col-md-6">
                                        <canvas id="peminjamanChart" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="ibox shadow">
                            <div class="ibox-title">
                                <h5 class="font-mono" style="margin: 0; color: #e2e8f0;"><i class="fa fa-bar-chart text-purple"></i> Kondisi Aset</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <canvas id="kondisiAsetPieChart" height="200"></canvas>
                                    </div>
                                    <div class="col-md-6">
                                        <canvas id="kondisiAsetBarChart" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Dark theme chart defaults
                Chart.defaults.global.defaultFontColor = '#94a3b8';
                Chart.defaults.global.defaultFontFamily = "'JetBrains Mono', monospace";
                Chart.defaults.global.legend.labels.fontColor = '#94a3b8';

                // Color palette for dark theme
                var darkColors = ['#00d4ff', '#7c3aed', '#ffb700', '#00ff41', '#ff3333'];
                var darkColorsHover = ['#00b8e6', '#6d34d6', '#e6a400', '#00e639', '#e62e2e'];

                // Aset Distribution Pie Chart
                var ctxAset = document.getElementById('asetChart').getContext('2d');
                var asetChart = new Chart(ctxAset, {
                    type: 'pie',
                    data: {
                        labels: ['Total Users', 'Total Aset', 'Total Peminjaman'],
                        datasets: [{
                            data: [<?= $total_users ?>, <?= $total_aset ?>, <?= $total_peminjaman ?>],
                            backgroundColor: ['#00d4ff', '#7c3aed', '#ffb700'],
                            hoverBackgroundColor: ['#00b8e6', '#6d34d6', '#e6a400'],
                            borderColor: '#11161d',
                            borderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'bottom',
                            labels: { fontColor: '#94a3b8', fontSize: 10, padding: 12 }
                        }
                    }
                });

                // Peminjaman Bar Chart
                var ctxPeminjaman = document.getElementById('peminjamanChart').getContext('2d');
                var peminjamanChart = new Chart(ctxPeminjaman, {
                    type: 'bar',
                    data: {
                        labels: [<?php foreach ($top_aset as $aset) { echo "'".$aset['nama']."',"; } ?>],
                        datasets: [{
                            label: 'Total Peminjaman',
                            data: [<?php foreach ($top_aset as $aset) { echo $aset['total'].","; } ?>],
                            backgroundColor: '#00d4ff',
                            borderColor: '#00b8e6',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: { display: false },
                        scales: {
                            y: {
                                beginAtZero: true,
                                gridLines: { color: 'rgba(42, 48, 64, 0.5)' },
                                ticks: { fontColor: '#64748b', fontSize: 10 }
                            },
                            x: {
                                gridLines: { display: false },
                                ticks: { fontColor: '#64748b', fontSize: 9, maxRotation: 45 }
                            }
                        }
                    }
                });

                // Kondisi Aset data
                var kondisiLabels = [<?php foreach ($kondisi_aset as $kondisi) { echo "'".$kondisi['kondisi']."',"; } ?>];
                var kondisiData = [<?php foreach ($kondisi_aset as $kondisi) { echo $kondisi['total'].","; } ?>];

                // Pie Chart for Kondisi Aset
                var ctxPie = document.getElementById('kondisiAsetPieChart').getContext('2d');
                var kondisiAsetPieChart = new Chart(ctxPie, {
                    type: 'pie',
                    data: {
                        labels: kondisiLabels,
                        datasets: [{
                            data: kondisiData,
                            backgroundColor: ['#00d4ff', '#7c3aed', '#ffb700', '#00ff41', '#ff3333'],
                            hoverBackgroundColor: ['#00b8e6', '#6d34d6', '#e6a400', '#00e639', '#e62e2e'],
                            borderColor: '#11161d',
                            borderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'bottom',
                            labels: { fontColor: '#94a3b8', fontSize: 9, padding: 10 }
                        }
                    }
                });

                // Bar Chart for Kondisi Aset
                var ctxBar = document.getElementById('kondisiAsetBarChart').getContext('2d');
                var kondisiAsetBarChart = new Chart(ctxBar, {
                    type: 'bar',
                    data: {
                        labels: kondisiLabels,
                        datasets: [{
                            label: 'Jumlah Aset',
                            data: kondisiData,
                            backgroundColor: '#7c3aed',
                            borderColor: '#6d34d6',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: { display: false },
                        scales: {
                            y: {
                                beginAtZero: true,
                                gridLines: { color: 'rgba(42, 48, 64, 0.5)' },
                                ticks: { fontColor: '#64748b', fontSize: 10 }
                            },
                            x: {
                                gridLines: { display: false },
                                ticks: { fontColor: '#64748b', fontSize: 9, maxRotation: 45 }
                            }
                        }
                    }
                });
            </script>

        </div>
    </div>
</div>
</body>
</html>
