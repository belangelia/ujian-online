<?php $sguru = session()->get('role_users')['role'] === 'Guru';
?>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="row align-items-center my-4">
                            <div class="col">
                                <h2 class="h2 mb-0 page-title welcome">Ujian</h2>
                                <?php
                                if (Session()->get('success')) : ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?= Session()->getFlashdata('success') ?><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <?php
                                if (Session()->get('error')) : ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= Session()->getFlashdata('error') ?><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <?php
                                if (Session()->get('change')) : ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <?= Session()->getFlashdata('change') ?><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addGuru"><span class="fe fe-filter fe-12 mr-2"></span>Buat</button>
                            </div>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table table-bordered">

                                    <thead>
                                        <tr role="row">
                                            <?php if (!$sguru) : ?>
                                                <th class="col-1">Guru</th>
                                            <?php endif; ?>
                                            <th class="col-1">Mapel</th>
                                            <th class="col-1">Kelas</th>
                                            <th class="col-3">Waktu</th>
                                            <th class="col-1">Durasi<br>(menit)</th>
                                            <th class="col-1">Jumlah Soal</th>
                                            <th class="col-2">Ket</th>
                                            <th class="col-1">Token</th>
                                            <th class="col-1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        use CodeIgniter\I18n\Time;

                                        $now = strtotime("now");
                                        ?>
                                        <tr role="group" class="bg-light">
                                            <td colspan="12" class="delay"><strong>Delay</strong></td>
                                        </tr>
                                        <?php $i = 1;
                                        if (!$sguru) :
                                            foreach ($ujian as $rl) :
                                                $start = strtotime($rl['waktu_mulai']);
                                                $end = strtotime($rl['waktu_selesai']);
                                                if ($now <= $start) : ?>
                                                    <tr>
                                                        <td><?= $rl['nama']; ?></td>
                                                        <td><?= $rl['mapel'] ?></td>
                                                        <td><?= $rl['kelas']; ?></td>
                                                        <td><?= (Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') == Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_selesai'])))->toLocalizedString('d MMMM yyyy')) ? Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_mulai'])) . " Sampai " . date("H:i", strtotime($rl['waktu_selesai'])) :  Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_mulai'])) . " Sampai " . Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_selesai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_selesai'])) ?></td>
                                                        <td><?= $rl['durasi']; ?></td>
                                                        <td><?= $rl['jml_soal']; ?></td>
                                                        <td><?= $rl['nama_ujian']; ?></td>
                                                        <td>
                                                            <?= $rl['token'] ?>
                                                        </td>
                                                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="text-muted sr-only">Action</span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editUjian<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-edit fe-12 mr-2"></span>Edit</a>
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteUjian<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-trash fe-12 mr-2"></span>Hapus</a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                endif;
                                            endforeach;

                                        endif;
                                        if ($sguru) :
                                            foreach ($gujian as $rl) :
                                                $start = strtotime($rl['waktu_mulai']);
                                                $end = strtotime($rl['waktu_selesai']);
                                                if ($now <= $start) : ?>
                                                    <tr>
                                                        <td><?= $rl['mapel'] ?></td>
                                                        <td><?= $rl['kelas']; ?></td>
                                                        <td><?= (Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') == Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_selesai'])))->toLocalizedString('d MMMM yyyy')) ? Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_mulai'])) . " Sampai " . date("H:i", strtotime($rl['waktu_selesai'])) :  Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_mulai'])) . " Sampai " . Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_selesai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_selesai'])) ?></td>
                                                        <td><?= $rl['durasi']; ?></td>
                                                        <td><?= $rl['jml_soal']; ?></td>
                                                        <td><?= $rl['nama_ujian']; ?></td>
                                                        <td>
                                                            <?= $rl['token'] ?>
                                                        </td>
                                                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="text-muted sr-only">Action</span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editUjian<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-edit fe-12 mr-2"></span>Edit</a>
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteUjian<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-trash fe-12 mr-2"></span>hapus</a>
                                                                <a class="dropdown-item" href="<?php echo base_url() ?>/Soal/detailQuestion/<?= $rl['id']; ?>"><span class="fe fe-plus-circle fe-12 mr-2"></span>Tambahkan Soal</a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                        <?php
                                                endif;
                                            endforeach;
                                        endif; ?>

                                        <!-- Assigned -->
                                        <tr role="group" class="bg-light">
                                            <td colspan="12" class="berjalan"><strong>Berjalan</strong></td>
                                        </tr>
                                        <?php $i = 1;
                                        if (!$sguru) :
                                            foreach ($ujian as $rl) :

                                                $start = strtotime($rl['waktu_mulai']);
                                                $end = strtotime($rl['waktu_selesai']);
                                                if ($now >= $start && $now <= $end) : ?>
                                                    <tr>
                                                        <td><?= $rl['nama']; ?></td>
                                                        <td><?= $rl['mapel'] ?></td>
                                                        <td><?= $rl['kelas']; ?></td>
                                                        <td><?= (Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') == Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_selesai'])))->toLocalizedString('d MMMM yyyy')) ? Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_mulai'])) . " Sampai " . date("H:i", strtotime($rl['waktu_selesai'])) :  Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_mulai'])) . " Sampai " . Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_selesai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_selesai'])) ?></td>
                                                        <td><?= $rl['durasi']; ?></td>
                                                        <td><?= $rl['jml_soal']; ?></td>
                                                        <td><?= $rl['nama_ujian']; ?></td>
                                                        <td>
                                                            <?= $rl['token'] ?>
                                                        </td>
                                                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="text-muted sr-only">Action</span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editUjian<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-edit fe-12 mr-2"></span>Edit</a>
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteUjian<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-trash fe-12 mr-2"></span>Hapus</a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                endif;
                                            endforeach;
                                        endif;
                                        if ($sguru) :
                                            foreach ($gujian as $rl) :
                                                $start = strtotime($rl['waktu_mulai']);
                                                $end = strtotime($rl['waktu_selesai']);
                                                if ($now >= $start && $now <= $end) : ?>
                                                    <tr>
                                                        <td><?= $rl['mapel'] ?></td>
                                                        <td><?= $rl['kelas']; ?></td>
                                                        <td><?= (Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') == Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_selesai'])))->toLocalizedString('d MMMM yyyy')) ? Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_mulai'])) . " Sampai " . date("H:i", strtotime($rl['waktu_selesai'])) :  Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_mulai'])) . " Sampai " . Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_selesai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_selesai'])) ?></td>
                                                        <td><?= $rl['durasi']; ?></td>
                                                        <td><?= $rl['jml_soal']; ?></td>
                                                        <td><?= $rl['nama_ujian']; ?></td>
                                                        <td>
                                                            <?= $rl['token'] ?>
                                                        </td>
                                                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="text-muted sr-only">Action</span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editUjian<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-edit fe-12 mr-2"></span>Edit</a>
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteUjian<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-trash fe-12 mr-2"></span>Hapus</a>
                                                                <!-- <a class="dropdown-item" href="<?php echo base_url() ?>/Soal/detailQuestion/<?= $rl['id']; ?>"><span class="fe fe-plus-circle fe-12 mr-2"></span>Tambahkan Soal</a> -->

                                                            </div>
                                                        </td>
                                                    </tr>
                                        <?php
                                                endif;
                                            endforeach;
                                        endif; ?>
                                        <tr role="group" class="bg-light">
                                            <td colspan="12" class="selesai"><strong>Selesai</strong></td>
                                        </tr>
                                        <?php $i = 1;
                                        if (!$sguru) :
                                            foreach ($ujian as $rl) :
                                                $start = strtotime($rl['waktu_mulai']);
                                                $end = strtotime($rl['waktu_selesai']);
                                                if ($now > $end) : ?>
                                                    <tr>
                                                        <td><?= $rl['nama']; ?></td>
                                                        <td><?= $rl['mapel'] ?></td>
                                                        <td><?= $rl['kelas']; ?></td>
                                                        <td><?= (Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') == Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_selesai'])))->toLocalizedString('d MMMM yyyy')) ? Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_mulai'])) . " Sampai " . date("H:i", strtotime($rl['waktu_selesai'])) :  Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_mulai'])) . " Sampai " . Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_selesai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_selesai'])) ?></td>
                                                        <td><?= $rl['durasi']; ?></td>
                                                        <td><?= $rl['jml_soal']; ?></td>
                                                        <td><?= $rl['nama_ujian']; ?></td>
                                                        <td>
                                                            <?= $rl['token'] ?>
                                                        </td>
                                                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="text-muted sr-only">Action</span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editUjian<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-edit fe-12 mr-2"></span>Edit</a>
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteUjian<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-trash fe-12 mr-2"></span>Hapus</a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                endif;
                                            endforeach;
                                        endif;
                                        if ($sguru) :
                                            foreach ($gujian as $rl) :
                                                $start = strtotime($rl['waktu_mulai']);
                                                $end = strtotime($rl['waktu_selesai']);
                                                if ($now > $end) : ?>
                                                    <tr>
                                                        <td><?= $rl['mapel'] ?></td>
                                                        <td><?= $rl['kelas']; ?></td>
                                                        <td><?= (Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') == Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_selesai'])))->toLocalizedString('d MMMM yyyy')) ? Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_mulai'])) . " Sampai " . date("H:i", strtotime($rl['waktu_selesai'])) :  Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_mulai'])) . " Sampai " . Time::parse(date("d F Y h:i:s ", strtotime($rl['waktu_selesai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($rl['waktu_selesai'])) ?></td>
                                                        <td><?= $rl['durasi']; ?></td>
                                                        <td><?= $rl['jml_soal']; ?></td>
                                                        <td><?= $rl['nama_ujian']; ?></td>
                                                        <td>
                                                            <?= $rl['token'] ?>
                                                        </td>
                                                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="text-muted sr-only">Action</span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editUjian<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-edit fe-12 mr-2"></span>Edit</a>
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteUjian<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-trash fe-12 mr-2"></span>Hapus</a>
                                                                <!-- <a class="dropdown-item" href="<?php echo base_url() ?>/Soal/detailQuestion/<?= $rl['id']; ?>"><span class="fe fe-plus-circle fe-12 mr-2"></span>Tambahkan Soal</a> -->

                                                            </div>
                                                        </td>
                                                    </tr>
                                        <?php
                                                endif;
                                            endforeach;
                                        endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->

            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <div class="modal fade" id="addGuru" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-12 col-xl-10">
                            <form method="POST" action="<?php echo base_url() ?>/Test/addTest" enctype="multipart/form-data">
                                <div class="row align-items-center my-2">
                                    <div class="col">
                                        <h2 class="h3 mb-0 page-title akun">Tambah Ujian</h2>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Ujian</label>
                                            <div class="col-sm-9">
                                                <?php if ($sguru) : ?>
                                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Nama Ujian" name="nama_ujian" value="Ujian Harian" readonly>
                                                <?php endif;
                                                if (session()->get('role_users')['id_lev'] == 3) : ?>
                                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Nama Ujian" name="nama_ujian" value="Ujian Semester" readonly>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-3 col-form-label">Rentang Waktu Ujian</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="datetimes" class="form-control datetimes" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3" for="exampleFormControlTextarea1">Deskripsi</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="desc"></textarea>
                                            </div>
                                        </div>
                                        <?php if (session()->get('role_users')['id_lev'] == 3) : ?>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Guru</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="guru" name="teacher" onchange="gurumapel();">
                                                        <option value="" selected disabled>-Pilih-</option>
                                                        <?php foreach ($guru as $gr) : ?>
                                                            <option value="<?= $gr['id'] ?>"><?= $gr['nama'] ?></option>
                                                        <?php
                                                        endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php endif;
                                        if ($sguru) : ?>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Guru</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="example-select" name="teacher">
                                                        <option value="<?= session()->get('role_users')['id'] ?>"><?= session()->get('role_users')['nama'] ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php endif;
                                        ?>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Pelajaran </label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="mapel" name="mapel">
                                                    <option selected disabled> -Pilih- </option>
                                                    <?php
                                                    if ($sguru) :
                                                        foreach ($matapelajaran as $mp) : ?>
                                                            <option value="<?= $mp['name'] ?>"><?= $mp['name'] ?> - <?= $mp['code'] ?></option>
                                                        <?php endforeach;
                                                    endif;
                                                    if (!$sguru) :
                                                        foreach ($matapelajaranA as $mp) :
                                                        ?>
                                                            <option value="<?= $mp['name'] ?>"><?= $mp['name'] ?> - <?= $mp['nama'] ?></option>
                                                    <?php
                                                        endforeach;
                                                    endif; ?>


                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Kelas</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="example-select" name="class">
                                                    <option> -Pilih- </option>
                                                    <?php foreach ($kelas as $cl) : ?>
                                                        <option value="<?= $cl['id'] ?>"><?= $cl['kelas'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Waktu Tes</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="inputEmail3" placeholder="Waktu tes (dalam menit)" name="duration" min="1" max="120">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah Soal</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="inputEmail3" placeholder="Jumlah Soal" name="jml_soal" min="1">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah Option</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="inputEmail3" placeholder="Jumlah Jawaban" name="jml_opsi" min="1" max="5">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Token</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="token" placeholder="Token" name="token" min="6" max="6">
                                                <p id="tok">Token Terdiri dari kombinasi huruf dan angka</p>
                                            </div>
                                            <div class="col-sm-3 ml-n3">
                                                <button type="button" class="btn mb-2 btn-info" onclick="random()">Acak</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- .col-12 -->
                    </div> <!-- .row -->

                </div>
            </div>
        </div>
    </div>


    <?php foreach ($ujian as $rol) : ?>
        <div class="modal fade" id="deleteUjian<?= $rol['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" action="<?php echo base_url() ?>/Test/deleteTest/<?= $rol['id']; ?>">
                            <h3 class="justify-content-center mb-3 notif">Apakah kamu yakin mau menghapus ujian <?= $rol['mapel']; ?>?</h3>
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn mb-2 btn-danger float-right">Ya Hapus!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editUjian<?= $rol['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="varyModalLabel">Edit ujian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?php echo base_url() ?>/Test/editTest">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label" name="ujian">Tanggal Ujian</label>
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <input type="text" name="datetimes" class="form-control datetimes" />
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" id="message-text" name="id" value="<?= $rol['id'] ?>">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn mb-2 btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>

    <script>
        var token = document.getElementById("token")

        function generate() {
            var to = ''
            var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' + '0123456789'

            for (let a = 1; a <= 6; a++) {
                var char = Math.floor(Math.random() * str.length + 1)
                to += str.charAt(char)
            }
            if (to.length !== 6) {
                return generate()
            }
            return to
        }

        function random() {
            token.value = generate()
        }
    </script>
    <script>
        function gurumapel() {
            var e = document.getElementById("guru").value;
            console.log(e);
        }
    </script>