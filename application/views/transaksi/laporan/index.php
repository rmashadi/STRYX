<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>


            <!-- Filter Form -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Filter Laporan</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('laporan') ?>">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="id_aset">Pilih Aset</label>
                                    <select name="id_aset" class="form-control">
                                        <option value="">Semua Aset</option>
                                        <?php foreach ($aset as $item): ?>
                                            <option value="<?= $item['id_aset'] ?>" <?= $this->input->post('id_aset') == $item['id_aset'] ? 'selected' : '' ?>>
                                                <?= $item['nama'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="tgl_mulai">Tanggal Mulai</label>
                                    <input type="date" name="tgl_mulai" class="form-control" value="<?= $this->input->post('tgl_mulai') ?>">
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="tgl_selesai">Tanggal Selesai</label>
                                    <input type="date" name="tgl_selesai" class="form-control" value="<?= $this->input->post('tgl_selesai') ?>">
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">Semua Status</option>
                                        <option value="pending" <?= $this->input->post('status') == 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="approved" <?= $this->input->post('status') == 'approved' ? 'selected' : '' ?>>Approved</option>
                                        <option value="rejected" <?= $this->input->post('status') == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                        <option value="completed" <?= $this->input->post('status') == 'completed' ? 'selected' : '' ?>>Completed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                    <a href="<?= base_url('laporan') ?>" class="btn btn-secondary btn-sm">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            

            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between">
                    <!-- <h6 class="m-0 font-weight-bold text-primary"></h6> -->
                    <form method="POST" action="<?= base_url('laporan/cetak_pdf') ?>" target="_blank" style="display: inline;">
                        <input type="hidden" name="id_aset" value="<?= $this->input->post('id_aset') ?>">
                        <input type="hidden" name="tgl_mulai" value="<?= $this->input->post('tgl_mulai') ?>">
                        <input type="hidden" name="tgl_selesai" value="<?= $this->input->post('tgl_selesai') ?>">
                        <input type="hidden" name="status" value="<?= $this->input->post('status') ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Cetak PDF</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables">
                            <thead>
                                <tr align="center">
                                    <th>#</th>
                                    <th>Nama Aset</th>
                                    <th>Kategori</th>
                                    <th>Nama Peminjam</th>
                                    <th>Instansi</th>
                                    <th>Acara</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($peminjaman as $item): ?>
                                    <tr align="center">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item['nama_aset'] ?></td>
                                        <td><?= $item['kategori'] ?></td>
                                        <td><?= $item['nama_peminjam'] ?></td>
                                        <td><?= $item['instansi'] ?></td>
                                        <td><?= $item['acara'] ?></td>
                                        <td><?= $item['tgl_mulai'] ?></td>
                                        <td><?= $item['tgl_selesai'] ?></td>
                                        <td><?= $item['status'] ?></td>
                                        <td><?= $item['ket'] ?></td>
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


