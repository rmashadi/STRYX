<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div style="border:1px solid #ff3333; border-left:4px solid #ff3333; padding-left:20px; margin:0 0 10px 0; background: rgba(255,51,51,0.06); border-radius: 4px; color: #e2e8f0;">

<h4 style="color: #ff3333; font-family: 'JetBrains Mono', monospace;">A PHP Error was encountered</h4>

<p style="color: #94a3b8;">Severity: <span style="color: #ffb700; font-family: 'JetBrains Mono', monospace;"><?php echo $severity; ?></span></p>
<p style="color: #94a3b8;">Message:  <span style="color: #e2e8f0;"><?php echo $message; ?></span></p>
<p style="color: #94a3b8;">Filename: <span style="color: #ffb700; font-family: 'JetBrains Mono', monospace; font-size: 12px;"><?php echo $filepath; ?></span></p>
<p style="color: #94a3b8;">Line Number: <span style="color: #00d4ff; font-family: 'JetBrains Mono', monospace;"><?php echo $line; ?></span></p>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

    <p style="color: #94a3b8;">Backtrace:</p>
    <?php foreach (debug_backtrace() as $error): ?>

        <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

            <p style="margin-left:10px; color: #64748b; font-family: 'JetBrains Mono', monospace; font-size: 12px;">
            File: <span style="color: #ffb700;"><?php echo $error['file'] ?></span><br />
            Line: <span style="color: #00d4ff;"><?php echo $error['line'] ?></span><br />
            Function: <span style="color: #e2e8f0;"><?php echo $error['function'] ?></span>
            </p>

        <?php endif ?>

    <?php endforeach ?>

<?php endif ?>

</div>
