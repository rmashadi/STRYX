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
      color: #e2e8f0;
  }

  .middle-box h1 {
      font-family: 'JetBrains Mono', monospace;
      color: #00d4ff;
  }

  hr {
      border-color: #2a3040;
  }

  .shadow {
      box-shadow: 0 2px 16px rgba(0, 0, 0, 0.45) !important;
  }
</style>

<div class="middle-box text-center animated fadeInDown">
  <div>
    <div class="terminal-card" style="max-width: 420px; margin: 0 auto 16px;">
      <div style="display: inline-block; padding: 8px 0 0 0;">
        <img alt="logo" src="<?= base_url('assets/img/profile/logo-mantra2.png') ?>" style="max-height: 56px;" />
      </div>
      <div class="terminal-body" style="text-align: center; padding-bottom: 6px;">
        <span style="color: #00d4ff;">root@mantra</span>:<span style="color: #e2e8f0;">~</span>$ <span style="color: #94a3b8;">auth --login</span>
      </div>
    </div>
    <h4 class="font-mono" style="color: #e2e8f0;">Management Information Technology Security Assessment</h4>
    <p style="color: #64748b; font-size: 0.85rem;">Tatakelola Layanan ITSA dan Insiden Siber<br>Pemerintah Daerah Kabupaten Sleman</p>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-12 mt-auto">
      <div class="ibox-content shadow" style="background: #11161d; border: 1px solid #2a3040; border-radius: 6px;">
        <form class="m-t" role="form" action="<?= base_url('auth'); ?>" method="POST">
          <?php if ($this->session->flashdata('message') == TRUE) : ?>
            <strong style="color: #ff3333;"><?= $this->session->flashdata('message'); ?></strong>
          <?php endif; ?>
          <?php echo validation_errors('<strong><div class="alert alert-danger shadow" role="alert">', '</div></strong>') ?>
          <div class="form-group">
            <input type="username" class="form-control shadow" name="username" id="username" placeholder="Username" style="background: #141923; border-color: #2a3040; color: #e2e8f0;">
          </div>
          <div class="form-group">
            <input type="password" class="form-control shadow" name="password" id="password" placeholder="Password" style="background: #141923; border-color: #2a3040; color: #e2e8f0;">
          </div>

          <div class="form-group">
            <div class="captcha-box">
              <img src="<?= base_url('auth/generate_captcha') ?>" alt="Captcha" />
              <input type="text" class="captcha-answer form-control shadow" name="captcha" id="captcha" style="background: #141923; border-color: #2a3040; color: #e2e8f0;">
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-block m-b shadow" style="font-family: 'JetBrains Mono', monospace; font-weight: 500;">[ AUTHENTICATE ]</button>
      </div>

      <div class="text-center mt-3">
        <!-- <p>Belum punya akun? <a href="<?= base_url('auth/register'); ?>">Daftar sekarang</a></p> -->
      </div>
    </div>
  </div>
  <hr />
  <div class="row">
    <div class="col-md-12" style="color: #64748b; font-size: 0.8rem;">
      <small>Pemerintah Kabupaten Sleman &copy; <?= date('Y') ?></small>
      <br><small class="font-mono">v1.0 &middot; Secure Channel</small>
    </div>
  </div>
</div>
