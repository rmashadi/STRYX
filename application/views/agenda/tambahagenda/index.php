<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <?php echo validation_errors('<div class="alert alert-danger shadow" role="alert"><a class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>') ?>
            <div class="ibox shadow">
                <div class="card shadow mb-12">
                <div class="card-body">
                    <form method="POST" action="<?= base_url('tambahagenda') ?>">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="tgl_mulai">Tanggal Agenda / Acara</label>
                                    <input type="date" name="tanggal" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn btn-primary btn-sm">Cari Agenda / Acara</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            <div class="ibox shadow">
                <div class="ibox-title"><a class="btn btn-outline btn-primary shadow" href="" data-toggle="modal" data-target="#addData">Tambah Data</a></div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th width="20%">Acara</th>
                                    <th>Tanggal</th>
                                    <th>Jam Mulai</th>
                                    <th>Tempat</th>
                                    <th>Pelaksana</th>
                                    <th>Yang Menghadiri</th>
                                    <th>Keterangan</th>
                                    <th>Bagian</th>
                                    <!-- <th>Penginput</th> -->
                                    <th><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                if(!empty($agenda)) {
                                foreach ($agenda as $tampil) {
                                $no++ ?>
                                    <tr align="left">
                                        <td><?= $no; ?></td>
                                        <td><?= $tampil['acara']; ?></td>
                                        <td><?= $tampil['tanggal']; ?></td>
                                        <td><?= $tampil['jam_mulai']; ?></td>
                                        <td><?= $tampil['tempat']; ?></td>
                                        <td><?= $tampil['pelaksana']; ?></td>
                                        <td><?= $tampil['menghadiri']; ?></td>
                                        <td><?= $tampil['keterangan']; ?></td>
                                        <td><?php
                                        if ($tampil['penerima'] == '01') {
                                            echo "Sekretariat Daerah";
                                        } elseif ($tampil['penerima'] == '01.02') {
                                            echo "Asisten Pemerintahan dan Kesejahteraan Rakyat";
                                        } elseif ($tampil['penerima'] == '01.03') {
                                            echo "Asisten Perekonomian dan Pembangunan";
                                        } elseif ($tampil['penerima'] == '01.04') {
                                            echo "Asisten Administrasi Umum";
                                        } elseif ($tampil['penerima'] == '01.05') {
                                            echo "Bagian Pemerintahan Sekretariat Daerah";
                                        } elseif ($tampil['penerima'] == '01.06') {
                                            echo "Bagian Kesejahteraan Rakyat Sekretariat Daerah";
                                        } elseif ($tampil['penerima'] == '01.07') {
                                            echo "Bagian Hukum Sekretariat Daerah";
                                        } elseif ($tampil['penerima'] == '01.11') {
                                            echo "Bagian Organisasi Sekretariat Daerah";
                                        } elseif ($tampil['penerima'] == '01.12') {
                                            echo "Bagian Umum Sekretariat Daerah";
                                        } elseif ($tampil['penerima'] == '01.14') {
                                            echo "Bagian Perekonomian Sekretariat Daerah";
                                        } elseif ($tampil['penerima'] == '01.15') {
                                            echo "Bagian Pembangunan Sekretariat Daerah";
                                        } elseif ($tampil['penerima'] == '01.16') {
                                            echo "Bagian Layanan Pengadaan Sekretariat Daerah";
                                        } elseif ($tampil['penerima'] == '01.17') {
                                            echo "Bagian Hubungan Masyarakat dan Protokol Sekretariat Daerah";
                                        } else {
                                            echo "Kode tidak ditemukan";
                                        }?></td>
                                        <!-- <td><?= $tampil['user_input']; ?></td> -->
                                        <td>
                                            <div class="btn-group shadow">
                                                <button data-toggle="dropdown" class="btn btn-info btn btn-outline dropdown-toggle">Tindakan</button>
                                                <ul class="dropdown-menu shadow">
                                                    <!-- <li><a class="dropdown-item" href="#modalEdit<?= $tampil['id_kondisi'] ?>" data-toggle="modal" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit</a></li> -->
                                                    <li><a class="dropdown-item" href="<?= base_url('tambahagenda/delete/') . $tampil['id_agenda'] ?>" onclick="return confirm('Yakin menghapus data <?= $tampil['acara']; ?>?');"><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
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
                <h5 class="modal-title">Tambah Agenda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form class="form-horizontal" method="POST" action="<?php echo base_url('tambahagenda/addagenda') ?>">
                <div class="modal-body">
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Acara/Agenda</label>
                        <div class="col-sm-9"><input type="text" name="acara" class="form-control" placeholder="Masukkan Acara" autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Tgl. Acara</label>
                        <div class="col-sm-9"><input type="date" name="tanggal" class="form-control"></div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Jam</label>
                        <div class="col-sm-9"><input type="time" name="jam_mulai" class="form-control"></div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Tempat</label>
                        <div class="col-sm-9"><input type="text" name="tempat" class="form-control" placeholder="Masukkan Tempat" autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Pelaksana</label>
                        <div class="col-sm-9"><input type="text" name="pelaksana" class="form-control" placeholder="Masukkan Pelaksana Kegiatan" autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Yang Menghadiri</label>
                        <div class="col-sm-9"><input type="text" name="menghadiri" class="form-control" placeholder="Masukkan Yang Menghadiri" autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9"><textarea name="keterangan" class="form-control" placeholder="Masukkan Keterangan"></textarea></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Instansi / OPD</label>
                        <div class="col-sm-9">
                            <select name="penerima" class="form-control">
                                <option value="">-- Pilih Bagian / OPD --</option>
                                <option value="01">Sekretariat Daerah</option>
                                <option value="01.02">Asisten Pemerintahan dan Kesejahteraan Rakyat</option>
                                <option value="01.03">Asisten Perekonomian dan Pembangunan</option>
                                <option value="01.04">Asisten Administrasi Umum</option>
                                <option value="01.05">Bagian Pemerintahan Sekretariat Daerah</option>
                                <option value="01.06">Bagian Kesejahteraan Rakyat Sekretariat Daerah</option>
                                <option value="01.07">Bagian Hukum Sekretariat Daerah</option>
                                <option value="01.11">Bagian Organisasi Sekretariat Daerah</option>
                                <option value="01.12">Bagian Umum Sekretariat Daerah</option>
                                <option value="01.14">Bagian Perekonomian Sekretariat Daerah</option>
                                <option value="01.15">Bagian Pembangunan Sekretariat Daerah</option>
                                <option value="01.16">Bagian Layanan Pengadaan Sekretariat Daerah</option>
                                <option value="01.17">Bagian Hubungan Masyarakat dan Protokol Sekretariat Daerah</option>
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
