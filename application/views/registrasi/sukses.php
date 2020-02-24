<!-- Registrasi -->
<section class="bgwhite p-t-70 p-b-100">
    <div class="container">

        <div class="pos-relative">
            <div class="bgwhite">

                <h1><?= $title ?></h1>
                <div class="clearfix"></div>
                <br><br>

                <?php if ($this->session->flashdata('sukses')) {
                    echo '<div class="alert alert-warning">';
                    echo $this->session->flashdata('sukses');
                    echo '</div>';
                } ?>

                <p class="alert alert-success">Registrasi berhasil dilakukan
                    <a href="<?= base_url('masuk') ?>" class="btn btn-info btn-sm">Login di sini.</a>
                    Anda juga bisa melakukan checkout <a href="<?= base_url('belanja/checkout') ?>" class="btn btn-warning btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</a>
                </p>

            </div>
        </div>

        <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
            <div class="flex-w flex-m w-full-sm">
            </div>
            <div class="size10 trans-0-4 m-t-10 m-b-10">
            </div>
        </div>
    </div>
</section>