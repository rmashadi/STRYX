<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/animate.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/security-theme.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/plugins/toastr/toastr.min.css'); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/plugins/select2/select2.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/plugins/chosen/bootstrap-chosen.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/plugins/dataTables/datatables.min.css') ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/css/plugins/datapicker/datepicker3.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.min.css"/>
    
</head>

<style type="text/css">
    .form-group-with-border {
        border-bottom: 1px solid var(--border-light, #2a3040);
        padding-bottom: 15px;
        margin-bottom: 15px;
    }

    .form-group-with-border:last-child {
        border-bottom: none;
    }

    .chosen-container .chosen-single {
        height: 33px;
        line-height: 33px;
    }

    .chosen-container .chosen-single div b {
        top: 50%;
    }

    .chosen-container .chosen-single span {
        line-height: 33px;
    }

    .form-control {
        border-radius: 4px;
    }

    th.center-checkbox {
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    th.center-checkbox .select-all-checkbox {
        margin: 0;
        transform: none;
    }
</style>

<body>
    <div id="wrapper">