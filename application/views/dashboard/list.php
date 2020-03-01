<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <!--  -->
                    <?php include('menu.php') ?>
                </div>
            </div>

            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                <?php
                //Notifikasi
                if ($this->session->flashdata('sukses')) {
                    echo '<div class="alert alert-warning alert-dismisable">';
                    echo '<a href="#" aria-label="close" class="close" data-dismiss="alert">&times;</a>';
                    echo $this->session->flashdata('sukses');
                    echo '</div>';
                }
                ?>
                <div class="alert alert-success">
                    <h1>Selamat Datang
                        <i><strong><?= $this->session->userdata('nama_pelanggan'); ?></i></strong>
                    </h1>
                </div>


                <?php
                //Jika ada transaksi, tampilkan tabel riwayatnya
                if ($header_transaksi) { ?>

                    <table class="table table-bordered table-responsive" width="100%">
                        <thead>
                            <tr class="bg-success text-sm">
                                <th class="text-center">NO</th>
                                <th class="text-center">KODE</th>
                                <th class="text-center">TANGGAL</th>
                                <th class="text-center">HARGA</th>
                                <th class="text-center">JUMLAH ITEM</th>
                                <th class="text-center">STATUS BAYAR</th>
                                <th class="text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?PHP $i = 1;
                                foreach ($header_transaksi as $header_transaksi) { ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td class="text-center"><?= $header_transaksi->kode_transaksi ?></td>
                                    <td class="text-center"><?= date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi)) ?></td>
                                    <td class="text-center"><?= number_format($header_transaksi->jumlah_transaksi, '0', ',', '.') ?></td>
                                    <td class="text-center"><?= $header_transaksi->total_item ?></td>
                                    <td class="text-center"><?= $header_transaksi->status_bayar ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?= base_url('dashboard/detail/' . $header_transaksi->kode_transaksi) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Detail</a>
                                            &nbsp;
                                            <a href="<?= base_url('dashboard/konfirmasi/' . $header_transaksi->kode_transaksi) ?>" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> Konfirmasi</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php $i++;
                                } ?>
                        </tbody>
                    </table>

                <?php
                    //Jika tidak ada tampilkan notifikasi
                } else { ?>
                    <p class="alert alert-warning">
                        <i class="fa fa-warning"></i> Belum ada data riwayat belanja
                    </p>

                <?php } ?>

            </div>
        </div>
    </div>
</section>