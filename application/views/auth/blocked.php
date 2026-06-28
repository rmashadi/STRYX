<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ACCESS DENIED | 403</title>

    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/animate.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png') ?>">
    <link href="<?= base_url('assets/'); ?>css/security-theme.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center animated fadeInDown">
        <div class="terminal-card" style="max-width: 440px; margin: 0 auto 24px;">
            <div class="terminal-body" style="padding: 24px;">
                <div style="font-size: 5rem; font-weight: 700; color: #ff3333; line-height: 1; letter-spacing: -2px;">403</div>
                <div style="font-size: 1.1rem; color: #e2e8f0; margin-top: 8px;">ACCESS DENIED</div>
                <div style="color: #64748b; font-size: 0.8rem; margin-top: 12px;">
                    <span style="color: #ff3333;">root@stryx</span>:<span style="color: #e2e8f0;">~</span>$ <span style="color: #94a3b8;">cat /var/log/auth.log</span><br>
                    <span style="color: #ff3333;">[ERR]</span> Permission denied — insufficient privileges
                </div>
                <hr style="border-color: #2a3040; margin: 16px 0;">
                <a href="<?= base_url('auth'); ?>" class="btn btn-outline btn-primary" style="font-family: 'JetBrains Mono', monospace; font-size: 0.8rem;">
                    <i class="fa fa-arrow-left"></i> RETURN TO LOGIN
                </a>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?= base_url('assets/'); ?>js/jquery-3.1.1.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/popper.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap.js"></script>

</body>

</html>
