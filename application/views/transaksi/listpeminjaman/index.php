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
                                        <td>
                                                <a href="#modalEdit<?= $item['id_peminjaman'] ?>" data-toggle="modal" title="Edit">
                                                <button class="btn btn-info">Approve ?</button></a>
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
                <h5 class="modal-title">Edit Peminjaman Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('listpeminjaman/edit/' . $item['id_peminjaman']) ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Aset</label>
                        <input type="hidden" name="id_aset" value="<?= $item['id_aset']; ?>">
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
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <?= $item['ket'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Approve Peminjaman?</label>
                        <div class="col-sm-9">
                            <select name="status" class="form-control">
                                <option value="pending" <?= $item['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="approved" <?= $item['status'] == 'approved' ? 'selected' : '' ?>>Approved</option>
                                <option value="rejected" <?= $item['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                            </select>
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

