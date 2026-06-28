<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <!-- Form Pengecekan Ketersediaan -->
        <div class="ibox shadow">
            <div class="ibox-title">
                <h5>Pengecekan Ketersediaan Aset</h5>
            </div>
            <div class="ibox-content">
                <form action="<?= base_url('peminjaman/checkAvailabilitylist') ?>" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Aset</label>
                            <select name="id_aset" class="form-control chosen-select">
                                <?php foreach ($aset as $a): ?>
                                    <option value="<?= $a['id_aset'] ?>"><?= $a['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Tanggal Mulai</label>
                            <input type="text" name="tgl_mulai" required class="form-control datetimepicker" placeholder="Pilih tanggal mulai..." autocomplete="off">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Tanggal Selesai</label>
                            <input type="text" name="tgl_selesai" required class="form-control datetimepicker" placeholder="Pilih tanggal selesai..." autocomplete="off">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-outline">Cek Ketersediaan</button>
                </form>
            </div>
            <div>
                <!-- Tabel Hasil Pengecekan -->
                <?php if (isset($tersediapeminjaman)) { ?>
                    <?php if (isset($tersediapeminjaman) && !empty($tersediapeminjaman)) { ?>
                        <div class="ibox shadow">
                            <div class="ibox-title">
                                <h5>Hasil Pengecekan Ketersediaan</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables">
                                        <thead>
                                            <tr align="center">
                                                <th>#</th>
                                                <th>Nama Aset</th>
                                                <th>Foto</th>
                                                <th>Keterangan</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>CP Pengampu</th>
                                                <th><i class="fa fa-cogs"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($tersediapeminjaman as $items): ?>
                                                <tr align="center">
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $items['nama_aset'] ?></td>
                                                    <td>
                                                        <a onclick="viewAssetImage('<?= base_url('uploads/' . $items['foto']) ?>')">
                                                            <?php if($items['foto'] != null){ ?>
                                                                <img src="<?= base_url('uploads/' . $items['foto']); ?>" width="100">
                                                            <?php } ?>
                                                        </a>
                                                    </td>
                                                    <td><?= $items['ket'] ?></td>
                                                    <td><?= $items['tgl_mulai'] ?></td>
                                                    <td><?= $items['tgl_selesai'] ?></td>
                                                    <td><?= $items['cp_pengampu'] ?></td>
                                                    <td>
                                                        <button class="btn btn-success btn-outline" onclick="openAddDataModal('<?= $items['id_aset'] ?>', '<?= $items['tgl_mulai'] ?>', '<?= $items['tgl_selesai'] ?>')">Tersedia</button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="ibox shadow" >
                            <div class="ibox-title">
                                <h5>Hasil Pengecekan Ketersediaan</h5> : <b>Data Peminjaman Tidak Tersedia untuk Aset dan Tanggal yang anda cari</b>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            </div>
        </div>
      </div>

              

    <div class="row">
        <div class="col-lg-12">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <div class="ibox shadow">
                <div class="ibox-title">
                    <a class="btn btn-outline btn-primary shadow" href="" data-toggle="modal" data-target="#addData">Tambah Peminjaman</a>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables">
                            <thead>
                                <tr align="center">
                                    <th>#</th>
                                    <th>Nama Aset</th>
                                    <th>Nama Peminjam</th>
                                    <th>Instansi</th>
                                    <th>Acara</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($peminjaman as $item): ?>
                                    <tr align="center">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item['nama_aset'] ?></td>
                                        <td><?= $item['nama_peminjam'] ?></td>
                                        <td><?= $item['instansi'] ?></td>
                                        <td><?= $item['acara'] ?></td>
                                        <td><?= $item['tgl_mulai'] ?></td>
                                        <td><?= $item['tgl_selesai'] ?></td>
                                        <td><?= $item['ket'] ?></td>
                                        <td><?= $item['status'] ?></td>
                                        <td>
                                            <?php if ($item['status'] == 'pending'): ?>
                                            <div class="btn-group shadow">
                                                <button data-toggle="dropdown" class="btn btn-info btn btn-outline dropdown-toggle">Tindakan</button>
                                                <ul class="dropdown-menu shadow">
                                                    <li><a class="dropdown-item" href="#modalEdit<?= $item['id_peminjaman'] ?>" data-toggle="modal" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="<?= base_url('peminjaman/delete/') . $item['id_peminjaman']; ?>" onclick="return confirm('Yakin menghapus data <?= $item['acara']; ?>?');"><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Gambar Aset -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Foto Aset</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img id="assetImage" src="" alt="Gambar Aset" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Peminjaman -->
<div id="addData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Peminjaman Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('peminjaman/add') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Aset</label>
                        <div class="col-sm-9">
                            <select name="id_aset" class="form-control chosen-select">
                                <?php foreach ($aset as $a): ?>
                                    <option value="<?= $a['id_aset'] ?>"><?= $a['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Mulai</label>
                        <div class="col-sm-9">
                            <input type="text" name="tgl_mulai"  class="form-control datetimepicker" required placeholder="Pilih tanggal mulai..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Selesai</label>
                        <div class="col-sm-9">
                            <input type="text" name="tgl_selesai"  class="form-control datetimepicker" required placeholder="Pilih tanggal selesai..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Peminjam</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_peminjam" class="form-control" required placeholder="Masukkan nama peminjam..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Instansi</label>
                        <div class="col-sm-9">
                            <!-- <input type="text" name="instansi" class="form-control" placeholder="Masukkan instansi..." autocomplete="off"> -->
                            <input list="instansiList" id="instansi" name="instansi" required class="form-control shadow" placeholder="Instansi" autocomplete="off">
                            <datalist id="instansiList"></datalist>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Acara</label>
                        <div class="col-sm-9">
                            <input type="text" name="acara" class="form-control" required placeholder="Masukkan acara..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No. HP</label>
                        <div class="col-sm-9">
                            <input type="number" name="no_hp" class="form-control" required placeholder="Masukkan nomor HP..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea name="ket" class="form-control" placeholder="Masukkan keterangan..." rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" id="agree_terms" name="agree_terms">
                            Jika aset/ruang rapat digunakan mendadak oleh pimpinan, maka peminjam akan dikonfirmasi oleh admin untuk pembatalan
                          </label>
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-outline" id="addPeminjamanBtn">Tambah Peminjaman</button>
                    <button class="btn btn-secondary btn-outline" data-dismiss="modal" aria-hidden="true">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Peminjaman -->
<?php foreach ($peminjaman as $item) : ?>
<div id="modalEdit<?= $item['id_peminjaman']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h5 class="modal-title">Edit Peminjaman Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('peminjaman/edit/' . $item['id_peminjaman']) ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Aset</label>
                        <div class="col-sm-9">
                            <select name="id_aset" class="form-control chosen-select">
                                <?php foreach ($aset as $a): ?>
                                    <option value="<?= $a['id_aset'] ?>" <?= $item['id_aset'] == $a['id_aset'] ? 'selected' : '' ?>><?= $a['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Mulai</label>
                        <div class="col-sm-9">
                            <input type="text" name="tgl_mulai" required class="form-control datetimepicker" value="<?= $item['tgl_mulai'] ?>" placeholder="Pilih tanggal mulai..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Selesai</label>
                        <div class="col-sm-9">
                            <input type="text" name="tgl_selesai" required class="form-control datetimepicker" value="<?= $item['tgl_selesai'] ?>" placeholder="Pilih tanggal selesai..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Peminjam</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_peminjam" required class="form-control" value="<?= $item['nama_peminjam'] ?>" placeholder="Masukkan nama peminjam..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Instansi</label>
                        <div class="col-sm-9">
                            <input list="instansiList" id="instansi" name="instansi" required class="form-control shadow" placeholder="Instansi" autocomplete="off" value="<?= $item['instansi'] ?>">
                            <datalist id="instansiList"></datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Acara</label>
                        <div class="col-sm-9">
                            <input type="text" name="acara" class="form-control" required value="<?= $item['acara'] ?>" placeholder="Masukkan acara..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No. HP</label>
                        <div class="col-sm-9">
                            <input type="number" name="no_hp" class="form-control" required value="<?= $item['no_hp'] ?>" placeholder="Masukkan nomor HP..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea name="ket" class="form-control" placeholder="Masukkan keterangan..." rows="3"><?= $item['ket'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-outline">Update Peminjaman</button>
                    <button class="btn btn-secondary btn-outline" data-dismiss="modal" aria-hidden="true">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<script src="<?= base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.js'); ?>"></script>

<script>
    $(document).ready(function() {
        $('#instansi').on('input', function() {
            var keyword = $(this).val();

            if (keyword.length >= 3) {
                $.ajax({
                    url: '<?= base_url('auth/get_instansi'); ?>',
                    method: 'POST',
                    data: { keyword: keyword },
                    success: function(response) {
                        var data = JSON.parse(response);
                        var options = '';

                        if (data.length > 0) {
                            data.forEach(function(item) {
                                options += '<option value="' + item.instansi + '"></option>';
                            });
                        } else {
                            options = '<option value="Tidak ditemukan. Ketik manual..."></option>';
                        }

                        $('#instansiList').html(options);
                    }
                });
            }
        });
    });
    
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
    // Toggle submit button based on checkbox
    const agreeTerms = document.getElementById('agree_terms');
    const registerBtn = document.getElementById('registerBtn');
    addPeminjamanBtn.disabled = !this.checked;

    agreeTerms.addEventListener('change', function () {
        addPeminjamanBtn.disabled = !this.checked;
    });

    function openAddDataModal(idAset, tglMulai, tglSelesai) {
        // Buka modal tambah peminjaman
        $('#addData').modal('show');

        // Isi data di form modal
        $('select[name="id_aset"]').val(idAset);
        $('input[name="tgl_mulai"]').val(tglMulai);
        $('input[name="tgl_selesai"]').val(tglSelesai);
    }

    function viewAssetImage(imageUrl) {
        $('#assetImage').attr('src', imageUrl);
        $('#imageModal').modal('show');
    }
</script>


