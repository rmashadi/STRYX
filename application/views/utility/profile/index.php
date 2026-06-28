
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-4">
            <div class="widget-head-color-box p-lg text-center shadow">
                <div class="m-b-md">
                    <h2 class="font-bold no-margins">
                        My Profile
                    </h2>
                </div>
                <img  width="250" height="250" src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="rounded-circle circle-border m-b-md shadow" alt="profile">
            </div>
            <div class="widget-text-box shadow">
                <h4 class="media-heading">About</h4>
                <ul class="list-unstyled m-t-md">
                    <li>
                        <span class="fa fa-user m-r-xs"></span>
                        <label>Name :</label>
                        <?= $user['name'] ?>
                    </li>
                    <li>
                        <span class="fa fa-user-o m-r-xs"></span>
                        <label>Username :</label>
                        <?= $user['username'] ?>
                    </li>
                    <li>
                        <span class="fa fa-envelope m-r-xs"></span>
                        <label>Email:</label>
                        <?= $user['email'] ?>
                    </li>
                    <li>
                        <span class="fa fa-phone m-r-xs"></span>
                        <label>No HP:</label>
                        <?= $user['no_hp'] ?>
                    </li>
                    <li>
                        <span class="fa fa-building m-r-xs"></span>
                        <label>Instansi:</label>
                        <?= $user['instansi'] ?>
                    </li>
                    <li>
                        <span class="fa fa-suitcase m-r-xs"></span>
                        <label>Role:</label>
                        <?= $user['role'] ?>
                    </li>
                </ul>

            </div>
        </div>
        <div class="col-sm-8">
            <?php echo validation_errors('<div class="alert alert-danger shadow" role="alert"><a class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>') ?>
            <div class="ibox shadow">
                <div class="ibox-title">
                    <h5>Edit Profile</h5>
                </div>
                <div class="ibox-content">
                    <?= form_open_multipart('profile'); ?>

                    <div class="col-lg-10"><input type="hidden" name="id_user" value="<?= $user['id_user']; ?>" class="form-control"></div>

                    <div class="form-group row"><label class="col-lg-2 col-form-label">Name</label>
                        <div class="col-lg-10"><input type="text" name="name" value="<?= $user['name']; ?>" class="form-control"></div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Username</label>
                        <div class="col-lg-10"><input type="text" name="username" value="<?= $user['username']; ?>" class="form-control"></div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Email</label>
                        <div class="col-lg-10"><input type="text" name="email" value="<?= $user['email']; ?>" class="form-control"></div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">No HP</label>
                        <div class="col-lg-10"><input type="text" name="no_hp" value="<?= $user['no_hp']; ?>" class="form-control"></div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Instansi</label>
                        <div class="col-lg-10"><input type="text" name="instansi" value="<?= $user['instansi']; ?>" class="form-control"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Picture</div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col sm-8">
                                    <div class="custom-file">
                                        <input id="image" name="image" type="file" class="custom-file-input">
                                        <label for="image" class="custom-file-label">Choose file...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-outline btn-primary shadow">Edit data</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>