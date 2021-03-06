<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-<?= $header_transaksi->kode_transaksi ?>">
    <i class="fa fa-trash-o"></i> Hapus
</button>

<div class="modal fade" id="delete-<?= $header_transaksi->kode_transaksi ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">HAPUS DATA TRANSAKSI</h4>
            </div>
            <div class="modal-body">
                <div class="callout callout-danger">
                    <h4>Peringatan!</h4>
                    Apakah anda yakin menghapus data transaksi ini? Data yang telah dihapus tidak dapat dikembalikan!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Kembali</button>
                <a href="<?= base_url('admin/transaksi/delete/' . $header_transaksi->kode_transaksi) ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus Data</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->