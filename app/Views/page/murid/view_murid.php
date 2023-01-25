<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="row align-items-center my-4">
                            <div class="col">
                                <h2 class="h2 mb-0 page-title welcome">Data Murid</h2>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMurid" data-whatever="@mdo"><span class="fe fe-filter fe-12 mr-2"></span>Tambah Data</button>
                            </div>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>NISN</th>
                                            <th>Kelas</th>
                                            <th>Jenis Kelamin</th>
                                            <th>TTL</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $i = 1;

                                        use CodeIgniter\I18n\Time;

                                        foreach ($student as $uk) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>

                                                <td>
                                                    <p class="mb-0 text-one"><strong><?= $uk['name']; ?></strong></p>
                                                </td>
                                                <td>
                                                    <small class="mb-0 text-one"><?= $uk['nis']; ?></small>
                                                </td>
                                                <td>
                                                    <small class="mb-0 text-one"><?= $uk['kelas']; ?></small>
                                                </td>
                                                <td>
                                                    <small class="mb-0 text-one"><?= $uk['jenkel']; ?></small>
                                                </td>
                                                <td>
                                                    <small class="mb-0 text-one"><?= $uk['t_lahir']; ?>, <?= Time::parse(date("d F Y", strtotime($uk['tgl_lahir'])))->toLocalizedString('d MMMM yyyy') ?></small>
                                                </td>
                                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-one sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editStudent<?= $uk['id_murid'] ?>" data-whatever="@mdo"><span class="fe fe-edit fe-12 mr-2"></span>Edit</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteStudent<?= $uk['id_murid'] ?>" data-whatever="@mdo"><span class="fe fe-trash fe-12 mr-2"></span>Hapus</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <div class="modal fade" id="addMurid" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-12 col-xl-10">
                            <form method="POST" action="<?php echo base_url() ?>/Murid/addMurid" enctype="multipart/form-data">
                                <div class="row align-items-center my-4">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <p class="mb-4">Silahkkan isi data dengan benar</p>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="firstname">Nama</label>
                                        <input type="text" id="firstname" class="form-control" name="name" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="lastname">NISN</label>
                                        <input type="text" id="lastname" class="form-control" name="nis" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState5">Gender</label>
                                        <select id="inputState5" class="form-control" name="jenkel" required>
                                            <option>Pilih</option>
                                            <option value="Perempuan">Perempuan</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputState5">Kelas</label>
                                        <select id="inputState5" class="form-control" name="class" required>
                                            <option>Pilih</option>
                                            <?php foreach ($kelas as $kel) : ?>
                                                <option value="<?= $kel['id'] ?>"><?= $kel['kelas'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="place">Tempat Lahir</label>
                                        <input type="text" name="t_lahir" class="form-control" id="place">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="date-input1">Tanggal Lahir</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control drgpicker" id="date-input1" aria-describedby="button-addon2" name="tgl_lahir">
                                            <div class="input-group-append">
                                                <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <h5 class="mb-2 mt-4 akun">Akun</h5>
                                <p class="mb-4">Silahkan Buat Akun Untuk mengakses Sistem</p>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="firstname">Username</label>
                                        <input type="text" id="firstname" class="form-control" name="username" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lastname">Password</label>
                                        <input type="password" id="lastname" class="form-control" name="password" required>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- .col-12 -->
                    </div> <!-- .row -->

                </div>
            </div>
        </div>
    </div>
    <?php foreach ($student as $stu) : ?>
        <div class="modal fade" id="deleteStudent<?= $stu['id_murid']; ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" action="<?php echo base_url() ?>/Murid/deleteMurid/<?= $stu['id_murid']; ?>">
                            <h3 class="justify-content-center mb-3 notif">Apakah kamu yakin mau menghapus murid <?= $stu['name']; ?>?</h3>
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn mb-2 btn-danger float-right">Ya Hapus!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editStudent<?= $stu['id_murid'] ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="varyModalLabel">Edit Data Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-xl-10">
                                <form method="POST" action="<?php echo base_url() ?>/Murid/editMurid/<?= $stu['id_murid']; ?>" enctype="multipart/form-data">
                                    <div class="row align-items-center my-4">
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary">Save Change</button>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <h5 class="mb-2 mt-4">Personal</h5>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="firstname">Nama</label>
                                            <input type="text" id="firstname" class="form-control" name="name" value="<?= $stu['name'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="lastname">NISN</label>
                                            <input type="text" id="lastname" class="form-control" name="nis" value="<?= $stu['nis'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState5">Gender</label>
                                            <select id="inputState5" class="form-control" name="jenkel" required>
                                                <?php if ($stu['jenkel'] == "Perempuan") : ?>
                                                    <option value="Perempuan" selected>Perempuan </option>
                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                <?php endif; ?>
                                                <?php if ($stu['jenkel'] == "Laki-Laki") : ?>
                                                    <option value="Perempuan">Perempuan </option>
                                                    <option value="Laki-Laki" selected>Laki-Laki</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputState5">Kelas</label>
                                            <select id="inputState5" class="form-control" name="class" required>
                                                <?php foreach ($kelas as $kel) :
                                                ?>
                                                    <option <?php if ($stu['id_class'] == $kel['id']) {
                                                                echo 'selected';
                                                            } ?> value="<?= $kel['id'] ?>"><?= $kel['kelas'] ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="place">Tempat Lahir</label>
                                            <input type="text" name="t_lahir" class="form-control" id="place" value="<?= $stu['t_lahir'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="date-input1">Tanggal Lahir</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control drgpicker" id="date-input1" aria-describedby="button-addon2" name="tgl_lahir">
                                                <div class="input-group-append">
                                                    <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-4">
                                    <h5 class="mb-2 mt-4">Acount</h5>
                                    <p class="mb-4">Kosongkan jika tidak ingin merubah username dan password </p>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="firstname">Username</label>
                                            <input type="text" id="firstname" class="form-control" name="username" value="<?= $stu['username'] ?>">
                                            <input type="hidden" id="firstname" class="form-control" name="id_LogStudent" value="<?= $stu['id_LogMurid'] ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="lastname">Password</label>
                                            <input type="text" id="lastname" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                </form>
                            </div> <!-- .col-12 -->
                        </div> <!-- .row -->

                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>