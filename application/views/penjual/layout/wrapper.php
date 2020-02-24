<?php
//Proteksi halaman admin dengan fungsi cek_login yang ada di Simple_login
$this->simple_login->cek_login();

//Menggabungkan semua bagian layout
require('head.php');
require('header.php');
require('nav.php');
require('content.php');
require('footer.php');
