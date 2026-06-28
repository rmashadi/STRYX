<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <div class="ibox shadow">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables">
                            <thead>
                                <tr align="center">
                                    <th>#</th>
                                    <th>Nama Aset</th>
                                    <th>Nama Peminjam</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th>Ket. Pengembalian</th>
                                    <th>Kondisi Kembali</th>
                                    <th><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($peminjaman as $item): ?>
                                    <tr align="center">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item['nama_aset'] ?></td>
                                        <td><?= $item['nama_peminjam'] ?></td>
                                        <td><?= $item['tgl_mulai'] ?></td>
                                        <td><?= $item['tgl_selesai'] ?></td>
                                        <td>
                                            <?php
                                            $status = strtolower($item['status']); // Mengubah status menjadi lowercase
                                            switch ($status) {
                                                case 'pending':
                                                    echo '<span class="label bg-warning text-white" >Pending</span>';
                                                    break;
                                                case 'approved':
                                                    echo '<span class="label bg-primary text-white " >Approved</span>';
                                                    break;
                                                case 'rejected':
                                                    echo '<span class="label bg-secondary text-white" >Rejected</span>';
                                                    break;
                                                case 'completed':
                                                    echo '<span class="label bg-success text-white" >Completed</span>';
                                                    break;
                                                default:
                                                    echo '<span class="label label-default">Unknown</span>';
                                            }
                                            ?>
                                        </td>
                                        <td><?= $item['ket_pengembalian'] ?></td>
                                        <td><?= $item['kondisi'] ?></td>
                                        <td>
                                                <a href="#modalEdit<?= $item['id_peminjaman'] ?>" data-toggle="modal" title="Edit">
                                                <button class="btn btn-info">Aksi</button></a>
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


<!-- Modal Edit Peminjaman -->
<?php foreach ($peminjaman as $item) : ?>
<div id="modalEdit<?= $item['id_peminjaman']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h5 class="modal-title">Form Pengembalian Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('pengembalian/edit/' . $item['id_peminjaman']) ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Aset</label>
                        <input type="hidden" name="id_aset" value="<?= $item['id_aset']; ?>">
                        <input name="foto_lama" type="hidden" value="<?= $item['img_pengembalian']; ?>">
                        <div class="col-sm-9">
                                <?php foreach ($aset as $a): ?>
                                    <?php if ($item['id_aset'] == $a['id_aset']) { echo $a['nama']; } ?> 
                                <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Mulai</label>
                        <div class="col-sm-9">
                            <?= $item['tgl_mulai'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Selesai</label>
                        <div class="col-sm-9">
                            <?= $item['tgl_selesai'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Peminjam</label>
                        <div class="col-sm-9">
                            <?= $item['nama_peminjam'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Instansi</label>
                        <div class="col-sm-9">
                            <?= $item['instansi'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Acara</label>
                        <div class="col-sm-9">
                            <?= $item['acara'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No. HP</label>
                        <div class="col-sm-9">
                            <?= $item['no_hp'] ?>
                        </div>
                    </div>
                    <div class="form-group row form-group-with-border">
                        <label class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <?= $item['ket'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kondisi Aset</label>
                            <div class="col-sm-9">
                                <select name="id_kondisi" class="form-control">
                                    <?php foreach ($kondisi as $kds) : ?>
                                        <option value="<?= $kds['id_kondisi']; ?>" <?= ($kds['id_kondisi'] == $item['id_kondisi']) ? 'selected' : ''; ?>><?= $kds['kondisi']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Foto Kerusakan</label>
                        <div class="col-sm-9">
                            <?php if($item['img_pengembalian'] != null){ ?>
                                <img src="<?= base_url('uploads/' . $item['img_pengembalian']); ?>" class="img-thumbnail" width="200" alt="Foto 4 Aset"><br><br>
                            <?php } ?>
                            <input type="file" name="img_pengembalian" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Keterangan Kerusakan</label>
                        <div class="col-sm-9">
                            <textarea name="ket_pengembalian" class="form-control" placeholder="Masukkan keterangan..." rows="3"><?= $item['ket_pengembalian']; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-outline">Update</button>
                    <button class="btn btn-secondary btn-outline" data-dismiss="modal" aria-hidden="true">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

