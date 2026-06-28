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
                                    <th>Jenis Serangan 1</th>
                                    <th>Jumlah</th>
                                    <th>Jenis Serangan 2</th>
                                    <th>Jumlah</th>
                                    <th>Jenis Serangan 3</th>
                                    <th>Jumlah</th>
                                    <th>Jenis Serangan 4</th>
                                    <th>Jumlah</th>
                                    <th>Jenis Serangan 5</th>
                                    <th>Jumlah</th>
                                    <th>User Input</th>
                                    <th><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($catatanjenis as $tampil) : $no++ ?>
                                    <tr align="center">
                                        <td><?= $no; ?></td>
                                        <td><?= $tampil['tanggal']; ?></td>
                                        <td><?= $tampil['jenis_serangan_1']; ?></td>
                                        <td><?= $tampil['jumlah_1']; ?></td>
                                        <td><?= $tampil['jenis_serangan_2']; ?></td>
                                        <td><?= $tampil['jumlah_2']; ?></td>
                                        <td><?= $tampil['jenis_serangan_3']; ?></td>
                                        <td><?= $tampil['jumlah_3']; ?></td>
                                        <td><?= $tampil['jenis_serangan_4']; ?></td>
                                        <td><?= $tampil['jumlah_4']; ?></td>
                                        <td><?= $tampil['jenis_serangan_5']; ?></td>
                                        <td><?= $tampil['jumlah_5']; ?></td>
                                        <td><?= $tampil['user_input']; ?></td>
                                        <td>
                                            <div class="btn-group shadow">
                                                <button data-toggle="dropdown" class="btn btn-info btn btn-outline dropdown-toggle">Tindakan</button>
                                                <ul class="dropdown-menu shadow">
                                                    <li><a class="dropdown-item" href="#modalEdit<?= $tampil['id_catatan_jenis'] ?>" data-toggle="modal" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="<?= base_url('catatanjenis/delete/') . $tampil['id_catatan_jenis'] ?>" onclick="return confirm('Yakin menghapus data <?= $tampil['catatanjenis']; ?>?');"><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
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
                <h5 class="modal-title">Tambah Pencatatan Berdasar jenis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form class="form-horizontal" method="POST" action="<?php echo base_url('catatanjenis') ?>">
                <div class="modal-body">
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-9"><input type="date" name="tanggal" class="form-control" placeholder="Masukkan tanggal..." autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">jenis serangan 1</label>
                        <div class="col-sm-9">
                            <select name="jenis_serangan_1" class="form-control">
                                <option value="">-- Pilih serangan --</option>
                                <?php foreach ($jenisserangan as $serangans1) : ?>
                                    <option value="<?= $serangans1['id_jenis_serangan']; ?>"><?= $serangans1['jenis_serangan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-9"><input type="text" name="jumlah_1" class="form-control" placeholder="Masukkan jumlah..." autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">jenis serangan 2</label>
                        <div class="col-sm-9">
                            <select name="jenis_serangan_2" class="form-control">
                                <option value="">-- Pilih serangan --</option>
                                <?php foreach ($jenisserangan as $serangans2) : ?>
                                    <option value="<?= $serangans2['id_jenis_serangan']; ?>"><?= $serangans2['jenis_serangan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-9"><input type="text" name="jumlah_2" class="form-control" placeholder="Masukkan jumlah..." autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">jenis serangan 3</label>
                        <div class="col-sm-9">
                            <select name="jenis_serangan_3" class="form-control">
                                <option value="">-- Pilih serangan --</option>
                                <?php foreach ($jenisserangan as $serangans3) : ?>
                                    <option value="<?= $serangans3['id_jenis_serangan']; ?>"><?= $serangans3['jenis_serangan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-9"><input type="text" name="jumlah_3" class="form-control" placeholder="Masukkan jumlah..." autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">jenis serangan 4</label>
                        <div class="col-sm-9">
                            <select name="jenis_serangan_4" class="form-control">
                                <option value="">-- Pilih serangan --</option>
                                <?php foreach ($jenisserangan as $serangans4) : ?>
                                    <option value="<?= $serangans4['id_jenis_serangan']; ?>"><?= $serangans4['jenis_serangan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-9"><input type="text" name="jumlah_4" class="form-control" placeholder="Masukkan jumlah..." autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">jenis serangan 5</label>
                        <div class="col-sm-9">
                            <select name="jenis_serangan_5" class="form-control">
                                <option value="">-- Pilih serangan --</option>
                                <?php foreach ($jenisserangan as $serangans5) : ?>
                                    <option value="<?= $serangans5['id_jenis_serangan']; ?>"><?= $serangans5['jenis_serangan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-9"><input type="text" name="jumlah_5" class="form-control" placeholder="Masukkan jumlah..." autocomplete="off" autofocus></div>
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
<?php foreach ($catatanjenis as $tampil) : ?>
    <div id="modalEdit<?php echo $tampil['id_catatan_jenis'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h5 class="modal-title">Edit  Pencatatan Berdasar Jenis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form class="form-horizontal" method="post" action="<?php echo base_url('catatanjenis/Edit') ?>">
                    <div class="modal-body">
                        <input name="id_catatan_jenis" type="hidden" value="<?php echo $tampil['id_catatan_jenis']; ?>">

                        <div class="form-group row"><label class="col-sm-3 col-form-label">tanggal</label>
                            <div class="col-sm-9"><input type="date" name="tanggal" value="<?= $tampil['tanggal']; ?>" class="form-control" placeholder="Masukkan tanggal..." autocomplete="off" autofocus></div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">jenis serangan 1</label>
                            <div class="col-sm-9">
                                 <select name="id_jenis_serangan_1" class="form-control">
                                    <option value="">-- Pilih serangan --</option>
                                    <?php foreach ($jenisserangan as $row) : ?>
                                        <option value="<?= $row['id_jenis_serangan']; ?>"
                                            <?= ($row['id_jenis_serangan'] == $tampil['id_jenis_serangan_1']) ? 'selected' : ''; ?>>
                                            <?= $row['jenis_serangan']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                         <div class="form-group row"><label class="col-sm-3 col-form-label">jumlah</label>
                            <div class="col-sm-9"><input type="text" name="jumlah_1" value="<?= $tampil['jumlah_1']; ?>" class="form-control" placeholder="Masukkan jumlah..." autocomplete="off" autofocus></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">jenis serangan 2</label>
                            <div class="col-sm-9">
                                 <select name="id_jenis_serangan_2" class="form-control">
                                    <option value="">-- Pilih serangan --</option>
                                    <?php foreach ($jenisserangan as $row) : ?>
                                        <option value="<?= $row['id_jenis_serangan']; ?>"
                                            <?= ($row['id_jenis_serangan'] == $tampil['id_jenis_serangan_2']) ? 'selected' : ''; ?>>
                                            <?= $row['jenis_serangan']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                         <div class="form-group row"><label class="col-sm-3 col-form-label">jumlah</label>
                            <div class="col-sm-9"><input type="text" name="jumlah_2" value="<?= $tampil['jumlah_2']; ?>" class="form-control" placeholder="Masukkan jumlah..." autocomplete="off" autofocus></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">jenis serangan 3</label>
                            <div class="col-sm-9">
                                 <select name="id_jenis_serangan_3" class="form-control">
                                    <option value="">-- Pilih serangan --</option>
                                    <?php foreach ($jenisserangan as $row) : ?>
                                        <option value="<?= $row['id_jenis_serangan']; ?>"
                                            <?= ($row['id_jenis_serangan'] == $tampil['id_jenis_serangan_3']) ? 'selected' : ''; ?>>
                                            <?= $row['jenis_serangan']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                         <div class="form-group row"><label class="col-sm-3 col-form-label">jumlah</label>
                            <div class="col-sm-9"><input type="text" name="jumlah_3" value="<?= $tampil['jumlah_3']; ?>" class="form-control" placeholder="Masukkan jumlah..." autocomplete="off" autofocus></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">jenis serangan 4</label>
                            <div class="col-sm-9">
                                 <select name="id_jenis_serangan_4" class="form-control">
                                    <option value="">-- Pilih serangan --</option>
                                    <?php foreach ($jenisserangan as $row) : ?>
                                        <option value="<?= $row['id_jenis_serangan']; ?>"
                                            <?= ($row['id_jenis_serangan'] == $tampil['id_jenis_serangan_4']) ? 'selected' : ''; ?>>
                                            <?= $row['jenis_serangan']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                         <div class="form-group row"><label class="col-sm-3 col-form-label">jumlah</label>
                            <div class="col-sm-9"><input type="text" name="jumlah_4" value="<?= $tampil['jumlah_4']; ?>" class="form-control" placeholder="Masukkan jumlah..." autocomplete="off" autofocus></div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">jenis serangan 5</label>
                            <div class="col-sm-9">
                                 <select name="id_jenis_serangan_5" class="form-control">
                                    <option value="">-- Pilih serangan --</option>
                                    <?php foreach ($jenisserangan as $row) : ?>
                                        <option value="<?= $row['id_jenis_serangan']; ?>"
                                            <?= ($row['id_jenis_serangan'] == $tampil['id_jenis_serangan_5']) ? 'selected' : ''; ?>>
                                            <?= $row['jenis_serangan']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                         <div class="form-group row"><label class="col-sm-3 col-form-label">jumlah</label>
                            <div class="col-sm-9"><input type="text" name="jumlah_5" value="<?= $tampil['jumlah_5']; ?>" class="form-control" placeholder="Masukkan jumlah..." autocomplete="off" autofocus></div>
                        </div>
                         
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-outline">Edit Data</button>
                        <button class="btn btn-secondary btn-outline" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
