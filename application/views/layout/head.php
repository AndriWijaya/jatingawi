<?php
//load konfigurasi website
$site               = $this->konfigurasi_model->listing();
//Ambil data menu dari konfigurasi
$nav_produk         = $this->konfigurasi_model->nav_produk();
$nav_produk_mobile  = $this->konfigurasi_model->nav_produk();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <!-- icon  -->
    <link rel="icon" type="image/png/jpeg/jpg" href="<?= base_url('assets/upload/image/' . $site->icon) ?>" />
    <!-- SEO Google -->
    <meta name="keywords" content="<?= $site->keywords ?>">
    <meta name="description" content="<?= $title ?>, <?= $site->deskripsi ?> ">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/fonts/themify/themify-icons.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/fonts/elegant-font/html-css/style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/vendor/lightbox2/css/lightbox.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/css/main.css">
    <!--===============================================================================================-->

    <style type="text/css" media="screen">
        ul.pagination {
            padding: 0 10px;
            background-color: red;
            border-radius: 10px;
            text-align: bold;
        }

        .pagination a,
        .pagination b {
            padding: 10px 20px;
            text-decoration: none;
            float: left;
        }

        .pagination a {
            background-color: pink;
            color: black;
        }

        .pagination b {
            background-color: red;
            color: white;
        }

        .pagination a:hover {
            background-color: red;
        }
    </style>
</head>

<body class="animsition">