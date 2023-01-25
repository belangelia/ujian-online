<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" href="<?= base_url() ?>/public/asset/mts.png" />
	<link rel="icon" href="<?php echo base_url() ?>/public/tinydash-master/light/favicon.ico">
	<title>Ujian-Online Mts Belinyu</title>
	<!-- Simple bar CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/simplebar.css">
	<!-- Fonts CSS -->
	<link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<!-- Icons CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/feather.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/select2.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/dropzone.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/uppy.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/quill.snow.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/jquery.steps.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/jquery.timepicker.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/quill.snow.css">
	<!-- Data Tables CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/dataTables.bootstrap4.css">
	<!-- Date Range Picker CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/daterangepicker.css">
	<!-- App CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/dropzone.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/app-light.css" id="lightTheme" disabled>
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/app-dark.css" id="darkTheme">
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
	<style>
		:root {
			--barsamping: #3C6255;
			--dasartengah: #61876E;
			--primer: #3C6255;
			--kedua: #61876E;
			--ketiga: #A6BB8D;
			--keempat: #EAE7B1;
			--kelima: #E5E5CB;
			--keenam: #939B62;
			--baratas: white;
		}

		body {
			font-family: Verdana, Geneva, Tahoma, sans-serif;
		}

		.simplebar-content-wrapper {
			background-color: var(--barsamping);
		}

		aside {
			background-color: var(--primer);
		}

		.wrapper {
			background-color: white;
		}

		.navbar {
			background-color: var(--barsamping);
		}

		.topnav {
			background-color: var(--baratas);
		}

		.btn {
			background-color: var(--ketiga);
			box-shadow: none;
			border: none;
		}

		.btn:hover {
			background-color: var(--keempat);

		}

		.small {
			text-transform: uppercase;
			font-weight: bold;
		}

		.navbar-nav {
			text-transform: uppercase;
			font-weight: bold;
		}

		.navbar-light .navbar-nav .nav-link:hover {
			background: var(--kedua);
			color: var(--ketiga);
			border-radius: 0.2rem;
		}

		.main-content .row .card {
			background-color: var(--ketiga);
		}

		.main-content .row .card-body {
			background-color: white;
		}

		.main-content .row .card-body .circle {
			background-color: var(--keempat);
		}

		.main-content .row .card-body .circle .text-white,
		.welcome {
			color: black !important;
		}

		.main-content .row .col mark {
			font-weight: bold;
			text-transform: uppercase;
		}

		.main-content .angka {
			color: black !important;
		}

		/* data */
		.custom-select,
		.form-control {
			background-color: var(--primer);
		}


		div.dataTables_wrapper div.dataTables_filter label,
		div.dataTables_wrapper div.dataTables_length label,
		div.dataTables_wrapper div.dataTables_paginate ul.pagination a {
			color: black;
		}

		.page-item.active .page-link {
			background-color: var(--keenam) !important;
		}

		div.dataTables_wrapper div.dataTables_length label,
		div.dataTables_wrapper div.dataTables_info {
			display: none;
		}

		.table,
		.table thead th,
		.dropdown-item {
			color: black;
		}

		.table thead th {
			background-color: var(--keenam);
			text-transform: uppercase;
			font-weight: bold;
		}

		.dropdown-menu {
			background-color: white;
			border-color: var(--primer);
		}

		.dashboard {
			background-color: var(--keenam) !important;
		}

		.modal-content {
			background-color: white !important;
			color: black;
		}

		.form-control,
		.form-control:focus {
			background-color: white;
			color: black !important;

		}

		.table {
			overflow: auto;
		}

		.h5,
		.notif {
			color: black !important;
		}

		.tab-content>.active {
			margin: auto !important;
		}

		.table-wrap {
			max-height: 400px;
			overflow: auto;
			display: inline-block;
		}

		/* .so {
			display: block;
		}

		.banksoal td {
			max-height: 100px;
			width: 100%;
			overflow-y: auto;
			overflow-x: hidden;
		}

		.banksoal td:nth-child(1) {
			width: 10%;
		}

		.banksoal td:nth-child(2) {
			width: 80%;
		}

		.banksoal .td:nth-child(3) {
			width: 10%;
		} */

		.col-form-label {
			color: black;
		}

		.main-content .delay {
			background-color: #DC0000;
		}

		.main-content .berjalan {
			background-color: #379237;
		}

		.main-content .selesai {
			background-color: #FF8B13;
		}

		.text-one,
		strong {
			color: black;
			font-weight: 300;
		}

		.akun {
			color: black;

		}

		.bg-tt,
		.bg-tt td:hover {
			background-color: var(--keempat);
			color: black;
			font-weight: bold;
		}

		.bg-tt td dl dt {
			background-color: var(--keenam);
		}

		.note-editor.note-frame .note-editing-area {
			color: white;
		}

		.tambah-soal .row .card-body,
		.tambah-opsi #collapseOne .card-body,
		.tambah-opsi #collapseTwo .card-body,
		.tambah-opsi #collapseThree .card-body,
		.tambah-opsi #collapseFour .card-body,
		.tambah-opsi #collapseFive .card-body {
			background-color: white;
		}

		.tambah-soal .row .card-body .btn,
		.tambah-opsi #collapseOne .card-body .btn,
		.tambah-opsi #collapseTwo .card-body .btn,
		.tambah-opsi #collapseThree .card-body .btn,
		.tambah-opsi #collapseFour .card-body .btn,
		.tambah-opsi #collapseFive .card-body .btn {
			background-color: var(--ketiga);
			color: white;
		}

		.tambah-soal .row .card-body a,
		.tambah-opsi #collapseOne .card-body a,
		.tambah-opsi #collapseTwo .card-body a,
		.tambah-opsi #collapseThree .card-body a,
		.tambah-opsi #collapseFour .card-body a,
		.tambah-opsi #collapseFive .card-body a {
			color: white;
		}

		.note-editor.note-frame .note-editing-area {
			color: black;
		}

		.nilai {
			background-color: var(--dasartengah) !important;
			color: white;
		}
	</style>
</head>

<body class="vertical  dark  ">
	<div class="wrapper">
		<nav class="topnav navbar navbar-light">
			<button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
				<i class="fe fe-menu navbar-toggler-icon"></i>
			</button>
		</nav>