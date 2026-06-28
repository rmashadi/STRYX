<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Informasi Agenda Ruang Rapat</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #337ab7;
        }
        .agenda-header {
            background-color: #2c7ebd;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .container-agenda {
            padding-top: 20px;
        }
        .btn-hide {
            background-color: orange;
            color: white;
        }
        #filter-form {
            display: block;
        }
        #showButton {
            font-size: 13px;
            display: none;
            position: fixed;
            top: 5px;
            right: 10px;
            background-color: #2c7ebd;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .tbHead {
            background-color: #275b89;
            color: white;
        }
    </style>
</head>
<body>

<!-- Navbar Section -->
<!-- <nav id="navbar" class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <form id="filter-form" class="form-inline" action="<?= base_url('agenda'); ?>" method="GET">
            <select id="ruangSelect" name="id_aset" class="form-control">
                <option value="">--Pilih Ruang--</option>
                <?php foreach ($ruangan as $r): ?>
                    <option value="<?= $r->id_aset; ?>" <?= ($selected_ruang == $r->id_aset) ? 'selected' : ''; ?>>
                        <?= $r->nama; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="text" id="datepicker" name="tanggal" class="form-control ml-2" placeholder="Pilih Tanggal" value="<?= $selected_tanggal ? $selected_tanggal : ''; ?>" autocomplete="off">
        </form>
        <button id="hideButton" class="btn btn-hide ml-auto">hide</button>
    </div>
</nav> -->

<!-- Tombol Show untuk Menampilkan Navbar -->
<!-- <button id="showButton">show</button> -->

<!-- Dashboard Title -->

<?php
function tanggal_indo($tanggal) {
    $hari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];

    $bulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    $tanggal_obj = strtotime($tanggal);
    $hari_indonesia = $hari[date('l', $tanggal_obj)];
    $tanggal_hari = date('d', $tanggal_obj);
    $bulan_indonesia = $bulan[(int)date('m', $tanggal_obj)];
    $tahun = date('Y', $tanggal_obj);

    return "$hari_indonesia, $tanggal_hari $bulan_indonesia $tahun";
}
?>


<div class="container mt-4">
    <h3 class="text-center"><strong>DASHBOARD INFORMASI AGENDA RUANG RAPAT</strong></h3>
    <h5 class="text-center">Daftar Agenda | <?= tanggal_indo(date('Y-m-d')); ?></h5>

</div>

<!-- Agenda Table -->
<div class="container">
    <table class="table table-bordered mt-4">
        <thead class="tbHead">
            <tr>
                <th>No</th>
                <th>Nama Ruang</th>
                <th>Instansi</th>
                <th>Acara</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($agenda)): ?>
                <?php $no = 1; foreach ($agenda as $a): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $a->nama_ruang; ?></td>
                    <td><?= $a->instansi; ?></td>
                    <td><?= $a->acara; ?></td>
                    <td><?= date('H:i', strtotime($a->tgl_mulai)); ?></td>
                    <td><?= date('H:i', strtotime($a->tgl_selesai)); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak ada agenda untuk filter yang dipilih</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Datepicker and Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize datepicker
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function() {
            // Enkode nilai filter saat tanggal berubah
            submitEncodedFilter();
        });

        // Submit form automatically when room is selected
        $('#ruangSelect').on('change', function() {
            // Enkode nilai filter saat ruang dipilih
            submitEncodedFilter();
        });

        function submitEncodedFilter() {
            var id_aset = $('#ruangSelect').val();
            var tanggal = $('#datepicker').val();
            
            // Encode values to Base64
            var encoded_id_aset = btoa(id_aset);
            var encoded_tanggal = btoa(tanggal);
            
            // Redirect to the same page with encoded parameters
            var url = "<?= base_url('agenda'); ?>?id_aset=" + encoded_id_aset + "&tanggal=" + encoded_tanggal;
            window.location.href = url;
        }

        // Hide navbar and show the "show" button
        $('#hideButton').on('click', function(e) {
            e.preventDefault();
            $('#navbar').hide();
            $('#showButton').show();
        });

        // Show navbar and hide the "show" button
        $('#showButton').on('click', function(e) {
            e.preventDefault();
            $('#navbar').show();
            $('#showButton').hide();
        });
    });
</script>


</body>
</html>
