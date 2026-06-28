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
                                    <th>NIK / Username</th>
                                    <th>Nama</th>
                                    <th>No Whatapp</th>
                                    <th>Email</th>
                                    <th>Instansi</th>
                                    <th>Tgl. Pengajuan</th>
                                    <th>Status</th>
                                    <th><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($register as $item): ?>
                                    <tr align="center">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item['username'] ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['email'] ?></td>
                                        <td><?= $item['no_hp'] ?></td>
                                        <td><?= $item['instansi'] ?></td>
                                        <td><?= $item['date_created'] ?></td>
                                        <td>
                                            <?= $item['is_active'] == 1 ? 'Disetujui' : 'Belum Disetujui' ?>
                                        </td>
                                        <td>
                                            <?php if ($item['is_active'] == 0): ?>
                                                <a href="#modalEdit<?= $item['id_user'] ?>" data-toggle="modal" title="Edit">
                                                    <button class="btn btn-info">Approve ?</button>
                                                </a>
                                            <?php else: ?>
                                                <button class="btn btn-secondary" disabled>Approved</button>
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


<!-- Modal Edit Peminjaman -->
<?php foreach ($register as $item) : ?>
<div id="modalEdit<?= $item['id_user']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h5 class="modal-title">Persetujuan User Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('registerlist/approve/' . $item['id_user']) ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">NIK / Username</label>
                        <div class="col-sm-8">
                            <?= $item['username'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <?= $item['name'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">No Whatapp</label>
                        <div class="col-sm-8">
                            <?= $item['no_hp'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Instansi</label>
                        <div class="col-sm-8">
                            <?= $item['instansi'] ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <?= $item['email'] ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-outline">Approve</button>
                    <button class="btn btn-secondary btn-outline" data-dismiss="modal" aria-hidden="true">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>





