<?php

use CodeIgniter\I18n\Time;
?>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title welcome">Selamat Datang, <?php if (session()->get('role_users')['role'] === 'Guru' || session()->get('role_users')['role'] === 'admin') {
                                                                                echo session()->get('role_users')['nama'];
                                                                            } else {
                                                                                echo session()->get('role_users')['name'];
                                                                            } ?></h2>
                    </div>
                    <div class="col-auto">
                        <form class="form-inline">
                            <div class="form-group d-none d-lg-inline welcome">
                                <label for="reportrange" class="sr-only"></label>
                                <small><?= Time::parse(date("d F Y"))->toLocalizedString('d MMMM yyyy') ?> - </small>
                                <small><?= date("H:i:s") ?></small>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <?php if (session()->get('role_users')['role'] === "admin") : ?>
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body dashboard">
                                    <div class="py-2 text-center">
                                        <div class="row align-items-center ">
                                            <div class="col">
                                                <a href="<?php echo base_url() ?>/Murid/viewMurid" style="text-decoration: none;">
                                                    <div class="row">
                                                        <div class="col"><span class="circle circle-lg ">
                                                                <i class="fe fe-user-x fe-24 text-white"></i>
                                                            </span></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col"><mark>Jumlah murid</mark></div>
                                                    </div>
                                                </a>
                                                <h2 class="angka mb-1 mt-3"><?= $murid ?></h2>
                                            </div> <!-- .col -->
                                        </div>
                                    </div>
                                </div> <!-- .card-body -->
                            </div> <!-- .card -->
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body dashboard">
                                    <div class="py-2 text-center">
                                        <div class="row align-items-center ">
                                            <div class="col">
                                                <a href="<?php echo base_url() ?>/Guru/viewGuru" style="text-decoration: none;">
                                                    <div class="row">
                                                        <div class="col"><span class="circle circle-lg ">
                                                                <i class="fe fe-users fe-24 text-white"></i>
                                                            </span></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col"><mark>Jumlah Guru</mark></div>
                                                    </div>
                                                </a>
                                                <h2 class="angka mb-1 mt-3"><?= $guru ?></h2>
                                            </div> <!-- .col -->
                                        </div>
                                    </div>
                                </div> <!-- .card-body -->
                            </div> <!-- .card -->
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body dashboard">
                                    <div class="py-2 text-center">
                                        <div class="row align-items-center ">
                                            <div class="col">
                                                <a href="<?php echo base_url() ?>/MasterData/viewKelas" style="text-decoration: none;">
                                                    <div class="row">
                                                        <div class="col"><span class="circle circle-lg ">
                                                                <i class="fe fe-home fe-24 text-white"></i>
                                                            </span></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col"><mark>Jumlah Kelas</mark></div>
                                                    </div>
                                                </a>
                                                <h2 class="angka mb-1 mt-3"><?= $kelas ?></h2>
                                            </div> <!-- .col -->
                                        </div>
                                    </div>
                                </div> <!-- .card-body -->
                            </div> <!-- .card -->
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body dashboard">
                                    <div class="py-2 text-center">
                                        <div class="row align-items-center ">
                                            <div class="col">
                                                <a href="<?php echo base_url() ?>/MasterData/viewMapel" style="text-decoration: none;">
                                                    <div class="row">
                                                        <div class="col"><span class="circle circle-lg ">
                                                                <i class="fe fe-book fe-24 text-white"></i>
                                                            </span></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col"><mark>Jumlah Mata Pelajaran</mark></div>
                                                    </div>
                                                </a>
                                                <h2 class="angka mb-1 mt-3"><?= $subject ?></h2>
                                            </div> <!-- .col -->
                                        </div>
                                    </div>
                                </div> <!-- .card-body -->
                            </div> <!-- .card -->
                        </div>
                    <?php endif; ?>
                    <?php if (session()->get('role_users')['role'] === "Guru") : ?>
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body dashboard">
                                    <div class="py-2 text-center">
                                        <div class="row align-items-center ">
                                            <div class="col">
                                                <a href="<?php echo base_url() ?>/Guru/myStudent" style="text-decoration: none;">
                                                    <div class="row">
                                                        <div class="col"><span class="circle circle-lg ">
                                                                <i class="fe fe-home fe-24 text-white"></i>
                                                            </span></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col"><mark>Kelas Saya</mark></div>
                                                    </div>
                                                </a>
                                                <?php if ($kelas) : ?>
                                                    <h2 class="angka mb-1 mt-3"><?= $kelas[0]->kelas ?></h2>
                                                <?php endif; ?>
                                                <?php if (!$kelas) : ?>
                                                    <h2 class="angka mb-1 mt-3">Anda Bukan Wali Kelas</h2>
                                                <?php endif; ?>
                                            </div> <!-- .col -->
                                        </div>
                                    </div>
                                </div> <!-- .card-body -->
                            </div> <!-- .card -->
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body dashboard">
                                    <div class="py-2 text-center">
                                        <div class="row align-items-center ">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col"><span class="circle circle-lg ">
                                                            <i class="fe fe-user-x fe-24 text-white"></i>
                                                        </span></div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col"><mark>Jumlah murid</mark></div>
                                                </div>
                                                <?php if ($kelas) : ?>
                                                    <h2 class="angka mb-1 mt-3"><?= $murid ?></h2>
                                                <?php endif; ?>
                                                <?php if (!$kelas) : ?>
                                                    <h2 class="angka mb-1 mt-3">Anda Bukan Wali Kelas</h2>
                                                <?php endif; ?>
                                            </div> <!-- .col -->
                                        </div>
                                    </div>
                                </div> <!-- .card-body -->
                            </div> <!-- .card -->
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body dashboard">
                                    <div class="py-2 text-center">
                                        <div class="row align-items-center ">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col"><span class="circle circle-lg ">
                                                            <i class="fe fe-book fe-24 text-white"></i>
                                                        </span></div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col"><mark>Jumlah Mata Pelajaran</mark></div>
                                                </div>
                                                <?php if ($subject) : ?>
                                                    <h2 class="angka mb-1 mt-3"><?= count($subject) ?></h2><br>
                                                <?php endif; ?>
                                                <?php if (!$subject) : ?>
                                                    <h5 class="angka mb-1">Anda Belum Memiliki mata pelajaran, harap hubungi admin</h5><br>
                                                <?php endif; ?>
                                            </div> <!-- .col -->
                                        </div>
                                    </div>
                                </div> <!-- .card-body -->
                            </div> <!-- .card -->
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body dashboard">
                                    <div class="py-2 text-center">
                                        <div class="row align-items-center ">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col"><span class="circle circle-lg">
                                                            <i class="fe fe-book fe-24 text-white"></i>
                                                        </span></div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col"><mark> Mata Pelajaran</mark></div>
                                                </div><br>
                                                <?php if ($subject) : ?>
                                                    <?php foreach ($subject as $s) : ?>
                                                        <h5 class="angka mb-1 "><?= $s['name'] ?> - <?= $s['code'] ?></h5><br>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <?php if (!$subject) : ?>
                                                    <h5 class="angka mb-1 ">Tidak ada Mata pelajaran</h5><br>
                                                <?php endif; ?>
                                            </div> <!-- .col -->
                                        </div>
                                    </div>
                                </div> <!-- .card-body -->
                            </div> <!-- .card -->
                        </div>
                    <?php endif; ?>
                    <?php if (session()->get('role_users')['role'] === "Peserta") : ?>
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body dashboard">
                                    <div class="py-2 text-center">
                                        <div class="row align-items-center ">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col"><span class="circle circle-lg ">
                                                            <i class="fe fe-home fe-24 text-white"></i>
                                                        </span></div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col"><mark>Kelas Saya</mark></div>
                                                </div>
                                                <?php if (session()->get('role_users')['kelas']) : ?>
                                                    <h2 class="angka mb-1 mt-3"><?= session()->get('role_users')['kelas'] ?></h2>
                                                <?php endif; ?>
                                                <?php if (!session()->get('role_users')['kelas']) : ?>
                                                    <h2 class="angka mb-1 mt-3">Anda Bukan Anggota Kelas</h2>
                                                <?php endif; ?>
                                            </div> <!-- .col -->
                                        </div>
                                    </div>
                                </div> <!-- .card-body -->
                            </div> <!-- .card -->
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body dashboard">
                                    <div class="py-2 text-center">
                                        <div class="row align-items-center ">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col"><span class="circle circle-lg ">
                                                            <i class="fe fe-user-x fe-24 text-white"></i>
                                                        </span></div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col"><mark>Wali Kelas</mark></div>
                                                </div>
                                                <?php if ($guru) : ?>
                                                    <h2 class="angka mb-1 mt-3"><?= $guru->nama ?></h2>
                                                <?php endif; ?>
                                                <?php if (!$guru) : ?>
                                                    <h2 class="angka mb-1 mt-3">Tidak Ada Wali Kelas</h2>
                                                <?php endif; ?>
                                            </div> <!-- .col -->
                                        </div>
                                    </div>
                                </div> <!-- .card-body -->
                            </div> <!-- .card -->
                        </div>
                    <?php endif; ?>

                </div> <!-- end section -->
            </div>
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->