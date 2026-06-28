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
                                    <th align="center">Tanggal Pelaporan</th>
                                    <th>Penerima Laporan</th>
                                    <th>Nama Pelapor</th>
                                    <th>Tanggal Insiden</th>
                                    <th>Deskripsi</th>
                                    <th>Domain</th>
                                    <th>SKPD</th>
                                    <th>Analisis Penyebab</th>
                                    <th>Dampak Insiden</th>
                                    <th>Upload Bukti</th>
                                    <th>Jenis Insiden</th>
                                    <th>Kategori Insiden</th>
                                    <th>Tindakan Koreksi</th>
                                    <th>Tanggal Pengendalian</th>
                                    <th>Root Cause</th>
                                    <th>Tindakan Korektif</th>
                                    <th>Tanggal Selesai Korektif</th>
                                    <th>Nama PIC Perbaikan</th>
                                    <th>Status</th>
                                    <th>Lesson Learned</th>
                                    <th>Catatan</th>
                                    <th align="center"><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($catatansiber as $tampil) : $no++ ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td align="center"><?= $tampil['tanggal_pelaporan']; ?></td>
                                        <td><?= $tampil['penerima_laporan']; ?></td>
                                        <td><?= $tampil['nama_pelapor']; ?></td>
                                        <td><?= $tampil['tanggal_insiden']; ?></td>
                                        <td><?= $tampil['deskripsi']; ?></td>
                                        <td><?= $tampil['nama_aplikasi']; ?></td>
                                        <td><?= $tampil['instansi']; ?></td>
                                        <td><?= $tampil['analisis_penyebab']; ?></td>
                                        <td><?= $tampil['dampak_insiden']; ?></td>
                                         <td>
                                            <a onclick="viewAssetImage('<?= base_url('uploads/' . $tampil['upload_bukti']) ?>')">
                                                <?php if($tampil['upload_bukti'] != null){ ?>
                                                    <img src="<?= base_url('uploads/' . $tampil['upload_bukti']); ?>" width="100">
                                                <?php } ?>
                                            </a>
                                        </td>
                                        <td><?= $tampil['jenis_insiden']; ?></td>
                                        <td><?= $tampil['level_insiden']; ?></td>
                                        <td><?= $tampil['tindakan_koreksi']; ?></td>
                                        <td><?= $tampil['tanggal_pengendalian']; ?></td>
                                        <td><?= $tampil['root_cause']; ?></td>
                                        <td><?= $tampil['tindakan_korektif']; ?></td>
                                        <td><?= $tampil['tanggal_selesai_korektif']; ?></td>
                                        <td><?= $tampil['nama_pic_perbaikan']; ?></td>
                                        <td><?= $tampil['status_recovery']; ?></td>
                                        <td><?= $tampil['lesson_learned']; ?></td>
                                        <td><?= $tampil['catatan']; ?></td>

                                        <td align="center">
                                            <div class="btn-group shadow">
                                                <button data-toggle="dropdown" class="btn btn-info btn-outline dropdown-toggle">Tindakan</button>
                                                <ul class="dropdown-menu shadow">
                                                    <li><a class="dropdown-item" href="#modalEdit<?= $tampil['id_insiden_siber'] ?>" data-toggle="modal" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="<?= base_url('catatansiber/delete/') . $tampil['id_insiden_siber']; ?>" onclick="return confirm('Yakin menghapus data <?= $tampil['nama']; ?>?');"><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
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

<?php foreach ($catatansiber as $tampil) : ?>
    <!-- Modal -->
    <div class="modal fade" id="fotoModal<?= $tampil['id_insiden_siber']; ?>" tabindex="-1" role="dialog" aria-labelledby="fotoModalLabel<?= $tampil['id_insiden_siber']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fotoModalLabel<?= $tampil['id_insiden_siber']; ?>">Upload Bukti</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="<?= base_url('uploads/' . $tampil['upload_bukti']); ?>" class="img-fluid" alt="Foto bukti">
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
                <h5 class="modal-title">Tambah Data Pencatatan Insiden Siber</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('catatansiber') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Tanggal Pelaporan</label>
                        <div class="col-sm-9"><input type="date" name="tanggal_pelaporan" class="form-control" placeholder="Masukkan tanggal..." autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Penerima Laporan</label>
                        <div class="col-sm-9">
                            <input type="text" name="penerima_laporan" class="form-control" placeholder="Masukkan penerima laporan..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Pelapor</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_pelapor" class="form-control" placeholder="Masukkan Nama Pelapor..." autocomplete="off">
                        </div>
                    </div>
                     <div class="form-group row"><label class="col-sm-3 col-form-label">Tanggal Insiden</label>
                        <div class="col-sm-9"><input type="date" name="tanggal_insiden" class="form-control" placeholder="Masukkan tanggal..." autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Domain</label>
                        <div class="col-sm-9">
                            <select name="id_domain" class="form-control">
                                <option value="">-- Pilih Domain --</option>
                                <?php foreach ($domain as $domains) : ?>
                                    <option value="<?= $domains['id_domain']; ?>"><?= $domains['nama_aplikasi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea name="deskripsi" class="form-control" placeholder="Masukkan deskripsi..." rows="3"></textarea>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">analisis penyebab</label>
                        <div class="col-sm-9">
                            <input type="text" name="analisis_penyebab" class="form-control" placeholder="Masukkan analisis penyebab..." autocomplete="off">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">dampak insiden</label>
                        <div class="col-sm-9">
                            <input type="text" name="dampak_insiden" class="form-control" placeholder="Masukkan dampak_insiden..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">upload bukti</label>
                        <div class="col-sm-9">
                            <input type="file" name="upload_bukti" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">jenis insiden</label>
                        <div class="col-sm-9">
                            <select name="id_jenis_insiden" class="form-control">
                                <option value="">-- Pilih Jenis Insiden --</option>
                                <?php foreach ($jenisinsiden as $jsi) : ?>
                                    <option value="<?= $jsi['id_jenis_insiden']; ?>"><?= $jsi['jenis_insiden']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">kategori insiden</label>
                        <div class="col-sm-9">
                            <select name="id_level_insiden" class="form-control">
                                <option value="">-- Pilih Kategori Insiden --</option>
                                <?php foreach ($levelinsiden as $levelinsidens) : ?>
                                    <option value="<?= $levelinsidens['id_level_insiden']; ?>"><?= $levelinsidens['level_insiden']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">tindakan koreksi</label>
                        <div class="col-sm-9">
                            <input type="text" name="tindakan_koreksi" class="form-control" placeholder="Masukkan tindakan koreksi..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">tanggal pengendalian</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggal_pengendalian" class="form-control" placeholder="Masukkan tanggal pengendalian..." autocomplete="off" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">root cause</label>
                        <div class="col-sm-9">
                            <input type="text" name="root_cause" class="form-control" placeholder="Masukkan root cause..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">tindakan korektif</label>
                        <div class="col-sm-9">
                            <input type="text" name="tindakan_korektif" class="form-control" placeholder="Masukkan tindakan korektif..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">tanggal selesai korektif</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggal_selesai_korektif" class="form-control" placeholder="Masukkan tanggal selesai korektif..." autocomplete="off" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">nama pic perbaikan</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_pic_perbaikan" class="form-control" placeholder="Masukkan nama pic perbaikan..." autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select name="id_status_recovery" class="form-control">
                                <option value="">-- Pilih Status --</option>
                                <?php foreach ($statusrecovery as $recory) : ?>
                                    <option value="<?= $recory['id_status_recovery']; ?>"><?= $recory['status_recovery']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">lesson learned</label>
                        <div class="col-sm-9">
                            <input type="text" name="lesson_learned" class="form-control" placeholder="Masukkan lesson learned..." autocomplete="off">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Catatan</label>
                        <div class="col-sm-9">
                            <textarea name="catatan" class="form-control" placeholder="Masukkan catatan..." rows="3"></textarea>
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
<?php foreach ($catatansiber as $tampil) : ?>
    <div id="modalEdit<?php echo $tampil['id_insiden_siber'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pencatatan Insiden Siber</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form class="form-horizontal" method="post" action="<?php echo base_url('catatansiber/edit') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input name="id_insiden_siber" type="hidden" value="<?php echo $tampil['id_insiden_siber']; ?>">
                        <input name="foto_lama" type="hidden" value="<?php echo $tampil['upload_bukti']; ?>">
                      

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">tanggal pelaporan</label>
                            <div class="col-sm-9"><input type="text" name="tanggal_pelaporan" value="<?= $tampil['tanggal_pelaporan']; ?>" class="form-control" placeholder="Masukkan tanggal pelaporan..." autocomplete="off"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">penerima laporan</label>
                            <div class="col-sm-9"><input type="text" name="penerima_laporan" value="<?= $tampil['penerima_laporan']; ?>" class="form-control" placeholder="Masukkan penerima laporan..." autocomplete="off"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">nama pelapor</label>
                            <div class="col-sm-9"><input type="text" name="nama_pelapor" value="<?= $tampil['nama_pelapor']; ?>" class="form-control" placeholder="Masukkan nama pelapor..." autocomplete="off"></div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">tanggal insiden</label>
                            <div class="col-sm-9"><input type="date" name="tanggal_insiden" value="<?= $tampil['tanggal_insiden']; ?>" class="form-control" placeholder="Masukkan tanggal..." autocomplete="off"></div>
                        </div>

                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Domain</label>
                            <div class="col-sm-9">
                                <select name="id_domain" class="form-control">
                                    <option value="">-- Pilih Domain --</option>
                                    <?php foreach ($domain as $domains) : ?>
                                        <option value="<?= $domains['id_domain']; ?>" <?= ($domains['id_domain'] == $tampil['id_domain']) ? 'selected' : ''; ?>><?= $domains['nama_aplikasi']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">deskripsi</label>
                            <div class="col-sm-9"><textarea name="deskripsi" class="form-control"><?= $tampil['deskripsi']; ?></textarea></div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">analisis penyebab</label>
                            <div class="col-sm-9"><input type="text" name="analisis_penyebab" value="<?= $tampil['analisis_penyebab']; ?>" class="form-control" placeholder="Masukkan analisis penyebab..." autocomplete="off"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">dampak insiden</label>
                            <div class="col-sm-9"><input type="text" name="dampak_insiden" value="<?= $tampil['dampak_insiden']; ?>" class="form-control" placeholder="Masukkan dampak insiden..." autocomplete="off"></div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Bukti Foto</label>
                            <div class="col-sm-9">
                                <?php if($tampil['upload_bukti'] != null){ ?>
                                <img src="<?= base_url('uploads/' . $tampil['upload_bukti']); ?>" class="img-thumbnail" width="200" alt="Foto Bukti">
                                <?php } ?>
                            </div>
                        </div>
                          <div class="form-group row ">
                            <label class="col-sm-3 col-form-label">Upload Bukti</label>
                            <div class="col-sm-9"><input type="file" name="upload_bukti" class="form-control"></div>
                        </div>
                        <br>

                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">jenis insiden</label>
                            <div class="col-sm-9">
                                <select name="id_jenis_insiden" class="form-control">
                                    <option value="">-- Pilih Jenis Insiden --</option>
                                    <?php foreach ($jenisinsiden as $jsi) : ?>
                                         <option value="<?= $jsi['id_jenis_insiden']; ?>" <?= ($jsi['id_jenis_insiden'] == $tampil['id_jenis_insiden']) ? 'selected' : ''; ?>><?= $jsi['jenis_insiden']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kategori Insiden</label>
                            <div class="col-sm-9">
                                <select name="id_kategori" class="form-control">
                                    <option value="">-- Pilih Kategori Insiden --</option>
                                   <?php foreach ($levelinsiden as $levelinsidens) : ?>
                                        <option value="<?= $levelinsidens['id_level_insiden']; ?>" <?= ($levelinsidens['id_level_insiden'] == $tampil['id_level_insiden']) ? 'selected' : ''; ?>><?= $levelinsidens['level_insiden']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">tindakan koreksi</label>
                            <div class="col-sm-9"><input type="text" name="tindakan_koreksi" value="<?= $tampil['tindakan_koreksi']; ?>" class="form-control" placeholder="Masukkan tindakan koreksi..." autocomplete="off"></div>
                        </div>
                       <div class="form-group row">
                            <label class="col-sm-3 col-form-label">tanggal pengendalian</label>
                            <div class="col-sm-9"><input type="text" name="tanggal_pengendalian" value="<?= $tampil['tanggal_pengendalian']; ?>" class="form-control" placeholder="Masukkan tanggal_pengendalian..." autocomplete="off"></div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">root cause</label>
                            <div class="col-sm-9"><input type="text" name="root_cause" value="<?= $tampil['root_cause']; ?>" class="form-control" placeholder="Masukkan root_cause..." autocomplete="off"></div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">tindakan_korektif</label>
                            <div class="col-sm-9"><input type="text" name="tindakan_korektif" value="<?= $tampil['tindakan_korektif']; ?>" class="form-control" placeholder="Masukkan tindakan_korektif..." autocomplete="off"></div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">tanggal selesai korektif</label>
                            <div class="col-sm-9"><input type="date" name="tanggal_selesai_korektif" value="<?= $tampil['tanggal_selesai_korektif']; ?>" class="form-control" placeholder="Masukkan tanggal selesai korektif..." autocomplete="off"></div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">nama pic perbaikan</label>
                            <div class="col-sm-9"><input type="text" name="nama_pic_perbaikan" value="<?= $tampil['nama_pic_perbaikan']; ?>" class="form-control" placeholder="Masukkan nama pic perbaikan..." autocomplete="off"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select name="id_status_recovery" class="form-control">
                                    <option value="">-- Pilih Status --</option>
                                    <?php foreach ($statusrecovery as $recory) : ?>
                                        <option value="<?= $recory['id_status_recovery']; ?>" <?= ($recory['id_status_recovery'] == $tampil['id_status_recovery']) ? 'selected' : ''; ?>><?= $recory['status_recovery']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">lesson learned</label>
                            <div class="col-sm-9"><input type="text" name="lesson_learned" value="<?= $tampil['lesson_learned']; ?>" class="form-control" placeholder="Masukkan lesson learned..." autocomplete="off"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">catatan</label>
                            <div class="col-sm-9"><textarea name="catatan" class="form-control"><?= $tampil['catatan']; ?></textarea></div>
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
        <h5 class="modal-title">Detail Foto</h5>
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
