<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>

      <!-- Menu Transaksi -->
      <li><a href="<?= base_url('penjual/transaksi') ?>"><i class="fa fa-check text-aqua"></i> <span>TRANSAKSI</span></a></li>

      <!-- Menu Produk -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-sitemap"></i> <span>PRODUK</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?= base_url('penjual/produk') ?>"><i class="fa fa-table"></i> Data Produk</a></li>
          <li><a href="<?= base_url('penjual/produk/tambah') ?>"><i class="fa fa-plus "></i> Tambah Produk</a></li>
        </ul>
      </li>

      <li><a href="<?= base_url('penjual/user') ?>"><i class="fa fa-user"></i> <span>PROFIL SAYA</span></a></li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $title ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Data tables</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">