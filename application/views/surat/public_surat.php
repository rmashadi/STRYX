<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Surat</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0a0e14;
            color: #e2e8f0;
        }
        .navbar-custom {
            background-color: #1a1f2b;
            border-bottom: 1px solid #2a3040;
        }
        .agenda-header {
            background-color: #1a1f2b;
            color: #00d4ff;
            padding: 10px;
            text-align: center;
            border-bottom: 2px solid #00d4ff;
        }
        .container-agenda {
            padding-top: 20px;
        }
        .btn-hide {
            background-color: #ffb700;
            color: #000;
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
            background-color: #00d4ff;
            color: #000;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .tbHead {
            background-color: #1a1f2b;
            color: #00d4ff;
        }
        .timeline-modern {
            position: relative;
            padding-left: 30px;
            margin-top: 10px;
        }
        .timeline-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 14px;
            width: 2px;
            height: 100%;
            background-color: #2a3040;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -1px;
            top: 5px;
            width: 10px;
            height: 10px;
            background-color: #00d4ff;
            border-radius: 50%;
            border: 2px solid #0a0e14;
            box-shadow: 0 0 0 2px #00d4ff;
        }
        .timeline-content {
            background: #11161d;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #2a3040;
            color: #e2e8f0;
        }
        .timeline-time {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 5px;
        }
        .table {
            color: #e2e8f0;
        }
        .table-bordered,
        .table-bordered td,
        .table-bordered th {
            border-color: #2a3040;
        }
        .form-control {
            background: #141923;
            color: #e2e8f0;
            border: 1px solid #2a3040;
        }
        .form-control:focus {
            border-color: #00d4ff;
            box-shadow: 0 0 0 2px rgba(0, 212, 255, 0.15);
        }
        .modal-content {
            background: #11161d;
            border: 1px solid #2a3040;
        }
        .modal-header {
            border-bottom: 1px solid #2a3040;
        }
        .modal-footer {
            border-top: 1px solid #2a3040;
        }
        .close {
            color: #94a3b8;
            text-shadow: none;
        }
        .btn-primary {
            background: #00d4ff;
            border-color: #00d4ff;
            color: #000;
        }
        .btn-info {
            background: #7c3aed;
            border-color: #7c3aed;
            color: #fff;
        }
        .text-center h3,
        .text-center h5 {
            color: #e2e8f0;
        }
    </style>
</head>
<body>


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
    <h3 class="text-center"><strong>DAFTAR INFORMASI SURAT SEKRETARIAT</strong></h3>
    <h5 class="text-center">Masukkan data pencarian :</h5>
    <br>
    <div class="container text-center">
        <!-- <form id="filter-form" action="<?= base_url('agenda'); ?>" method="GET"> -->
            <div class="row justify-content-center">
                <!-- Kolom 1: Dropdown Instansi -->
                <div class="col-md-3 mb-2">
                    <select id="kode_instansi" name="kode_instansi" class="form-control">
                        <option value="">--Pilih Instansi--</option>
                        <?php foreach ($listinstansi as $r): ?>
                            <option value="<?= $r->kode_instansi; ?>" <?= ($selected_ruang == $r->kode_instansi) ? 'selected' : ''; ?>>
                                <?= $r->instansi; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small id="instansi-error" class="text-danger d-none">Instansi harus dipilih</small>
                </div>

                <!-- Kolom 2: Tahun -->
                <div class="col-md-3 mb-2">
                    <input type="text" id="tahun" name="tahun" class="form-control" placeholder="Pilih Tahun" autocomplete="off">
                    <small id="tahun-error" class="text-danger d-none">Tahun harus diisi</small>
                </div>

                <!-- Kolom 2: Key -->
                <div class="col-md-3 mb-2">
                    <input type="text" id="key" name="key" class="form-control" placeholder="Masukkan Nomor Surat" autocomplete="off">
                    <small id="key-error" class="text-danger d-none">Nomor surat minimal 4 karakter</small>
                </div>

                <!-- Kolom 3: Tombol Submit -->
                <div class="col-md-3 mb-2">
                    <button id="Btnsubmit" class="btn btn-primary w-100">Cek Surat</button>
                </div>
            </div>
        <!-- </form> -->
    </div>
</div>

<!-- Surat Table -->
<div class="container">
    <table class="table table-bordered mt-4">
        <thead class="tbHead">
            <tr>
                <th width="4%">No</th>
                <th>No Surat</th>
                <th>Asal Surat</th>
                <th width="10%">Tgl. Surat</th>
                <th width="10%">Tgl. Terima</th>
                <th>Perihal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($surat)): ?>
                <?php 
                $no = 1; foreach ($surat as $a): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $a->sm_no_surat; ?></td>
                    <td><?= $a->sm_asal; ?></td>
                    <td><?= $a->sm_tgl_surat; ?></td>
                    <td><?= $a->sm_tgl_terima; ?></td>
                    <td><?= $a->sm_hal; ?></td>
                    <td>
                        <button class="btn btn-sm btn-info" 
                                onclick="fetchTimeline('<?= urlencode($a->sm_no_surat); ?>')" 
                                data-toggle="modal" 
                                data-target="#timelineModal">
                            Timeline
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak ada surat berdasarkan filter yang dipilih</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>


<!-- Modal Timeline -->
<div class="modal fade" id="timelineModal" tabindex="-1" role="dialog" aria-labelledby="timelineModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Timeline Perjalanan Surat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="timelineLoader" class="text-center my-3" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p>Loading timeline...</p>
        </div>

        <ul class="timeline-list list-group" id="timelineContent">
          <!-- Timeline items will be injected here -->
        </ul>
      </div>
    </div>
  </div>
</div>


<!-- Datepicker and Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


<script>
    $(document).ready(function() {
        $('#Btnsubmit').prop('disabled', true);
        // fungsi pengecekan
        function checkInputs() {
            let key = $('#key').val().trim();
            let instansi = $('#kode_instansi').val();
            let tahun = $('#tahun').val().trim();

            // Validasi & Notifikasi
            let isValid = true;

            if (key.length < 4) {
                $('#key-error').removeClass('d-none');
                isValid = false;
            } else {
                $('#key-error').addClass('d-none');
            }

            if (instansi === '') {
                $('#instansi-error').removeClass('d-none');
                isValid = false;
            } else {
                $('#instansi-error').addClass('d-none');
            }

            if (tahun === '') {
                $('#tahun-error').removeClass('d-none');
                isValid = false;
            } else {
                $('#tahun-error').addClass('d-none');
            }

            // Aktifkan / Nonaktifkan tombol
            $('#Btnsubmit').prop('disabled', !isValid);
        }

        // Cek input setiap kali berubah
            $('#key, #kode_instansi, #tahun').on('input change', checkInputs);

            // Saat tombol submit diklik
            $('#Btnsubmit').on('click', function(e) {
                e.preventDefault();
                // Eksekusi fungsi submit kalau semua valid
                if (!$(this).prop('disabled')) {
                    submitEncodedFilter(); // Fungsi kamu sendiri
                }
            });

        function submitEncodedFilter() {
            var kode_instansi = $('#kode_instansi').val();
            var tahun = $('#tahun').val();
            var key = $('#key').val();
            
            
            // Redirect to the same page with encoded parameters
            var url = "<?= base_url('surat'); ?>?kode_instansi=" + kode_instansi + "&tahun=" + tahun + "&key=" + key;
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


    //SCRIPT UNTUK TIMELINE
    function fetchTimeline(no_surat) {
    // Tampilkan loader dan kosongkan konten sebelumnya
        document.getElementById("timelineLoader").style.display = "block";
        document.getElementById("timelineContent").innerHTML = "";

        fetch("<?= base_url('surat/get_timeline'); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: "no_surat=" + encodeURIComponent(no_surat),
        })
        .then(response => response.json())
        .then(data => {
            loadTimeline(data);
        })
        .catch(error => {
            console.error("Error loading timeline:", error);
            document.getElementById("timelineContent").innerHTML =
                "<li class='list-group-item text-danger text-center'>Gagal memuat timeline</li>";
        })
        .finally(() => {
            // Sembunyikan loader setelah selesai
            document.getElementById("timelineLoader").style.display = "none";
        });
    }


    function loadTimeline(timeline) {
    const container = document.getElementById("timelineContent");
    console.log("Timeline data:", timeline); // Debug log
    container.innerHTML = "";

    if (!timeline || timeline.length === 0) {
        container.innerHTML = "<div class='text-center'>Tidak ada data timeline</div>";
        return;
    }

    container.className = "timeline-modern"; // Ganti semua class (hindari class yg sembunyikan)

    timeline.forEach((item, index) => {
        const waktu = item.waktu_dibaca || item.waktu_diterima || item.created_at || '-';
        const pendispo = item.nama_pendispo ? 
            `<small class="text-muted">Dari: ${item.nama_pendispo} - ${item.jabatan_pendispo}</small>` : '';

        const html = `
            <div class="timeline-item">
                <div class="timeline-content shadow-sm">
                    <div class="timeline-time">${waktu}</div>
                    <h6 class="mb-1"><strong>${item.sm_alur_keterangan}</strong></h6>
                    <p class="mb-1"><strong>Nama:</strong> ${item.nama}</p>
                    <p class="mb-1"><strong>Jabatan:</strong> ${item.jabatan}</p>
                    <p class="mb-1"><strong>Deskripsi:</strong> ${item.alur_level_deskripsi}</p>
                    <p class="mb-1"><strong>Keterangan:</strong> ${item.alur_keterangan}</p>
                    ${pendispo}
                </div>
            </div>
        `;
        container.innerHTML += html;
    });
}

</script>
</body>
</html>
