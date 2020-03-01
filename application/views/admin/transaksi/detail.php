<p class="pull-right">
    <div class="btn-group pull-right">
        <a href="<?= base_url('admin/transaksi/cetak/' . $header_transaksi->kode_transaksi) ?>" target="_blank" title="Cetak" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak</a>
        <a href="<?= base_url('admin/transaksi') ?>" title="Kembali" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Kembali</a>
    </div>
</p>
<div class="clearfix"></div>
<hr>

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
        <tr>
            <td>Bukti Bayar</td>
            <td>: <?php if ($header_transaksi->bukti_bayar == "") {
                        echo 'Tidak ada';
                    } else { 
                        $this->load->helper('directory');
                        $dir = 'assets/upload/image/'. $header_transaksi->kode_transaksi. '/';
                        $map = directory_map($dir);
                        foreach ($map as $k) {
                            echo '<img src="'. base_url($dir . ''. $k). '" class="img img-thumbnail" width="200">';
                        }
                    } ?>
            </td>
        </tr>
        <tr>
            <td>Tanggal Bayar</td>
            <td>: <?= date('d-m-Y', strtotime($header_transaksi->tanggal_bayar)) ?></td>
        </tr>
        <tr>
            <td>Jumlah Bayar</td>
            <td>: Rp. <?= number_format($header_transaksi->jumlah_bayar, '0', ',', '.') ?></td>
        </tr>
        <tr>
            <td>Pembayaran Dari</td>
            <td>: <?= $header_transaksi->nama_bank ?> - No. rekening <?= $header_transaksi->rekening_pembayaran ?> - a.n <?= $header_transaksi->rekening_pelanggan ?></td>
        </tr>
        <tr>
            <td>Pembayaran ke Rekening</td>
            <td>: <?= $header_transaksi->bank ?> - No. rekening <?= $header_transaksi->nomor_rekening ?> - a.n <?= $header_transaksi->nama_pemilik ?></td>
        </tr>
    </tbody>
</table>

<hr>

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