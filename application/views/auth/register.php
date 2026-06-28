<?php
  // Generate dua angka random
  $num1 = rand(1, 10);
  $num2 = rand(1, 10);
  $this->session->set_userdata('captcha_answer', $num1 + $num2); // Simpan hasil ke session
?>

<style>
  .captcha-box {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      margin-bottom: 20px;
      font-weight: bold;
      border: 1px solid #2a3040;
      padding: 10px;
      border-radius: 5px;
      background: #141923;
  }

  .captcha-box span {
      margin: 0 5px;
  }

  .captcha-answer {
      width: 100px;
      text-align: center;
      margin-left: 10px;
      padding: 5px;
      font-size: 1rem;
  }

  .middle-box {
    padding-top: 2px !important;
    color: #e2e8f0;
  }

  .middle-box h2 {
    font-family: 'JetBrains Mono', monospace;
    color: #00d4ff;
  }

  .middle-box hr {
    border-color: #2a3040;
  }

  .shadow {
      box-shadow: 0 2px 16px rgba(0, 0, 0, 0.45) !important;
  }
</style>


<div class="middle-box text-center animated fadeInDown">
  <div>
    <div class="terminal-card" style="max-width: 440px; margin: 0 auto 16px;">
      <div class="terminal-body" style="text-align: center; padding-bottom: 6px;">
        <span style="color: #00d4ff;">root@mantra</span>:<span style="color: #e2e8f0;">~</span>$ <span style="color: #94a3b8;">auth --register</span>
      </div>
    </div>
    <h2><b>Form Registrasi</b></h2>
  </div>
  <hr>
  <div class="ibox-content shadow">
    <form class="m-t" role="form" action="<?= base_url('auth/register'); ?>" method="POST">
      <?php echo validation_errors('<strong><div class="alert alert-danger shadow" role="alert">', '</div></strong>'); ?>

      <div class="form-group">
        <input type="text" class="form-control shadow" name="username" id="username" placeholder="NIP" value="<?= set_value('username'); ?>">
      </div>

      <div class="form-group">
        <input type="text" class="form-control shadow" name="name" id="name" placeholder="Full Name" value="<?= set_value('name'); ?>">
      </div>

      <div class="form-group">
        <input type="email" class="form-control shadow" name="email" id="email" placeholder="Email" value="<?= set_value('email'); ?>">
      </div>

      <div class="form-group">
        <input type="number" class="form-control shadow" name="no_hp" id="no_hp" placeholder="No Whatapp" value="<?= set_value('no_hp'); ?>">
      </div>
      <div class="form-group">
          <input list="instansiList" id="instansi" name="instansi" class="form-control shadow" placeholder="Instansi" autocomplete="off" value="<?= set_value('instansi'); ?>">
          <datalist id="instansiList"></datalist>
      </div>

      <div class="form-group position-relative">
        <input type="password" class="form-control shadow" name="password1" id="password1" placeholder="Password" autocomplete="new-password">
        <i class="fa fa-eye-slash position-absolute" id="togglePassword1" style="top: 30%; right: 20px; cursor: pointer;"></i>
      </div>

      <div class="form-group position-relative">
        <input type="password" class="form-control shadow" name="password2" id="password2" placeholder="Repeat Password" >
        <i class="fa fa-eye-slash position-absolute" id="togglePassword2" style="top: 30%; right: 20px; cursor: pointer;"></i>
      </div>

      <div class="form-group">
        <div class="captcha-box">
          <img src="<?= base_url('auth/generate_captcha') ?>" alt="Captcha" />
          <input type="text" class="captcha-answer form-control shadow" name="captcha" id="captcha">
        </div>
      </div>

      <div class="form-group text-left">
        <div class="checkbox">
          <label>
            <input type="checkbox" id="agree_terms" name="agree_terms">
            Saya setuju dengan <a href="" data-toggle="modal" data-target="#termsModal">syarat & ketentuan</a>.
          </label>
        </div>
      </div>

      <button type="submit" class="btn btn-primary btn-block m-b shadow" id="registerBtn" disabled style="font-family: 'JetBrains Mono', monospace; font-weight: 500;">[ REGISTER ]</button>
    </form>
  </div>
  <hr />
    <p style="color: #94a3b8;">Sudah punya akun? <a href="<?= base_url('auth'); ?>" style="color: #00d4ff;">Masuk</a></p>
  <hr />
  <div style="color: #64748b; font-size: 0.8rem;">
    <small class="font-mono">v1.0 &middot; Secure Registration</small>
  </div>
</div>


<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel">Syarat & Ketentuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><b>1. Kepemilikan Aset dan Penggunaan yang Tepat</b></p>
        <p>Aset/barang yang dipinjam melalui sistem ini merupakan milik instansi atau organisasi yang berwenang. Pengguna yang terdaftar setuju untuk menggunakan aset/barang tersebut sesuai dengan tujuan peminjaman yang telah disetujui dan tidak untuk kepentingan pribadi, komersial, atau ilegal.</p>
        <p><b>2. Pendaftaran dan Kewajiban Pengguna</b></p>
        <p>Pengguna yang melakukan registrasi wajib memberikan informasi yang benar, akurat, dan terkini. Informasi ini meliputi, tetapi tidak terbatas pada, data pribadi, kontak, dan tujuan peminjaman. Pengguna juga bertanggung jawab atas semua aktivitas yang dilakukan melalui akun mereka.</p>
        <p><b>3. Batasan Waktu dan Pengembalian</b></p>
        <p>Pengguna setuju untuk mengembalikan aset/barang yang dipinjam tepat waktu sesuai dengan ketentuan yang ditetapkan dalam sistem. Keterlambatan pengembalian dapat dikenakan sanksi atau denda sesuai kebijakan yang berlaku.</p>
        <p><b>4. Pemeliharaan dan Kerusakan</b></p>
        <p>Pengguna bertanggung jawab atas pemeliharaan dan pengamanan aset/barang selama periode peminjaman. Jika terjadi kerusakan atau kehilangan aset/barang selama periode peminjaman, pengguna wajib melaporkan hal tersebut dan akan dikenakan biaya ganti rugi sesuai dengan nilai aset/barang yang dipinjam.</p>
        <p><b>5. Pembatasan Akses Akun</b></p>
        <p>Setiap pengguna bertanggung jawab menjaga kerahasiaan akun dan kata sandi mereka. Pengguna setuju untuk tidak membagikan informasi login mereka kepada pihak ketiga dan bertanggung jawab penuh atas segala aktivitas yang terjadi melalui akun mereka.</p>
        <p><b>6. Kebijakan Privasi</b></p>
        <p>Data pribadi yang dikumpulkan selama proses registrasi dan penggunaan sistem akan dilindungi sesuai dengan kebijakan privasi yang berlaku. Data tersebut hanya akan digunakan untuk keperluan administrasi dan pelaporan terkait peminjaman aset/barang.</p>
        <p><b>7. Perubahan Syarat & Ketentuan</b></p>
        <p>Instansi atau organisasi berhak untuk mengubah atau memperbarui syarat & ketentuan ini sewaktu-waktu tanpa pemberitahuan sebelumnya. Pengguna diharapkan untuk secara berkala meninjau syarat & ketentuan ini agar tetap mengetahui perubahan yang mungkin berlaku.</p>
        <p><b>8. Sanksi dan Pelanggaran</b></p>
        <p>Pelanggaran terhadap syarat & ketentuan ini dapat mengakibatkan pembatasan atau penghentian hak peminjaman aset/barang, serta tindakan hukum jika diperlukan.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<script src="<?= base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.js'); ?>"></script>

<script>
    
    const agreeTerms = document.getElementById('agree_terms');
    const registerBtn = document.getElementById('registerBtn');

    agreeTerms.addEventListener('change', function () {
        registerBtn.disabled = !this.checked;
    });

    
    const modalBody = document.querySelector('.modal-body');
    modalBody.addEventListener('scroll', function () {
        if (modalBody.scrollHeight - modalBody.scrollTop === modalBody.clientHeight) {
            agreeTerms.checked = true;
            registerBtn.disabled = false;
        }
    });


    const togglePassword1 = document.querySelector('#togglePassword1');
    const password1 = document.querySelector('#password1');

    togglePassword1.addEventListener('click', function (e) {
        
        const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
        password1.setAttribute('type', type);

        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    
    const togglePassword2 = document.querySelector('#togglePassword2');
    const password2 = document.querySelector('#password2');

    togglePassword2.addEventListener('click', function (e) {
        
        const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
        password2.setAttribute('type', type);

        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    $(document).ready(function() {
        $('#instansi').on('input', function() {
            var keyword = $(this).val();

            if (keyword.length >= 3) {
                $.ajax({
                    url: '<?= base_url('auth/get_instansi'); ?>',
                    method: 'POST',
                    data: { keyword: keyword },
                    success: function(response) {
                        var data = JSON.parse(response);
                        var options = '';

                        if (data.length > 0) {
                            data.forEach(function(item) {
                                options += '<option value="' + item.instansi + '"></option>';
                            });
                        } else {
                            options = '<option value="Tidak ditemukan. Ketik manual..."></option>';
                        }

                        $('#instansiList').html(options);
                    }
                });
            }
        });
    });
</script>

