<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<style type="text/css">

::selection { background-color: #00d4ff; color: #0a0e14; }
::-moz-selection { background-color: #00d4ff; color: #0a0e14; }

body {
    background-color: #0a0e14;
    margin: 40px;
    font: 13px/20px normal -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: #e2e8f0;
}

a {
    color: #00d4ff;
    background-color: transparent;
    font-weight: normal;
}

h1 {
    color: #e2e8f0;
    background-color: transparent;
    border-bottom: 1px solid #2a3040;
    font-family: 'JetBrains Mono', 'Fira Code', monospace;
    font-size: 16px;
    font-weight: 500;
    margin: 0 0 14px 0;
    padding: 14px 15px 10px 15px;
}

code {
    font-family: 'JetBrains Mono', 'Fira Code', Consolas, monospace;
    font-size: 12px;
    background-color: #141923;
    border: 1px solid #2a3040;
    color: #00d4ff;
    display: block;
    margin: 14px 0 14px 0;
    padding: 12px 10px 12px 10px;
}

#container {
    margin: 10px;
    border: 1px solid #2a3040;
    background: #11161d;
    border-radius: 6px;
    box-shadow: 0 2px 16px rgba(0, 0, 0, 0.4);
}

p {
    margin: 12px 15px 12px 15px;
    color: #94a3b8;
}
</style>
</head>
<body>
    <div id="container">
        <h1><?php echo $heading; ?></h1>
        <?php echo $message; ?>
    </div>
</body>
</html>
