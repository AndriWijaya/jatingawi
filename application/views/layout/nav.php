<div class="wrap_header">
	<!-- Logo -->
	<a href="index.html" class="logo">
		<img src="<?= base_url('assets/upload/image/' . $site->logo) ?>" alt="<?= $site->namaweb ?> | <?= $site->tagline ?>">
	</a>

	<!-- Menu -->
	<div class="wrap_menu">
		<nav class="menu">
			<ul class="main_menu">
				<!-- Home -->
				<li>
					<a href="<?= base_url() ?>">Beranda</a>
				</li>

				<!-- Menu Produk -->
				<li>
					<a href="<?= base_url('produk') ?>">Produk &amp; Belanja</a>
					<ul class="sub_menu">
						<?php foreach ($nav_produk as $nav_produk) { ?>
							<li><a href="<?= base_url('produk/kategori/' . $nav_produk->slug_kategori) ?>">
									<?= $nav_produk->nama_kategori ?>
								</a></li>
						<?php } ?>
					</ul>
				</li>

				<li>
					<a href="<?= base_url('kontak') ?>">Contact</a>
				</li>
			</ul>
		</nav>
	</div>

	<!-- Header Icon -->
	<div class="header-icons">

		<?php if ($this->session->userdata('email')) { ?>
			<a href="<?= base_url('dashboard') ?> " class="header-wrapicon1 dis-block">
				<img src="<?= base_url('assets/template/images/icons/icon-header-01.png') ?>" class="header-icon1" alt="ICON">
				<?= $this->session->userdata('nama_pelanggan'); ?> &nbsp; &nbsp;
			</a>

			<a href="<?= base_url('masuk/logout') ?> " class="header-wrapicon1 dis-block">
				<i class="fa fa-sign-out icon-up-big"></i> Logout
			</a>

		<?php } else { ?>
			<a href="<?= base_url('registrasi') ?> " class="header-wrapicon1 dis-block">
				<img src="<?= base_url('assets/template/images/icons/icon-header-01.png') ?>" class="header-icon1" alt="ICON">
			</a>

		<?php } ?>

		<span class="linedivide1"></span>

		<div class="header-wrapicon2">

			<!-- cekk data belanja ada atau tidak	 -->
			<?php $keranjang = $this->cart->contents(); ?>

			<img src="<?= base_url('assets/template/images/icons/icon-header-02.png') ?>" class="header-icon1 js-show-header-dropdown" alt="ICON">
			<span class="header-icons-noti"><?= count($keranjang) ?></span>

			<!-- Header cart notification -->
			<div class="header-cart header-dropdown">
				<ul class="header-cart-wrapitem">

					<!-- jika tidak ada datanya -->
					<?php if (empty($keranjang)) { ?>
						<li class="header-cart-item">
							<p class="alert alert-success">Keranjang Belanja Kosong</p>
						</li>

						<!-- jika ada datanya -->
						<?php } else {
							//total belanja
							$total_belanja = 'Rp ' . number_format($this->cart->total(), '0', ',', '.');
							//tampilkan data belanja
							foreach ($keranjang as $keranjang) {
								$id_produk = $keranjang['id'];
								//ambil data produk
								$produknya = $this->produk_model->detail($id_produk);
								?>
							<li class="header-cart-item">
								<div class="header-cart-item-img">
									<img src="<?= base_url('assets/upload/image/thumbs/' . $produknya->gambar) ?>" alt="<?= $keranjang['name'] ?>">
								</div>

								<div class="header-cart-item-txt">
									<a href="<?= base_url('produk/detail/' . $produknya->slug_produk) ?>" class="header-cart-item-name">
										<?= $keranjang['name'] ?>
									</a>

									<span class="header-cart-item-info">
										<?= $keranjang['qty'] ?> x Rp <?= number_format($keranjang['price'], '0', ',', '.') ?> <br>
										Subtotal: Rp <?= number_format($keranjang['subtotal'], '0', ',', '.') ?>
									</span>
								</div>
							</li>
						<?php } ?>
					<?php } ?>
				</ul>

				<div class="header-cart-total">
					Total: <?php if (!empty($keranjang)) {
								echo $total_belanja;
							} ?>
				</div>

				<div class="header-cart-buttons">
					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?= base_url('belanja') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
							View Cart
						</a>
					</div>

					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?= base_url('belanja/checkout') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<!-- Header Mobile -->
<div class="wrap_header_mobile">
	<!-- Logo moblie -->
	<a href="index.html" class="logo-mobile">
		<img src="assets/template/images/icons/logo.png" alt="IMG-LOGO">
	</a>

	<!-- Button show menu -->
	<div class="btn-show-menu">
		<!-- Header Icon mobile -->
		<div class="header-icons-mobile">
			<a href="#" class="header-wrapicon1 dis-block">
				<img src="assets/template/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
			</a>

			<span class="linedivide2"></span>

			<div class="header-wrapicon2">

				<?php $keranjang_mobile = $this->cart->contents(); ?>

				<img src="assets/template/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
				<span class="header-icons-noti"><?= count($keranjang_mobile) ?></span>

				<!-- Header cart noti -->
				<div class="header-cart header-dropdown">
					<ul class="header-cart-wrapitem">

						<!-- jika tidak ada datanya -->
						<?php if (empty($keranjang_mobile)) { ?>
							<li class="header-cart-item">
								<p class="alert alert-success">Keranjang Belanja Kosong</p>
							</li>

							<!-- jika ada datanya -->
							<?php } else {
								//total belanja
								$total_belanja = 'Rp ' . number_format($this->cart->total(), '0', ',', '.');
								//tampilkan data belanja
								foreach ($keranjang_mobile as $keranjang_mobile) {
									$id_produk_mobile = $keranjang_mobile['id'];
									//ambil data produk
									$produknya_mobile = $this->produk_model->detail($id_produk_mobile);
									?>
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="<?= base_url('assets/upload/image/thumbs/' . $produknya_mobile->gambar) ?>" alt="<?= $keranjang_mobile['name'] ?>">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											<?= $keranjang_mobile['name'] ?>
										</a>

										<span class="header-cart-item-info">
											<?= $keranjang_mobile['qty'] ?> x Rp <?= number_format($keranjang_mobile['price'], '0', ',', '.') ?> <br>
											Subtotal: Rp <?= number_format($keranjang_mobile['subtotal'], '0', ',', '.') ?>
										</span>
									</div>
								</li>

						<?php }
						} ?>
					</ul>

					<div class="header-cart-total">
						Total: <?= $total_belanja ?>
					</div>

					<div class="header-cart-buttons">
						<div class="header-cart-wrapbtn">
							<!-- Button -->
							<a href="<?= base_url('belanja/keranjang') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
								View Cart
							</a>
						</div>

						<div class="header-cart-wrapbtn">
							<!-- Button -->
							<a href="<?= base_url('belanja') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
								Check Out
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</div>
	</div>
</div>

<!-- Menu Mobile -->
<div class="wrap-side-menu">
	<nav class="side-menu">
		<ul class="main-menu">
			<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
				<span class="topbar-child1">
			<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
				<div class="topbar-child2-mobile">
					<span class="topbar-email">
						<?= $site->email ?>
					</span>

					<div class="topbar-language rs1-select2">
						<select class="selection-1" name="time">
							<option><?= $site->telepon ?></option>
							<option><?= $site->email ?></option>
						</select>
					</div>
				</div>
			</li>

			<li class="item-topbar-mobile p-l-10">
				<div class="topbar-social-mobile">
					<a href="<?= $site->facebook ?>" class="topbar-social-item fa fa-facebook"></a>
					<a href="<?= $site->instagram ?>" class="topbar-social-item fa fa-instagram"></a>
				</div>
			</li>

			<!-- Menu mobile homepage -->
			<li class="item-menu-mobile">
				<a href="<?= base_url() ?>">Beranda</a>
			</li>

			<!-- menu mobile produk -->
			<li class="item-menu-mobile">
				<a href="<?= base_url('produk') ?>">Produk &amp; Belanja</a>
				<ul class="sub-menu">
					<?php foreach ($nav_produk_mobile as $nav_produk_mobile) { ?>
						<li><a href="<?= base_url('produk/kategori/' . $nav_produk_mobile->slug_kategori) ?>">
								<?= $nav_produk_mobile->nama_kategori ?>
							</a></li>
					<?php } ?>
				</ul>
				<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
			</li>

			<!-- menu kontak mobile -->
			<li class="item-menu-mobile">
				<a href="<?= base_url('kontak') ?>">Contact</a>
		</ul>
	</nav>
</div>
</header>