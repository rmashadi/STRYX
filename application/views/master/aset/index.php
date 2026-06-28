<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <?php echo validation_errors('<div class="alert alert-danger shadow" role="alert"><a class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>') ?>
            <?php if ($this->session->flashdata('add')) : ?>
                <div class="alert alert-success shadow" role="alert"><?= $this->session->flashdata('add'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('edit')) : ?>
                <div class="alert alert-warning shadow" role="alert"><?= $this->session->flashdata('edit'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('delete')) : ?>
                <div class="alert alert-danger shadow" role="alert"><?= $this->session->flashdata('delete'); ?></div>
            <?php endif; ?>
            <div class="ibox shadow">
                <div class="ibox-title"><a class="btn btn-outline btn-primary shadow" href="" data-toggle="modal" data-target="#addData">Tambah Data</a></div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th align="center">Kode Aset</th>
                                    <th>Nama Aset</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
                                    <th>Foto</th>
                                    <th>Kapasitas</th>
                                    <th>CP Pengampu</th>
                                    <th>Keterangan</th>
                                    <th>Lokasi Penyimpanan</th>
                                    <th align="center"><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($aset as $tampil) : $no++ ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td align="center"><?= $tampil['kd_aset']; ?></td>
                                        <td><?= $tampil['nama']; ?></td>
                                        <td><?= $tampil['deskripsi']; ?></td>
                                        <td><?= $tampil['kategori']; ?></td>
                                        <!-- <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#fotoModal<?= $tampil['id_aset']; ?>">
                                                Lihat Foto
                                            </button>
                                        </td> -->
                                        <td>
                                            <a onclick="viewAssetImage('<?= base_url('uploads/' . $tampil['foto']) ?>')">
                                                <?php if($tampil['foto'] != null){ ?>
                                                    <img src="<?= base_url('uploads/' . $tampil['foto']); ?>" width="100">
                                                <?php } ?>
                                            </a>
                                        </td>
                                        <td><?= $tampil['kapasitas']; ?></td>
                                        <td><?= $tampil['cp_pengampu']; ?></td>
                                        <td><?= $tampil['ket']; ?></td>
                                        <td><?= $tampil['lokasi']; ?></td>
                                        <td align="center">
                                            <div class="btn-group shadow">
                                                <button data-toggle="dropdown" class="btn btn-info btn-outline dropdown-toggle">Tindakan</button>
                                                <ul class="dropdown-menu shadow">
                                                    <li><a class="dropdown-item" href="#modalEdit<?= $tampil['id_aset'] ?>" data-toggle="modal" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="<?= base_url('aset/delete/') . $tampil['id_aset']; ?>" onclick="return confirm('Yakin menghapus data <?= $tampil['nama']; ?>?');"><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
                                                </ul>
                                            </div>
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

<?php foreach ($aset as $tampil) : ?>
    <!-- Modal -->
    <div class="modal fade" id="fotoModal<?= $tampil['id_aset']; ?>" tabindex="-1" role="dialog" aria-labelledby="fotoModalLabel<?= $tampil['id_aset']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fotoModalLabel<?= $tampil['id_aset']; ?>">Foto Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="<?= base_url('uploads/' . $tampil['foto']); ?>" class="img-fluid" alt="Foto Aset">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Tambah Data -->
<div id="addData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('aset') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kode Aset</label>
                        <div class="col-sm-9">
                            <input type="text" name="kd_aset" class="form-control" placeholder="Masukkan kode aset..." autocomplete="off" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Aset</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama aset..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <input type="text" name="deskripsi" class="form-control" placeholder="Masukkan deskripsi aset..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kategori</label>
                        <div class="col-sm-9">
                            <select name="id_kategori" class="form-control">
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['id_kategori']; ?>"><?= $category['kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Foto Utama</label>
                        <div class="col-sm-9">
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Foto 2</label>
                        <div class="col-sm-9">
                            <input type="file" name="foto2" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Foto 3</label>
                        <div class="col-sm-9">
                            <input type="file" name="foto3" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Foto 4</label>
                        <div class="col-sm-9">
                            <input type="file" name="foto4" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kapasitas</label>
                        <div class="col-sm-9">
                            <input type="text" name="kapasitas" class="form-control" placeholder="Masukkan kapasitas aset..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">CP Pengampu</label>
                        <div class="col-sm-9">
                            <input type="number" name="cp_pengampu" class="form-control" placeholder="Masukkan CP Pengampu aset..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tambahan waktu Pengembalian</label>
                        <div class="col-sm-6">
                            <input type="number" name="spare_waktu" class="form-control" value="15" placeholder="Masukan tambahan waktu (menit)" autocomplete="off">
                        </div>
                        <label class="col-sm-3 col-form-label"> (menit)</label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea name="ket" class="form-control" placeholder="Masukkan keterangan..." rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Lokasi Penyimpanan</label>
                        <div class="col-sm-9">
                            <textarea name="lokasi" class="form-control" placeholder="Masukkan lokasi penyimpanan..." rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kondisi Aset</label>
                        <div class="col-sm-9">
                            <select name="id_kondisi" class="form-control">
                                <option value="">-- Pilih Kondisi --</option>
                                <?php foreach ($kondisi as $kds) : ?>
                                    <option value="<?= $kds['id_kondisi']; ?>"><?= $kds['kondisi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status Aset</label>
                        <div class="col-sm-9">
                            <select name="is_aktif" class="form-control">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-outline">Tambah Data</button>
                    <button class="btn btn-secondary btn-outline" data-dismiss="modal" aria-hidden="true">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==================================  MODAL EDIT  ========================================= -->
<?php foreach ($aset as $tampil) : ?>
    <div id="modalEdit<?php echo $tampil['id_aset'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form class="form-horizontal" method="post" action="<?php echo base_url('aset/edit') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input name="id_aset" type="hidden" value="<?php echo $tampil['id_aset']; ?>">
                        <input name="foto_lama" type="hidden" value="<?php echo $tampil['foto']; ?>">
                        <input name="foto2_lama" type="hidden" value="<?php echo $tampil['foto2']; ?>">
                        <input name="foto3_lama" type="hidden" value="<?php echo $tampil['foto3']; ?>">
                        <input name="foto4_lama" type="hidden" value="<?php echo $tampil['foto4']; ?>">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kode Aset</label>
                            <div class="col-sm-9"><input type="text" name="kd_aset" value="<?= $tampil['kd_aset']; ?>" class="form-control" placeholder="Masukkan kode aset..." autocomplete="off"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Aset</label>
                            <div class="col-sm-9"><input type="text" name="nama" value="<?= $tampil['nama']; ?>" class="form-control" placeholder="Masukkan nama aset..." autocomplete="off"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9"><input type="text" name="deskripsi" value="<?= $tampil['deskripsi']; ?>" class="form-control" placeholder="Masukkan deskripsi aset..." autocomplete="off"></div>
                        </div>
                        <div class="form-group row form-group-with-border">
                            <label class="col-sm-3 col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <select name="id_kategori" class="form-control">
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category['id_kategori']; ?>" <?= ($category['id_kategori'] == $tampil['id_kategori']) ? 'selected' : ''; ?>><?= $category['kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Foto Utama Saat Ini</label>
                            <div class="col-sm-9">
                                <?php if($tampil['foto'] != null){ ?>
                                <img src="<?= base_url('uploads/' . $tampil['foto']); ?>" class="img-thumbnail" width="200" alt="Foto Aset">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row form-group-with-border">
                            <label class="col-sm-3 col-form-label">Foto Utama</label>
                            <div class="col-sm-9"><input type="file" name="foto" class="form-control"></div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Foto 2 Saat Ini</label>
                            <div class="col-sm-9">
                                <?php if($tampil['foto2'] != null){ ?>
                                <img src="<?= base_url('uploads/' . $tampil['foto2']); ?>" class="img-thumbnail" width="200" alt="Foto 2 Aset">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row form-group-with-border">
                            <label class="col-sm-3 col-form-label">Foto 2</label>
                            <div class="col-sm-9"><input type="file" name="foto2" class="form-control" placeholder="Masukkan nama aset..."></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Foto 3 Saat Ini</label>
                            <div class="col-sm-9">
                                <?php if($tampil['foto3'] != null){ ?>
                                <img src="<?= base_url('uploads/' . $tampil['foto3']); ?>" class="img-thumbnail" width="200" alt="Foto 3 Aset">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row form-group-with-border">
                            <label class="col-sm-3 col-form-label">Foto 3</label>
                            <div class="col-sm-9"><input type="file" name="foto3" class="form-control"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Foto 4 Saat Ini</label>
                            <div class="col-sm-9">
                                <?php if($tampil['foto4'] != null){ ?>
                                <img src="<?= base_url('uploads/' . $tampil['foto4']); ?>" class="img-thumbnail" width="200" alt="Foto 4 Aset">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row form-group-with-border">
                            <label class="col-sm-3 col-form-label">Foto 4</label>
                            <div class="col-sm-9"><input type="file" name="foto4" class="form-control"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kapasitas</label>
                            <div class="col-sm-9"><input type="text" name="kapasitas" value="<?= $tampil['kapasitas']; ?>" class="form-control" placeholder="Masukkan kapasitas aset..." autocomplete="off"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">CP Pengampu</label>
                            <div class="col-sm-9"><input type="number" name="cp_pengampu" value="<?= $tampil['cp_pengampu']; ?>" class="form-control" placeholder="Masukkan CP Pengampu aset..." autocomplete="off"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tambahan waktu Pengembalian</label>
                            <div class="col-sm-6"><input type="number" name="spare_waktu" value="<?= $tampil['spare_waktu']; ?>" class="form-control" placeholder="Masukan tambahan waktu (menit)" autocomplete="off"></div>
                            <label class="col-sm-3 col-form-label"> (menit)</label>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9"><textarea name="ket" class="form-control"><?= $tampil['ket']; ?></textarea></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Lokasi Penyimpanan</label>
                            <div class="col-sm-9"><textarea name="lokasi" class="form-control"><?= $tampil['lokasi']; ?></textarea></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kondisi Aset</label>
                            <div class="col-sm-9">
                                <select name="id_kondisi" class="form-control">
                                    <option value="">-- Pilih Kondisi --</option>
                                    <?php foreach ($kondisi as $kds) : ?>
                                        <option value="<?= $kds['id_kondisi']; ?>" <?= ($kds['id_kondisi'] == $tampil['id_kondisi']) ? 'selected' : ''; ?>><?= $kds['kondisi']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status Aset</label>
                            <div class="col-sm-9">
                                <select name="is_aktif" class="form-control">
                                    <option value="1" <?= (1 == $tampil['is_aktif']) ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="0" <?= (0 == $tampil['is_aktif']) ? 'selected' : ''; ?>>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-outline">Edit Data</button>
                        <button class="btn btn-secondary btn-outline" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php endforeach; ?>


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

<script>
    function viewAssetImage(imageUrl) {
        $('#assetImage').attr('src', imageUrl);
        $('#imageModal').modal('show');
    }
</script>
