<style>
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

  /* Honeypot — visually hidden but NOT type=hidden (bots detect that) */
  ._honey {
      position: absolute;
      left: -9999px;
      top: -9999px;
      opacity: 0;
      height: 0;
      width: 0;
      z-index: -1;
  }
</style>

<div class="middle-box text-center animated fadeInDown">
  <div>
    <div class="terminal-card" style="max-width: 420px; margin: 0 auto 16px;">
      <div style="display: inline-block; padding: 8px 0 0 0;">
        <img alt="STRYX" src="<?= base_url('assets/img/profile/logo-stryx.png') ?>" style="max-height: 56px;" />
      </div>
      <div class="terminal-body" style="text-align: center; padding-bottom: 6px;">
        <span style="color: #00d4ff;">root@stryx</span>:<span style="color: #e2e8f0;">~</span>$ <span style="color: #94a3b8;">auth --login</span>
      </div>
    </div>
    <h4 class="font-mono" style="color: #e2e8f0;">Management Information Technology Security Assessment</h4>
    <p style="color: #64748b; font-size: 0.85rem;">Threat Response &amp; Cyber Assessment Management</p>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-12 mt-auto">
      <div class="ibox-content shadow" style="background: #11161d; border: 1px solid #2a3040; border-radius: 6px;">
        <form class="m-t" role="form" action="<?= base_url('auth'); ?>" method="POST">

          <!-- Silent security challenge -->
          <input type="hidden" name="_challenge" value="<?= $challenge ?? ''; ?>">
          <div class="_honey">
            <input type="text" name="_contact" tabindex="-1" autocomplete="off">
          </div>

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
      <small class="font-mono">v1.0 &middot; Secure Channel</small>
    </div>
  </div>
</div>
