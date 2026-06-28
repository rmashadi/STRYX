<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <?php echo validation_errors('<div class="alert alert-danger shadow" role="alert"><a class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>') ?>
            <div class="ibox shadow">
                <div class="ibox-title">
                    <a class="btn btn-outline btn-primary shadow" href="" data-toggle="modal" data-target="#addData">Tambah Data</a>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables">
                            <thead>
                                <tr align="center">
                                    <th>#.</th>
                                    <th>Nama Instansi</th>
                                    <th>Nama Aplikasi</th>
                                    <th>Alamat URL DEV</th>
                                    <th>Alamat URL Publish</th>
                                    <th>Tahun Pembuatan</th>
                                    <th>Pengembang</th>
                                    <th>Platform</th>
                                    <th>Jenis Subdomain/Aplikasi</th>
                                    <th>Data Geospasial/Peta</th>
                                    <th>Data Pribadi</th>
                                    <th>Kategori Aplikasi</th>
                                    <th>Deskripsi Singkat Aplikasi</th>
                                    <th>Daftar Layanan</th>
                                    <th>Data yang Diolah</th>
                                    <th>Daftar Produk Layanan</th>
                                    <th>Ketersediaan API</th>
                                    <th>Ketersediaan SDM</th>
                                    <th>Tanggal Launching</th>
                                    <th>Status Aplikasi</th>
                                    <th><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; foreach ($domain as $tampil): $no++ ?>
                                <tr>
                                    <td align="center"><?= $no; ?></td>
                                        <td><?= $tampil['instansi']; ?></td>
                                        <td><?= $tampil['nama_aplikasi']; ?></td>
                                         <td><?= $tampil['alamat_url_dev']; ?></td>
                                        <td><?= $tampil['alamat_url_publish']; ?></td>
                                       <!--  <td><a href="<?= $tampil['alamat_url_dev'] ?>" target="_blank">Dev Link</a></td>
                                        <td><a href="<?= $tampil['alamat_url_publish'] ?>" target="_blank">Prod Link</a></td> -->
                                        <td><?= $tampil['tahun_pembuatan']; ?></td>
                                        <td><?= $tampil['pengembang']; ?></td>
                                        <td><?= $tampil['id_platform']; ?></td>
                                        <td><?= $tampil['jns_subdomain']; ?></td>
                                        <td><?= $tampil['status_geopasial']; ?></td>
                                        <td><?= $tampil['status_pribadi']; ?></td>
                                        <td><?= $tampil['kat_aplikasi']; ?></td>
                                        <td><?= $tampil['deskripsi_singkat']; ?></td>
                                        <td><?= $tampil['daftar_layanan']; ?></td>
                                        <td><?= $tampil['data_yang_diolah']; ?></td>
                                        <td><?= $tampil['daftar_produk']; ?></td>
                                        <td><?= $tampil['status_api']; ?></td>
                                        <td><?= $tampil['status_sdm']; ?></td>
                                        <td><?= $tampil['tanggal_launching']; ?></td>
                                        <td><?= $tampil['status_apl']; ?></td>
                                    <td>
                                        <div class="btn-group shadow">
                                            <button data-toggle="dropdown" class="btn btn-info btn-outline dropdown-toggle">Tindakan</button>
                                            <ul class="dropdown-menu shadow">
                                                <li><a class="dropdown-item" href="#modalEdit<?= $tampil['id_domain'] ?>" data-toggle="modal"><i class="glyphicon glyphicon-pencil"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="<?= base_url('domain/delete/') . $tampil['id_domain'] ?>" onclick="return confirm('Yakin menghapus data <?= $tampil['nama_aplikasi']; ?>?');"><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach ?>
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
                <h5 class="modal-title">Tambah Data Domain</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form class="form-horizontal" method="POST" action="<?php echo base_url('domain') ?>">
                <div class="modal-body">
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Instansi</label>
                        <div class="col-sm-9">
                            <select name="id_instansi" class="form-control">
                                <option value="">-- Pilih Instansi --</option>
                                <?php foreach ($instansi as $ins) : ?>
                                    <option value="<?= $ins['id_instansi']; ?>"><?= $ins['instansi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Nama Aplikasi</label>
                        <div class="col-sm-9"><input type="text" name="nama_aplikasi" class="form-control" placeholder="Masukkan nama aplikasi..." autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Alamat url Dev</label>
                         <div class="col-sm-9"><input type="text" name="alamat_url_dev" class="form-control" placeholder="Masukkan Alamat url dev..." autocomplete="off" autofocus></div>
                    </div>
                     <div class="form-group row"><label class="col-sm-3 col-form-label">Alamat url Publish</label>
                        <div class="col-sm-9"><input type="text" name="alamat_url_publish" class="form-control" placeholder="Masukkan alamat url publish..." autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Tahun Pembuatan</label>
                        <div class="col-sm-9"><input type="text" name="tahun_pembuatan" class="form-control" placeholder="Contoh: 2025" pattern="\d{4}" title="Masukkan 4 digit tahun" maxlength="4"></div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Pengembang</label>
                        <div class="col-sm-9"><input type="text" name="pengembang" class="form-control" placeholder="Masukkan pengembang..." autocomplete="off" autofocus></div>
                    </div>
                    <!-- === Platform Checkbox === -->
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Platform</label>
                            <div class="col-sm-9">
                                <?php $platforms = ['Website', 'Mobile']; ?>
                                <?php foreach ($platforms as $p): ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="id_platform[]" value="<?= $p ?>">
                                        <label class="form-check-label"><?= $p ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jenis Subdomain</label>
                        <div class="col-sm-9">
                            <select name="id_jns_subdomain" class="form-control">
                                <option value="">-- Pilih Jenis Subdomain --</option>
                                <?php foreach ($subdomain as $subdomains) : ?>
                                    <option value="<?= $subdomains['id_jns_subdomain']; ?>"><?= $subdomains['jns_subdomain']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data Geopasial</label>
                        <div class="col-sm-9">
                            <select name="id_geopasial" class="form-control">
                                <option value="">-- Pilih Data Geopasial --</option>
                                <?php foreach ($geopasial as $geopasials) : ?>
                                    <option value="<?= $geopasials['id_geopasial']; ?>"><?= $geopasials['status_geopasial']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Data Pribadi</label>
                        <div class="col-sm-9">
                            <select name="id_pribadi" class="form-control">
                                <option value="">-- Pilih Data Pribadi --</option>
                                <?php foreach ($pribadi as $pribadis) : ?>
                                    <option value="<?= $pribadis['id_pribadi']; ?>"><?= $pribadis['status_pribadi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kategori Aplikasi</label>
                        <div class="col-sm-9">
                            <select name="id_kat_aplikasi" class="form-control">
                                <option value="">-- Pilih Kategori Aplikasi --</option>
                                <?php foreach ($kat_aplikasi as $kataplikasis) : ?>
                                    <option value="<?= $kataplikasis['id_kat_aplikasi']; ?>"><?= $kataplikasis['kat_aplikasi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Deskripsi Singkat</label>
                        <div class="col-sm-9"><textarea name="deskripsi_singkat" class="form-control" placeholder="Masukkan deskripsi singkat..."></textarea></div>
                    </div>
                     <div class="form-group row"><label class="col-sm-3 col-form-label">Daftar Layanan</label>
                        <div class="col-sm-9"><input type="text" name="daftar_layanan" class="form-control" placeholder="Masukkan daftar layanan..." autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Data yang diolah</label>
                        <div class="col-sm-9"><input type="text" name="data_yang_diolah" class="form-control" placeholder="Masukkan data yang diolah..." autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row"><label class="col-sm-3 col-form-label">Daftar Produk</label>
                         <div class="col-sm-9"><input type="text" name="daftar_produk" class="form-control" placeholder="Masukkan daftar produk..." autocomplete="off" autofocus></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Ketersediaan API</label>
                        <div class="col-sm-9">
                            <select name="id_status_api" class="form-control">
                                <option value="">-- Pilih Ketersediaan API --</option>
                                <?php foreach ($status_api as $apis) : ?>
                                    <option value="<?= $apis['id_status_api']; ?>"><?= $apis['status_api']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Ketersediaan SDM</label>
                        <div class="col-sm-9">
                            <select name="id_status_sdm" class="form-control">
                                <option value="">-- Pilih Ketersediaan SDM --</option>
                                <?php foreach ($status_sdm as $sdmes) : ?>
                                    <option value="<?= $sdmes['id_status_sdm']; ?>"><?= $sdmes['status_sdm']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Launching</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggal_launching" class="form-control" placeholder="Masukkan tanggal launching...">
                        </div>
                    </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status Aplikasi</label>
                        <div class="col-sm-9">
                            <select name="id_status_sdm" class="form-control">
                                <option value="">-- Pilih Status Aplikasi --</option>
                                <?php foreach ($status_aplikasi as $aplks) : ?>
                                    <option value="<?= $aplks['id_status_apl']; ?>"><?= $aplks['status_apl']; ?></option>
                                <?php endforeach; ?>
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


<!-- ==================================  MODAL EDIT  ========================================= -->
<?php foreach ($domain as $tampil) : ?>

    <?php
    $platforms = ['Website', 'Mobile'];
    $selected_platforms = explode(',', $tampil['id_platform']);
?>

    <div id="modalEdit<?php echo $tampil['id_domain'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Domain</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form class="form-horizontal" method="post" action="<?php echo base_url('domain/Edit') ?>">
                    <div class="modal-body">
                        <input name="id_domain" type="hidden" value="<?php echo $tampil['id_domain']; ?>">
                   
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Instansi</label>
                            <div class="col-sm-9">
                                <select name="id_instansi" class="form-control">
                                    <option value="">-- Pilih Instansi --</option>
                                    <?php foreach ($instansi as $instansis) : ?>
                                        <option value="<?= $instansis['id_instansi']; ?>" <?= ($instansis['id_instansi'] == $tampil['id_instansi']) ? 'selected' : ''; ?>><?= $instansis['instansi']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row"><label class="col-sm-3 col-form-label">Nama Aplikasi</label>
                            <div class="col-sm-9"><input type="text" name="nama_aplikasi" value="<?= $tampil['nama_aplikasi']; ?>" class="form-control" placeholder="Masukkan nama aplikasi..." autocomplete="off" autofocus></div>
                        </div>
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Alamat url Dev</label>
                            <div class="col-sm-9"><input type="text" name="alamat_url_dev" value="<?= $tampil['alamat_url_dev']; ?>" class="form-control" placeholder="Masukkan nama aplikasi..." autocomplete="off" autofocus></div>
                        </div>
                         <div class="form-group row"><label class="col-sm-3 col-form-label">Alamat url Publish</label>
                            <div class="col-sm-9"><input type="text" name="alamat_url_publish" value="<?= $tampil['alamat_url_publish']; ?>" class="form-control" placeholder="Masukkan alamat url publish..." autocomplete="off" autofocus></div>
                        </div>
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Tahun Pembuatan</label>
                            <div class="col-sm-9"><input type="text" name="tahun_pembuatan" value="<?= $tampil['tahun_pembuatan']; ?>" class="form-control" placeholder="Masukkan tahun pembuatan..." autocomplete="off" autofocus></div>
                        </div>
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Pengembang</label>
                            <div class="col-sm-9"><input type="text" name="pengembang" value="<?= $tampil['pengembang']; ?>" class="form-control" placeholder="Masukkan tahun pembuatan..." autocomplete="off" autofocus></div>
                          
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Platform</label>
                            <div class="col-sm-9">
                                <?php foreach ($platforms as $p): ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="id_platform[]" value="<?= $p ?>" 
                                            <?= in_array($p, $selected_platforms) ? 'checked' : '' ?>>
                                        <label class="form-check-label"><?= $p ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Subdomain</label>
                            <div class="col-sm-9">
                                <select name="id_jns_subdomain" class="form-control">
                                    <option value="">-- Pilih Jenis Subdomain --</option>
                                    <?php foreach ($subdomain as $subdomains) : ?>
                                         <option value="<?= $subdomains['id_jns_subdomain']; ?>" <?= ($subdomains['id_jns_subdomain'] == $tampil['id_jns_subdomain']) ? 'selected' : ''; ?>><?= $subdomains['jns_subdomain']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Data Geopasial</label>
                            <div class="col-sm-9">
                                <select name="id_geopasial" class="form-control">
                                    <option value="">-- Pilih Data Geopasial --</option>
                                    <?php foreach ($geopasial as $geopasials) : ?>
                                          <option value="<?= $geopasials['id_geopasial']; ?>" <?= ($geopasials['id_geopasial'] == $tampil['id_geopasial']) ? 'selected' : ''; ?>><?= $geopasials['status_geopasial']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Data Pribadi</label>
                            <div class="col-sm-9">
                                <select name="id_pribadi" class="form-control">
                                    <option value="">-- Pilih Data Pribadi --</option>
                                    <?php foreach ($pribadi as $pribadis) : ?>
                                         <option value="<?= $pribadis['id_pribadi']; ?>" <?= ($pribadis['id_pribadi'] == $tampil['id_pribadi']) ? 'selected' : ''; ?>><?= $pribadis['status_pribadi']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kategori Aplikasi</label>
                            <div class="col-sm-9">
                                <select name="id_kat_aplikasi" class="form-control">
                                    <option value="">-- Pilih Kategori Aplikasi --</option>
                                    <?php foreach ($kat_aplikasi as $kataplikasis) : ?>
                                         <option value="<?= $kataplikasis['id_kat_aplikasi']; ?>" <?= ($kataplikasis['id_kat_aplikasi'] == $tampil['id_kat_aplikasi']) ? 'selected' : ''; ?>><?= $kataplikasis['kat_aplikasi']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Deskripsi Singkat</label>
                             <div class="col-sm-9"><textarea name="deskripsi_singkat" class="form-control"><?= $tampil['deskripsi_singkat']; ?></textarea></div>
                        </div>
                         <div class="form-group row"><label class="col-sm-3 col-form-label">Daftar Layanan</label>
                            <div class="col-sm-9"><input type="text" name="daftar_layanan" value="<?= $tampil['daftar_layanan']; ?>" class="form-control" placeholder="Masukkan daftar layanan..." autocomplete="off" autofocus></div>
                        </div>
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Data yang diolah</label>
                            <div class="col-sm-9"><input type="text" name="data_yang_diolah" value="<?= $tampil['data_yang_diolah']; ?>" class="form-control" placeholder="Masukkan data yang diolah..." autocomplete="off" autofocus></div>
                        </div>
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Daftar Produk</label>
                            <div class="col-sm-9"><input type="text" name="daftar_produk" value="<?= $tampil['daftar_produk']; ?>" class="form-control" placeholder="Masukkan daftar produk..." autocomplete="off" autofocus></div>
                            
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ketersediaan API</label>
                            <div class="col-sm-9">
                                <select name="id_status_api" class="form-control">
                                    <option value="">-- Pilih Ketersediaan API --</option>
                                    <?php foreach ($status_api as $apis) : ?>
                                          <option value="<?= $apis['id_status_api']; ?>" <?= ($apis['id_status_api'] == $tampil['id_status_api']) ? 'selected' : ''; ?>><?= $apis['status_api']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ketersediaan SDM</label>
                            <div class="col-sm-9">
                                <select name="id_status_sdm" class="form-control">
                                    <option value="">-- Pilih Ketersediaan SDM --</option>
                                    <?php foreach ($status_sdm as $sdmes) : ?>
                                          <option value="<?= $sdmes['id_status_sdm']; ?>" <?= ($sdmes['id_status_sdm'] == $tampil['id_status_sdm']) ? 'selected' : ''; ?>><?= $sdmes['status_sdm']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Launching</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal_launching" class="form-control" value="<?= $tampil['tanggal_launching'] ?>">
                            </div>
                        </div>
                         <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status Aplikasi</label>
                        <div class="col-sm-9">
                            <select name="id_status_apl" class="form-control">
                                <option value="">-- Pilih Status Aplikasi --</option>
                                <?php foreach ($status_aplikasi as $aplks) : ?>
                                    <option value="<?= $aplks['id_status_apl']; ?>" <?= ($aplks['id_status_apl'] == $tampil['id_status_apl']) ? 'selected' : ''; ?>><?= $aplks['status_apl']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
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