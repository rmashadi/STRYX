<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <?php echo validation_errors('<div class="alert alert-danger shadow" role="alert"><a class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>') ?>
            <div class="ibox shadow">
                <div class="ibox-title"><a class="btn btn-outline btn-primary shadow" href="" data-toggle="modal" data-target="#addData">Tambah Data</a></div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables">
                            <thead>
                                <tr align="center">
                                    <th>#.</th>
                                    <!-- <th>Kode Instansi</th> -->
                                    <th>Instansi</th>
                                    <!-- <th>Alamat</th> -->
                                    <th><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($instansi as $tampil) : $no++ ?>
                                    <tr>
                                        <td align="center"><?= $no; ?></td>
                                        <!-- <td><?= $tampil['kode_instansi']; ?></td> -->
                                        <td><?= $tampil['instansi']; ?></td>
                                        <!-- <td><?= $tampil['alamat']; ?></td> -->
                                        <td>
                                            <div class="btn-group shadow">
                                                <button data-toggle="dropdown" class="btn btn-info btn btn-outline dropdown-toggle">Tindakan</button>
                                                <ul class="dropdown-menu shadow">
                                                    <li><a class="dropdown-item" href="#modalEdit<?= $tampil['id_instansi'] ?>" data-toggle="modal" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="<?= base_url('instansi/delete/') . $tampil['id_instansi'] ?>" onclick="return confirm('Yakin menghapus data <?= $tampil['instansi']; ?>?');"><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
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

<!-- ==================================  MODAL TAMBAH  ========================================= -->
<div id="addData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Instansi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form class="form-horizontal" method="POST" action="<?php echo base_url('instansi') ?>">
                <div class="modal-body">
                   <!--  <div class="form-group row"><label class="col-sm-3 col-form-label">Kode Instansi</label>
                        <div class="col-sm-9"><input type="text" name="kode_instansi" class="form-control" placeholder="Masukkan instansi..." autocomplete="off" autofocus></div>
                    </div> -->
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Instansi</label>
                        <div class="col-sm-9"><input type="text" name="instansi" class="form-control" placeholder="Masukkan instansi..." autocomplete="off" autofocus></div>
                    </div>
                   <!--  <div class="form-group row"><label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9"><textarea name="alamat" class="form-control" placeholder="Masukkan alamat..."></textarea></div>
                    </div> -->
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
<?php foreach ($instansi as $tampil) : ?>
    <div id="modalEdit<?php echo $tampil['id_instansi'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Instansi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form class="form-horizontal" method="post" action="<?php echo base_url('instansi/Edit') ?>">
                    <div class="modal-body">
                        <input name="id_instansi" type="hidden" value="<?php echo $tampil['id_instansi']; ?>">
                      <!--   <div class="form-group row"><label class="col-sm-3 col-form-label">Kode Instansi</label>
                            <div class="col-sm-9"><input type="text" name="kode_instansi" value="<?= $tampil['kode_instansi']; ?>" class="form-control" placeholder="Masukkan kode_instansi..." autocomplete="off" autofocus></div>
                        </div> -->
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Instansi</label>
                            <div class="col-sm-9"><input type="text" name="instansi" value="<?= $tampil['instansi']; ?>" class="form-control" placeholder="Masukkan instansi..." autocomplete="off" autofocus></div>
                        </div>
                       <!--  <div class="form-group row"><label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9"><textarea name="alamat" class="form-control"><?= $tampil['alamat']; ?></textarea></div>
                        </div> -->
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
