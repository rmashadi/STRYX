<?php
  // Generate dua angka random
  $num1 = rand(1, 10);
  $num2 = rand(1, 10);
  $this->session->set_userdata('captcha_answer', $num1 + $num2); // Simpan hasil ke session
?>

<style>
.wrimagecard{  
  margin-top: 0;
    margin-bottom: 1.5rem;
    text-align: left;
    position: relative;
    background: #fff;
    box-shadow: 12px 15px 20px 0px rgba(46,61,73,0.15);
    border-radius: 4px;
    transition: all 0.3s ease;
}
.wrimagecard .fa{
  position: relative;
    font-size: 70px;
}
.wrimagecard-topimage_header{
padding: 20px;
}
a.wrimagecard:hover, .wrimagecard-topimage:hover {
    box-shadow: 2px 4px 8px 0px rgba(46,61,73,0.2);
}
.wrimagecard-topimage a {
    width: 100%;
    height: 100%;
    display: block;
}
.wrimagecard-topimage_title {
    padding: 20px 24px;
    height: 110px;
    padding-bottom: 0.50rem;
    position: relative;
}
.wrimagecard-topimage a {
    border-bottom: none;
    text-decoration: none;
    color: #525c65;
    transition: color 0.3s ease;
}


</style>
<div class="container">
  <div class="row">
    <div class="col-md-9 text-center mx-auto animated fadeInDown">
            <div>
              <h1 class="logo-name"></h1>
              <br><br>
              <img alt="image" src="<?= base_url('assets/img/profile/logo-sleman.png') ?>" />
              <h2><b>Sistem Terpadu</b></h2>
              <h3>Sekretariat Daerah Kabupaten Sleman</h3>
            </div>
            <br><br>

            <div class="row">

            <div class="col-md-4 mt-auto">
              <div class="ibox-content shadow">
                  <div class="form-group">
                    <div class="wrimagecard wrimagecard-topimage">
                        <a href="login">
                        <div class="wrimagecard-topimage_header" style="background-color: rgba(22, 160, 133, 0.1) ">
                          <center><i class="fa fa-building" style="color:#16A085"></i></center>
                        </div>
                        <div class="wrimagecard-topimage_title text-center">
                          <h4>SAT SET SLEMASSET</h4>
                          <p>Sistem Pengelolaan Aset Sleman yang Efektif dan Transparan</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <!-- <button type="submit" class="btn btn-primary btn btn-outline block full-width m-b shadow">Login</button> -->
              </div>
            </div>

            <div class="col-md-4 mt-auto">
              <div class="ibox-content shadow">
                  <div class="form-group">
                    <div class="wrimagecard wrimagecard-topimage">
                        <a href="surat">
                        <div class="wrimagecard-topimage_header" style="background-color: rgba(187, 120, 36, 0.1) ">
                          <center><i class="fa fa-envelope" style="color:#fabc09"></i></center>
                        </div>
                        <div class="wrimagecard-topimage_title text-center">
                          <h4>SURAT SEKRETARIAT</h4>
                          <p>Pencarian Surat Sekretariat Daerah Kabupaten Sleman</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <!-- <button type="submit" class="btn btn-primary btn btn-outline block full-width m-b shadow">Login</button> -->
              </div>
            </div>

            <div class="col-md-4 mt-auto">
              <div class="ibox-content shadow">
                  <div class="form-group">
                    <div class="wrimagecard wrimagecard-topimage">
                        <a href="agenda">
                        <div class="wrimagecard-topimage_header" style="background-color:rgba(51, 105, 232, 0.1) ">
                          <center><i class="fa fa-table" style="color:#3369e8"></i></center>
                        </div>
                        <div class="wrimagecard-topimage_title text-center">
                          <h4>AGENDA PIMPINAN</h4>
                          <p>Daftar Agenda Pimpinan Kabupaten Sleman</p>
                        </div>
                      </a>
                    </div>
                  </div>
                  <!-- <button type="submit" class="btn btn-primary btn btn-outline block full-width m-b shadow">Login</button> -->
              </div>
            </div>
          </div>

          <hr />
          <div class="row">
            <div class="col-md-12 text-right">
              <small>STRYX &copy; <?= date('Y') ?></small>
            </div>
          </div>
  </div>
 </div>
</div>