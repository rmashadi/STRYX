<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox shadow">
			    <div class="ibox-content">
			        <div class="container mt-5">
			            <h3><?= $title; ?></h3>
			            <div class="form-group">
			                <label for="user">Pilih User</label>
			                <select name="user_id" id="user" class="form-control chosen-select">
			                    <option value="">-- Pilih User --</option>
			                    <?php foreach ($users as $user) : ?>
			                        <option value="<?= $user['id_user']; ?>">
			                            <?= $user['name']; ?>
			                        </option>
			                    <?php endforeach; ?>
			                </select>
			            </div>

			            <div id="aset-container" style="display: none;">
			                <form id="userAsetForm" action="<?= base_url('useraset/updateAset'); ?>" method="post">
			                    <input type="hidden" name="user_id" id="selectedUser" value="">

			                    <div class="row mt-4">
								    <div class="col-md-5">
								        <h5>Aset Tersedia</h5>
								        <input type="text" id="search-available" class="form-control mb-2" placeholder="Cari Aset Tersedia">
								        <hr class="my-2">
								        <table class="table table-bordered" id="availableAsetTable">
								            <thead>
								                <tr>
								                    <th class="center-checkbox">
													    <input type="checkbox" id="select-all-available" class="form-check-input select-all-checkbox">
													</th>
								                    <th>Nama Aset</th>
								                </tr>
								            </thead>
								            <tbody id="availableAset"></tbody>
								        </table>
								    </div>
								    <div class="col-md-2 text-center">
								        <h5>&nbsp;</h5>
								        <i class="fa fa-exchange fa-2x"></i>
								    </div>
								    <div class="col-md-5">
								        <h5>Aset Dipilih</h5>
								        <input type="text" id="search-selected" class="form-control mb-2" placeholder="Cari Aset Dipilih">
								        <hr class="my-2">
								        <table class="table table-bordered" id="selectedAsetTable">
								            <thead>
								                <tr>
								                    <th class="center-checkbox">
								                    	<input type="checkbox" id="select-all-selected" class="form-check-input select-all-checkbox">
								                    </th>
								                    <th>Nama Aset</th>
								                </tr>
								            </thead>
								            <tbody id="selectedAset"></tbody>
								        </table>
								    </div>
								</div>

			                    <button type="submit" class="btn btn-success mt-3">Simpan Perubahan</button>
			                </form>
			            </div>
			        </div>
			    </div>
			</div>

        </div>
    </div>
</div>




