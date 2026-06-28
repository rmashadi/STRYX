<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
             <?php echo validation_errors('<div class="alert alert-danger shadow" role="alert"><a class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>') ?>
            <!-- Flashdata -->
            <?php if ($this->session->flashdata('add')) : ?>
                <div class="alert alert-success"><?= $this->session->flashdata('add'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('edit')) : ?>
                <div class="alert alert-warning"><?= $this->session->flashdata('edit'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('delete')) : ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('delete'); ?></div>
            <?php endif; ?>

            <div class="ibox shadow">
                <div class="ibox-title">
                    <div class="ibox-title">
                        <a class="btn btn-outline btn-primary shadow" href="" data-toggle="modal" data-target="#modalTambah">Tambah Permohonan ITSA</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Surat</th>
                                    <th>Tgl Surat</th>
                                    <th>Tgl Terima</th>
                                    <th>Nama Instansi</th>
                                    <th>Perihal</th>
                                    <th>No Surat Demo</th>
                                    <th>Tgl Demo</th>
                                    <th>Kesiapan</th>
                                    <th>Pelaksanaan</th>
                                    <th>No Surat ITSA</th>
                                    <th>Tgl Surat ITSA</th>
                                    <th>Dokumen</th>
                                    <th>Kerentanan</th>
                                    <th>Perbaikan ITSA</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($itsa as $item) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $item['no_surat']; ?></td>
                                        <td><?= date('d-m-Y', strtotime($item['tgl_surat'])); ?></td>
                                        <td><?= date('d-m-Y', strtotime($item['tgl_surat_terima'])); ?></td>
                                        <td><?= $item['instansi']; ?></td>
                                        <td><?= $item['perihal']; ?></td>
                                        <td><?= $item['no_surat_demo']; ?></td>
                                        <td><?= date('d-m-Y', strtotime($item['tgl_demo'])); ?></td>
                                        <td><?= $item['kesiapan_itsa']; ?></td>
                                        <td><?= $item['pelaksanaan_itsa']; ?></td>
                                        <td><?= $item['no_surat_itsa']; ?></td>
                                        <td><?= date('d-m-Y', strtotime($item['tgl_surat_itsa'])); ?></td>
                                        <td>
                                            <?php if ($item['doc_notulen']) : ?>
                                                <i class="glyphicon glyphicon-file"> <a href="<?= base_url('uploads/' . $item['doc_notulen']); ?>" target="_blank">Notulen</a><br>
                                            <?php endif; ?>
                                            <?php if ($item['doc_laporan_itsa']) : ?>
                                                <i class="glyphicon glyphicon-file"> <a href="<?= base_url('uploads/' . $item['doc_laporan_itsa']); ?>" target="_blank">Laporan</a>
                                            <?php endif; ?>
                                        </td>
                                        <td><a href="#modalKerentanan<?= $item['id_layanan'] ?>" data-toggle="modal" title="addkerentanan"><span class="label label-primary shadow">Add Keretanan</span></a>
                                        <?php if (!empty($item['kerentanan'])): ?>
                                                <div class="mt-2">
                                                    <h6><strong>Data Kerentanan:</strong></h6>
                                                    <table class="table table-bordered table-sm">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Kerentanan</th>
                                                                <th>Jumlah</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 1; foreach ($item['kerentanan'] as $ker): ?>
                                                                <tr>
                                                                    <td><?= $no++; ?></td>
                                                                    <td><?= $ker['level_rentan']; ?></td>
                                                                    <td><?= $ker['jumlah']; ?></td>
                                                                    <td><a class="dropdown-item" href="<?= base_url('itsa/hapuslistkerentanan/') . $ker['id_list']; ?>" onclick="return confirm('Yakin menghapus data <?= $ker['level_rentan']; ?>?');"><i class="glyphicon glyphicon-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php else: ?>
                                                <div class="text-muted"><em>Belum ada data kerentanan</em></div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="#modalPerbaikan<?= $item['id_layanan'] ?>" data-toggle="modal" title="addperbaikan"><span class="label label-primary shadow">Add Perbaikan ITSA</span></a>
                                                <!-- TABEL DATA PERBAIKAN -->
                                                <?php if (!empty($item['perbaikan'])) : ?>
                                                    <div class="mt-2">
                                                        <h6><strong>Riwayat Perbaikan ITSA:</strong></h6>
                                                        <table class="table table-bordered table-sm">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>No Surat Perbaikan</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Pelaksanaan Verifikasi</th>
                                                                    <th>No Surat Verifikasi</th>
                                                                    <th>Tanggal Verifikasi</th>
                                                                    <th>Dok. Perbaikan</th>
                                                                    <th>Dok. Verifikasi</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $no = 1; foreach ($item['perbaikan'] as $pbk) : ?>
                                                                <tr>
                                                                    <td><?= $no++; ?></td>
                                                                    <td><?= $pbk['no_surat_perbaikan']; ?></td>
                                                                    <td><?= date('d-m-Y', strtotime($pbk['tgl_surat_perbaikan'])); ?></td>
                                                                    <td><?= $pbk['pelaksanaan_verifikasi']; ?></td>
                                                                    <td><?= $pbk['no_surat_verifikasi']; ?></td>
                                                                    <td><?= date('d-m-Y', strtotime($pbk['tgl_surat_verifikasi'])); ?></td>
                                                                    <td>
                                                                        <?php if ($pbk['doc_perbaikan']) : ?>
                                                                            <a href="<?= base_url('uploads/' . $pbk['doc_perbaikan']); ?>" target="_blank">Download</a>
                                                                        <?php else : ?>
                                                                            -
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if ($pbk['doc_verifikasi']) : ?>
                                                                            <a href="<?= base_url('uploads/' . $pbk['doc_verifikasi']); ?>" target="_blank">Download</a>
                                                                        <?php else : ?>
                                                                            -
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td><a class="dropdown-item" href="<?= base_url('itsa/hapusperbaikan/') . $pbk['id_perbaikan']; ?>" onclick="return confirm('Yakin menghapus data <?= $pbk['no_surat_perbaikan']; ?>?');"><i class="glyphicon glyphicon-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="text-muted"><em>Belum ada data perbaikan</em></div>
                                                <?php endif; ?>
                                        </td>
                                        </td>
                                        <td>
                                            <div class="btn-group shadow">
                                                <button data-toggle="dropdown" class="btn btn-info btn-outline dropdown-toggle">Tindakan</button>
                                                <ul class="dropdown-menu shadow">
                                                    <li><a class="dropdown-item" href="#modalEdit<?= $item['id_layanan'] ?>" data-toggle="modal" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit</a></li>

                                                    <li><a class="dropdown-item" href="<?= base_url('itsa/hapus/') . $item['id_layanan']; ?>" onclick="return confirm('Yakin menghapus data <?= $item['no_surat']; ?>?');"><i class="glyphicon glyphicon-trash"></i> Delete</a></li>

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

<!-- Modal Tambah Permohonan ITSA -->
<div id="modalTambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Permohonan ITSA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('itsa/tambah'); ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No Surat</label>
                        <div class="col-sm-9">
                            <input type="text" name="no_surat" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Surat</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_surat" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Surat Diterima</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_surat_terima" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Instansi</label>
                        <div class="col-sm-9">
                            <select name="id_instansi" class="form-control" required>
                                <option value="">-- Pilih Instansi --</option>
                                <?php foreach ($instansi as $ins) : ?>
                                    <option value="<?= $ins['id_instansi']; ?>"><?= $ins['instansi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Perihal</label>
                        <div class="col-sm-9">
                            <input type="text" name="perihal" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No Surat Demo</label>
                        <div class="col-sm-9">
                            <input type="text" name="no_surat_demo" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Surat Demo</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_surat_demo" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Demo</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_demo" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kesiapan ITSA</label>
                        <div class="col-sm-9">
                            <select name="kesiapan_itsa" class="form-control" required>
                                <option value="Siap">Siap</option>
                                <option value="Belum">Belum</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pelaksanaan ITSA</label>
                        <div class="col-sm-9">
                            <input type="text" name="pelaksanaan_itsa" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No Surat ITSA</label>
                        <div class="col-sm-9">
                            <input type="text" name="no_surat_itsa" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Surat ITSA</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_surat_itsa" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Upload Notulen</label>
                        <div class="col-sm-9">
                            <input type="file" name="doc_notulen" class="form-control" accept=".pdf,.doc,.docx">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Upload Laporan ITSA</label>
                        <div class="col-sm-9">
                            <input type="file" name="doc_laporan_itsa" class="form-control" accept=".pdf,.doc,.docx">
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


<!-- Modal Edit Permohonan ITSA -->
<div id="modalEdit<?= $item['id_layanan'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModal<?= $item['id_layanan'] ?>">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h5 class="modal-title">Edit Permohonan ITSA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('itsa/edit'); ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_layanan" value="<?= $item['id_layanan']; ?>">
                    <input type="hidden" name="doc_notulen_lama" value="<?= $item['doc_notulen']; ?>">
                    <input type="hidden" name="doc_laporan_itsa_lama" value="<?= $item['doc_laporan_itsa']; ?>">

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No Surat</label>
                        <div class="col-sm-9">
                            <input type="text" name="no_surat" class="form-control" value="<?= $item['no_surat']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Surat</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_surat" class="form-control" value="<?= $item['tgl_surat']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Surat Diterima</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_surat_terima" class="form-control" value="<?= $item['tgl_surat_terima']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Instansi</label>
                        <div class="col-sm-9">
                            <select name="id_instansi" class="form-control" required>
                                <option value="">-- Pilih Instansi --</option>
                                <?php foreach ($instansi as $ins) : ?>
                                    <option value="<?= $ins['id_instansi']; ?>" <?= $ins['id_instansi'] == $item['id_instansi'] ? 'selected' : ''; ?>>
                                        <?= $ins['instansi']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Perihal</label>
                        <div class="col-sm-9">
                            <input type="text" name="perihal" class="form-control" value="<?= $item['perihal']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No Surat Demo</label>
                        <div class="col-sm-9">
                            <input type="text" name="no_surat_demo" class="form-control" value="<?= $item['no_surat_demo']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Surat Demo</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_surat_demo" class="form-control" value="<?= $item['tgl_surat_demo']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Demo</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_demo" class="form-control" value="<?= $item['tgl_demo']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kesiapan ITSA</label>
                        <div class="col-sm-9">
                            <select name="kesiapan_itsa" class="form-control" required>
                                <option value="Siap" <?= $item['kesiapan_itsa'] == 'Siap' ? 'selected' : ''; ?>>Siap</option>
                                <option value="Belum" <?= $item['kesiapan_itsa'] == 'Belum' ? 'selected' : ''; ?>>Belum</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pelaksanaan ITSA</label>
                        <div class="col-sm-9">
                            <input type="text" name="pelaksanaan_itsa" class="form-control" value="<?= $item['pelaksanaan_itsa']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No Surat ITSA</label>
                        <div class="col-sm-9">
                            <input type="text" name="no_surat_itsa" class="form-control" value="<?= $item['no_surat_itsa']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Surat ITSA</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_surat_itsa" class="form-control" value="<?= $item['tgl_surat_itsa']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Upload Notulen</label>
                        <div class="col-sm-9">
                            <input type="file" name="doc_notulen" class="form-control" accept=".pdf,.doc,.docx">
                            <small class="text-muted">File lama: <?= $item['doc_notulen']; ?></small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Upload Laporan ITSA</label>
                        <div class="col-sm-9">
                            <input type="file" name="doc_laporan_itsa" class="form-control" accept=".pdf,.doc,.docx">
                            <small class="text-muted">File lama: <?= $item['doc_laporan_itsa']; ?></small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-outline">Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Add Kerentanan -->
<div id="modalKerentanan<?= $item['id_layanan'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="kerentananModal<?= $item['id_layanan'] ?>">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content animated fadeInDown">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kerentanan dan Jumlahnya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
            </div>
            <form method="POST" action="<?= base_url('itsa/tambah_kerentanan'); ?>">
                <div class="modal-body">
                    <input type="hidden" name="id_layanan" value="<?= $item['id_layanan']; ?>">

                    <div class="form-group">
                        <label for="id_level_rentan">Level Kerentanan</label>
                        <select name="id_level_rentan" class="form-control" required>
                            <option value="">-- Pilih Level Kerentanan --</option>
                            <?php foreach ($level_rentan as $level) : ?>
                                <option value="<?= $level['id_level_rentan']; ?>"><?= $level['level_rentan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-outline">Simpan</button>
                    <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Perbaikan ITSA -->
<div id="modalPerbaikan<?= $item['id_layanan'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalPerbaikanLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Perbaikan ITSA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('itsa/addPerbaikan'); ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_layanan" value="<?= $item['id_layanan']; ?>">

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">No Surat Perbaikan</label>
                        <div class="col-sm-8">
                            <input type="text" name="no_surat_perbaikan" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tanggal Surat Perbaikan</label>
                        <div class="col-sm-8">
                            <input type="date" name="tgl_surat_perbaikan" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Upload Dokumen Perbaikan</label>
                        <div class="col-sm-8">
                            <input type="file" name="doc_perbaikan" class="form-control" accept=".pdf,.doc,.docx">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Pelaksanaan Verifikasi</label>
                        <div class="col-sm-8">
                            <input type="text" name="pelaksanaan_verifikasi" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">No Surat Verifikasi</label>
                        <div class="col-sm-8">
                            <input type="text" name="no_surat_verifikasi" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tanggal Surat Verifikasi</label>
                        <div class="col-sm-8">
                            <input type="date" name="tgl_surat_verifikasi" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Upload Dokumen Verifikasi</label>
                        <div class="col-sm-8">
                            <input type="file" name="doc_verifikasi" class="form-control" accept=".pdf,.doc,.docx">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-outline">Simpan</button>
                    <button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
