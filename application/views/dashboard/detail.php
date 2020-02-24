<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-2 col-lg-3 p-b-50">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <!--  -->
                    <?php include('menu.php') ?>
                </div>
            </div>

            <div class="col-sm-7 col-md-10 col-lg-9 p-b-50">
                <h1><?= $title ?></h1>
                <hr>

                <?php
                //Jika ada transaksi, tampilkan tabel riwayatnya
                if ($header_transaksi) { ?>

                    <table class="table table-bordered table-responsive" width="100%">
                        <thead>
                            <tr>
                                <th width="20%">KODE TRANSAKSI</th>
                                <th>: <?= $header_transaksi->kode_transaksi ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tanggal</td>
                                <td>: <?= date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi)) ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Total</td>
                                <td>: <?= number_format($header_transaksi->jumlah_transaksi, '0', ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td>Status Bayar</td>
                                <td>: <?= $header_transaksi->status_bayar ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered table-responsive" width="100%">
                        <thead>
                            <tr class="bg-success text-sm">
                                <th class="text-center">NO</th>
                                <th class="text-center">KODE</th>
                                <th class="text-center">NAMA PRODUK</th>
                                <th class="text-center">HARGA</th>
                                <th class="text-center">JUMLAH</th>
                                <th class="text-center">SUB TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?PHP $i = 1;
                                foreach ($transaksi as $transaksi) { ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td class="text-center"><?= $transaksi->kode_produk ?></td>
                                    <td class="text-center"><?= $transaksi->nama_produk ?></td>
                                    <td class="text-center">Rp <?= number_format($transaksi->harga, '0', ',', '.') ?></td>
                                    <td class="text-center"><?= $transaksi->jumlah ?></td>
                                    <td class="text-center">Rp <?= number_format($transaksi->total_harga, '0', ',', '.') ?></td>
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