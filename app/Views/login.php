<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="<?php echo base_url() ?>/public/tinydash-master/light/favicon.ico">
	<link rel="icon" type="image/png" href="<?= base_url() ?>/public/asset/mts.png" />

	<title>LOGIN</title>

	<!-- Simple bar CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/simplebar.css">
	<!-- Fonts CSS -->
	<link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<!-- Icons CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/feather.css">
	<!-- Date Range Picker CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/daterangepicker.css">
	<!-- App CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/app-light.css" id="lightTheme" disabled>
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/app-dark.css" id="darkTheme">
	<style>
		:root {
			--primer: #3C6255;
			--kedua: #61876E;
			--ketiga: #A6BB8D;
			--keempat: #EAE7B1;
		}

		body {
			background-color: var(--primer);
			/* warna background login */
		}

		.btn-primary {
			background-color: var(--ketiga);
			/* warna background tombol login */
			border-color: var(--keempat);
			/* warna background  border login*/
		}

		.btn-primary:active {
			background-color: var(--ketiga) !important;
			border: none !important;

		}

		.btn-primary:hover {
			background-color: var(--keempat);
			box-shadow: none;
			border: none;
			/* warna background  tomobl saat mouse diarahkan ke tombol*/
		}

		.form-control {
			background-color: white;
			/* warna background  kolom input username dan password*/
			color: black !important;
			border: 1px solid var(--keempat);
			/* warna background  border kolom input username dan password*/

		}

		.form-control:focus {
			background-color: white;
			/* warna background kolom input username dan username saat mengetik inputan */
			box-shadow: 0 0 0 0.2rem var(--ketiga);
			/* warna background border kolom input username dan username saat mengetik inputan */

		}

		.form-control-lg::placeholder {
			color: black;
			/* warna background placeholder  */

			opacity: 0.5;
			/* transparan placeholder*/
		}

		input:-internal-autofill-selected {
			appearance: menulist-button;
			background-image: none !important;
			background-color: -internal-light-dark #000000 !important;
			/* warna saat mengetik inputan username dan password*/
			color: fieldtext !important;
		}
	</style>
</head>

<body class="dark ">
	<div class="wrapper vh-100">
		<div class="row align-items-center h-100">
			<form class="col-lg-3 col-md-4 col-10 mx-auto text-center" method="post" action="<?php echo base_url() ?>/Login/user">
				<img src="<?= base_url() ?>/public/asset/mts.png" class="card-img-top img-fluid rounded" alt="mts-al istiqmah">

				</img>
				<?php
				if (Session()->get('error')) : ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?= Session()->getFlashdata('error') ?><button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif; ?>
				<h1 class="h3 mb-3">Masuk</h1>
				<div class="form-group">
					<label for="username" class="sr-only">Username</label>
					<input type="text" id="username" class="form-control form-control-lg" placeholder="Username" required="" autofocus="" name="username">
				</div>
				<div class="form-group">
					<label for="inputPassword" class="sr-only">Password</label>
					<input type="password" id="inputPassword" class="form-control form-control-lg" placeholder="Password" required="" name="password">
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
				<p class="mt-3 mb-3 text-muted">© MTS AL - ISTIQOMAH</p>
			</form>
		</div>
	</div>
	<script src="<?php echo base_url() ?>/public/public/tinydash-master/light/js/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>/public/public/tinydash-master/light/js/popper.min.js"></script>
	<script src="<?php echo base_url() ?>/public/public/tinydash-master/light/js/moment.min.js"></script>
	<script src="<?php echo base_url() ?>/public/public/tinydash-master/light/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>/public/public/tinydash-master/light/js/simplebar.min.js"></script>
	<script src='js/daterangepicker.js'></script>
	<script src='js/jquery.stickOnScroll.js'></script>
	<script src="<?php echo base_url() ?>/public/public/tinydash-master/light/js/tinycolor-min.js"></script>
	<script src="<?php echo base_url() ?>/public/public/tinydash-master/light/js/config.js"></script>
	<script src="<?php echo base_url() ?>/public/public/tinydash-master/light/js/apps.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'UA-56159088-1');
	</script>
</body>

</html>
</body>

</html>