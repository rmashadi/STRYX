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
                                    <th>Tanggal</th>
                                    <th>Jumlah Serangan High</th>
                                     <th>Jumlah Serangan Medium</th>
                                     <th>Jumlah Serangan Low</th>
                                    <th>User Input</th>
                                    <th><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($catatanlevel as $tampil) : $no++ ?>
                                    <tr align="center">
                                        <td><?= $no; ?></td>
                                        <td><?= $tampil['tanggal']; ?></td>
                                        <td><?= $tampil['jumlah_serangan_high']; ?></td>
                                         <td><?= $tampil['jumlah_serangan_medium']; ?></td>
                                        <td><?= $tampil['jumlah_serangan_low']; ?></td>
                                        <td><?= $tampil['user_input']; ?></td>
                                        <td>
                                            <div class="btn-group shadow">
                                                <button data-toggle="dropdown" class="btn btn-info btn btn-outline dropdown-toggle">Tindakan</button>
                                                <ul class="dropdown-menu shadow">
                                                    <li><a class="dropdown-item" href="#modalEdit<?= $tampil['id_catatan_level'] ?>" data-toggle="modal" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="<?= base_url('catatanlevel/delete/') . $tampil['id_catatan_level'] ?>" onclick="return confirm('Yakin menghapus data <?= $tampil['catatanlevel']; ?>?');"><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
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
                <h5 class="modal-title">Tambah Pencatatan Berdasar Level</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form class="form-horizontal" method="POST" action="<?php echo base_url('catatanlevel') ?>">
                <div class="modal-body">
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-9"><input type="date" name="tanggal" class="form-control" placeholder="Masukkan tanggal..." autocomplete="off" autofocus></div>
                    </div>
                   <div class="form-group row"><label class="col-sm-3 col-form-label">Jumlah Serangan High</label>
                        <div class="col-sm-9"><input type="text" name="jumlah_serangan_high" class="form-control" placeholder="Masukkan jumlah serangan high..." autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Jumlah Serangan Medium</label>
                        <div class="col-sm-9"><input type="text" name="jumlah_serangan_medium" class="form-control" placeholder="Masukkan jumlah serangan medium..." autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Jumlah Serangan Low</label>
                        <div class="col-sm-9"><input type="text" name="jumlah_serangan_low" class="form-control" placeholder="Masukkan jumlah serangan low..." autocomplete="off" autofocus></div>
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
<?php foreach ($catatanlevel as $tampil) : ?>
    <div id="modalEdit<?php echo $tampil['id_catatan_level'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h5 class="modal-title">Edit  Pencatatan Berdasar Level</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form class="form-horizontal" method="post" action="<?php echo base_url('catatanlevel/Edit') ?>">
                    <div class="modal-body">
                        <input name="id_catatan_level" type="hidden" value="<?php echo $tampil['id_catatan_level']; ?>">

                        <div class="form-group row"><label class="col-sm-3 col-form-label">tanggal</label>
                            <div class="col-sm-9"><input type="date" name="tanggal" value="<?= $tampil['tanggal']; ?>" class="form-control" placeholder="Masukkan tanggal..." autocomplete="off" autofocus></div>
                        </div>
                         <div class="form-group row"><label class="col-sm-3 col-form-label">jumlah serangan high</label>
                            <div class="col-sm-9"><input type="text" name="jumlah_serangan_high" value="<?= $tampil['jumlah_serangan_high']; ?>" class="form-control" placeholder="Masukkan jumlah serangan high..." autocomplete="off" autofocus></div>
                        </div>
                         <div class="form-group row"><label class="col-sm-3 col-form-label">jumlah serangan medium</label>
                            <div class="col-sm-9"><input type="text" name="jumlah_serangan_medium" value="<?= $tampil['jumlah_serangan_medium']; ?>" class="form-control" placeholder="Masukkan jumlah serangan medium..." autocomplete="off" autofocus></div>
                        </div>
                         <div class="form-group row"><label class="col-sm-3 col-form-label">jumlah serangan low</label>
                            <div class="col-sm-9"><input type="text" name="jumlah_serangan_low" value="<?= $tampil['jumlah_serangan_low']; ?>" class="form-control" placeholder="Masukkan jumlah serangan low..." autocomplete="off" autofocus></div>
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
