<table class="table table-bordered table-responsive" width="100%">
    <thead>
        <tr class="bg-success text-sm">
            <th class="text-center">NO</th>
            <th class="text-center">PELANGGAN</th>
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
                <td><?= $header_transaksi->nama_pelanggan ?>
                    <br><small>
                        Telepon: <?= $header_transaksi->telepon ?>
                        <br>Email: <?= $header_transaksi->email ?>
                        <br>Alamat Kirim: <br> <?= nl2br($header_transaksi->alamat) ?>
                    </small>
                </td>
                <td class="text-center"><?= $header_transaksi->kode_transaksi ?></td>
                <td class="text-center"><?= date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi)) ?></td>
                <td class="text-center"><?= number_format($header_transaksi->jumlah_transaksi, '0', ',', '.') ?></td>
                <td class="text-center"><?= $header_transaksi->total_item ?></td>
                <td><?= $header_transaksi->status_bayar ?></td>
                <td>
                    <div class="btn-group">
                        <a href="<?= base_url('penjual/transaksi/detail/' . $header_transaksi->kode_transaksi) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Detail</a>
                        <a href="<?= base_url('penjual/transaksi/cetak/' . $header_transaksi->kode_transaksi) ?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak</a>
                        <a href="<?= base_url('penjual/transaksi/status/' . $header_transaksi->kode_transaksi) ?>" class="btn btn-warning btn-sm"><i class="fa fa-check"></i> Update Status</a>
                    </div>
                </td>
            </tr>
        <?php $i++;
        } ?>
    </tbody>
</table>