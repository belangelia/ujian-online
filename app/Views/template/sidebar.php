<?php
$admin = session()->get('role_users')['role'] === 'admin';
$guru = session()->get('role_users')['role'] === 'Guru';
$murid = session()->get('role_users')['role'] === 'Peserta';
?>
<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
	<a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
		<i class="fe fe-x"><span class="sr-only"></span></i>
	</a>
	<nav class="vertnav navbar navbar-light">
		<!-- nav bar -->
		<div class="w-100 mb-1 d-flex justify-content-center">
			<img src="<?= base_url() ?>/public/asset/mts.png" class="circle circle-lg  my-4">
			</img>
		</div>
		<ul class="navbar-nav flex-fill w-100 mb-2 disabled">
			<li class="nav-item	">
				<a href="<?php echo base_url() ?>/Home" class="nav-link">
					<i class="fe fe-home fe-16"></i>
					<span class="ml-3 item-text">Dashboard</span>
				</a>
			</li>
		</ul>
		<p class="text-muted nav-heading mt-4 mb-1">
			<span>Menu</span>
		</p>
		<ul class="navbar-nav flex-fill w-100 mb-2">
			<?php if ($admin) : ?>
				<li class="nav-item dropdown">
					<a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
						<i class="fe fe-layers fe-16"></i>
						<span class="ml-3 item-text">Master Data</span>
					</a>
					<ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
						<!-- <li class="nav-item">
							<a class="nav-link pl-3" href="<?php echo base_url() ?>/MasterData/viewRole"><span class="ml-1 item-text">Role Penggunga</span>
							</a>
						</li> -->
						<li class="nav-item">
							<a class="nav-link pl-3" href="<?php echo base_url() ?>/MasterData/viewKelas"><span class="ml-1 item-text">Kelas</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link pl-3" href="<?php echo base_url() ?>/MasterData/viewMapel"><span class="ml-1 item-text">Mata Pelajaran</span></a>
						</li>
					</ul>
				</li>
				<li class="nav-item w-100">
					<a class="nav-link" href="<?php echo base_url() ?>/Test/viewTest">
						<i class="fe fe-book-open fe-16"></i>
						<span class="ml-3 item-text">Data Ujian</span>
						<!-- <span class="badge badge-pill badge-primary">New</span> -->
					</a>
				</li>
				<li class="nav-item w-100">
					<a class="nav-link" href="<?php echo base_url() ?>/Guru/viewGuru">
						<i class="fe fe-users fe-16"></i>
						<span class="ml-3 item-text">Daftar Guru</span>
						<!-- <span class="badge badge-pill badge-primary">New</span> -->
					</a>
				</li>
				<li class="nav-item w-100">
					<a class="nav-link" href="<?php echo base_url() ?>/Murid/viewMurid">
						<i class="fe fe-users fe-16"></i>
						<span class="ml-3 item-text">Daftar Murid</span>
						<!-- <span class="badge badge-pill badge-primary">New</span> -->
					</a>
				</li>

			<?php endif; ?>
			<?php if ($murid) : ?>
				<li class="nav-item w-100">
					<a class="nav-link" href="<?php echo base_url() ?>/Test/viewExamStudent">
						<i class="fe fe-users fe-16"></i>
						<span class="ml-3 item-text">Ujian-ku</span>
						<!-- <span class="badge badge-pill badge-primary">New</span> -->
					</a>
				</li>
			<?php endif; ?>
			<?php if ($guru) : ?>
				<li class="nav-item dropdown">
					<a href="#profile" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
						<i class="fe fe-user fe-16"></i>
						<span class="ml-3 item-text">Kelas-ku</span>
					</a>
					<ul class="collapse list-unstyled pl-4 w-100" id="profile">
						<a class="nav-link pl-3" href="<?php echo base_url() ?>/Guru/myStudent"><span class="ml-1">Murid Kelas</span></a>
						<a class="nav-link pl-3" href="<?php echo base_url() ?>/Guru/myStudentScore"><span class="ml-1">Data Nlai Murid Kelas</span></a>

					</ul>
				</li>
				<li class="nav-item dropdown">
					<a href="#contact" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
						<i class="fe fe-book fe-16"></i>
						<span class="ml-3 item-text">Ujian-ku</span>
					</a>
					<ul class="collapse list-unstyled pl-4 w-100" id="contact">
						<a class="nav-link pl-3" href="<?php echo base_url() ?>/Test/viewTest"><span class="ml-1">Data Ujian</span></a>
						<a class="nav-link pl-3" href="<?php echo base_url() ?>/Guru/myTestScore"><span class="ml-1">Data Nilai Ujian</span></a>
					</ul>
				</li>
			<?php endif; ?>

		</ul>


		<div class="btn-box w-100 mt-4 mb-1">
			<a href="<?php echo base_url() ?>/Login/logout" class="btn mb-2 btn-primary btn-lg btn-block">
				<i class="fe fe-door fe-12 mx-2"></i><span class="small">Keluar</span>
			</a>
		</div>
	</nav>
</aside>