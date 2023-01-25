<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="row align-items-center my-4">
                            <div class="col">
                                <h2 class="h2 mb-0 page-title welcome">Data Guru</h2>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addGuru" data-whatever="@mdo"><span class="fe fe-filter fe-12 mr-2"></span>Tambah Data</button>
                            </div>
                        </div>
                        <div class="card shadow">
                            <div class="card-body ">
                                <!-- table -->
                                <table class="table datatables table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>NIP</th>
                                            <!-- <th>Jenis Kelamin</th> -->
                                            <th>Email</th>
                                            <th>Telepon</th>
                                            <!-- <th>Alamat</th> -->
                                            <!-- <th>Status</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($teacher as $uk) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td class="col-md-1">
                                                    <div class="avatar avatar-md">
                                                        <img src="<?php echo base_url() ?>/public/berkas/users/teachers/<?= $uk['foto'] ?>" alt="..." class="avatar-img rounded-circle">
                                                    </div>
                                                </td>
                                                <td class="row-md">
                                                    <p class="mb-0 text-one"><?= $uk['nama']; ?></p>
                                                </td>
                                                <td class="row-md">
                                                    <p class="mb-0 text-one"><?= $uk['nip']; ?></p>
                                                    <!-- <td class="row-md">
                                                    <small class="mb-0 text-one"><?= $uk['jenkel']; ?></small>
                                                </td> -->
                                                <td class="row-md">
                                                    <small class="mb-0 text-one"><?= $uk['email']; ?></small>
                                                </td>
                                                <td class="row-md">
                                                    <small class="mb-0 text-one"><?= $uk['telp']; ?></small>
                                                </td>
                                                <!-- <td class="row-md">
                                                    <small class="mb-0 text-one"><?= $uk['alamat']; ?></small>
                                                </td> -->
                                                <!-- <td class="row-md">
                                                    <?php if ($uk['status'] == 1) : ?>
                                                        <small>
                                                            <span class="dot dot-lg bg-success mr-1"></span> Aktif </small>
                                                    <?php else : ?>
                                                        <span class="dot dot-lg bg-danger mr-1"></span> Tidak </small>
                                                    <?php endif ?>
                                                </td> -->
                                                <td class="row-md"><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-one sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editGuru<?= $uk['id_guru'] ?>" data-whatever="@mdo"><span class="fe fe-edit fe-12 mr-2"></span>Edit</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteGuru<?= $uk['id_guru'] ?>" data-whatever="@mdo"><span class="fe fe-trash fe-12 mr-2"></span>Hapus</a>
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
                            <form method="POST" action="<?php echo base_url() ?>/Guru/addGuru" name="addTeacher" enctype="multipart/form-data">
                                <div class="row align-items-center my-4">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <p class="mb-4">Silahkkan isi data dengan benar</p>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="firstname">Nama</label>
                                        <input type="text" id="firstname" class="form-control" name="name" required>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lastname">No Guru</label>
                                        <input type="number" id="lastname" class="form-control" name="nogur" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Email</label>
                                        <input type="email" class="form-control" id="inputEmail4" name="email">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPhone">Phone</label>
                                        <input type="number" class="form-control" id="inputPhone" name="phone">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState5">Agama</label>
                                        <select id="inputState5" class="form-control" name="agama" required>
                                            <option disabled selected>Pilih</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Konghuchu">Konghuchu</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="place">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control" id="place">
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
                                    <div class="form-group col-md-4">
                                        <label for="inputState5">Gender</label>
                                        <select id="inputState5" class="form-control" name="gender" required>
                                            <option>Pilih</option>
                                            <option value="Perempuan">Perempuan</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputPhone">Alamat</label>
                                        <textarea class="form-control" id="example-textarea" rows="4" name="alamat"></textarea>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <h5 class="mb-2 mt-4">Acount</h5>
                                <p class="mb-4">Silahkan Buat Acount Untuk mengakses Sistem</p>
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
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="customFile">Upload Foto</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="foto">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                            </form>
                        </div> <!-- .col-12 -->
                    </div> <!-- .row -->

                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn mb-2 btn-primary">Submit</button>
                </div> -->
            </div>
        </div>
    </div>

    <?php foreach ($teacher as $gr) : ?>
        <div class="modal fade" id="deleteGuru<?= $gr['id_guru']; ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" action="<?php echo base_url() ?>/Guru/deleteGuru/<?= $gr['id_guru']; ?>">
                            <h3 class="justify-content-center mb-3 notif">Apakah kamu yakin mau menghapus guru <?= $gr['nama']; ?>?</h3>
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn mb-2 btn-danger float-right">Ya Hapus!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editGuru<?= $gr['id_guru'] ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="varyModalLabel">Edit Data Guru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-xl-10">
                                <form method="POST" action="<?php echo base_url() ?>/Guru/editGuru/<?= $gr['id_guru']; ?>" enctype="multipart/form-data">
                                    <div class="row align-items-center my-4">
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <h5 class="mb-2 mt-4">Personal</h5>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="firstname">Nama</label>
                                            <input type="text" id="firstname" class="form-control" name="name" value="<?= $gr['nama']; ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="lastname">NISN</label>
                                            <input type="text" id="lastname" class="form-control" name="nogur" value="<?= $gr['nip']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" class="form-control" id="inputEmail4" name="email" value="<?= $gr['email']; ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPhone">Phone</label>
                                            <input type="number" class="form-control" id="inputPhone" name="phone" value="<?= $gr['telp']; ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState5">Agama</label>
                                            <select id="inputState5" class="form-control" name="agama" required>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Konghuchu">Konghuchu</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="place">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" class="form-control" id="place" name="tempat_lahir" value="<?= $gr['tempat_lahir']; ?>">
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
                                        <div class="form-group col-md-4">
                                            <label for="inputState5">Gender</label>
                                            <select id="inputState5" class="form-control" name="gender" required>
                                                <option value="Perempuan">Perempuan</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputPhone">Alamat</label>
                                            <textarea class="form-control" id="example-textarea" rows="4" name="alamat"><?= $gr['alamat']; ?></textarea>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <h5 class="mb-2 mt-4">Acount</h5>
                                    <p class="mb-4">Kosongkan jika tidak ingin merubah username dan password</p>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="firstname">Username</label>
                                            <input type="text" id="firstname" class="form-control" name="username" placeholder="">
                                            <input type="hidden" id="firstname" class="form-control" name="id_LogTeacher" value="<?= $gr['id_LogGuru'] ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="lastname">Password</label>
                                            <input type="text" id="lastname" class="form-control" name="password" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="customFile">Upload Foto</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="foto">
                                                <input type="hidden" class="custom-file-input" id="customFile" name="recentfoto" value="<?= $gr['foto'] ?>">
                                                <label class="custom-file-label" for="customFile"></label>
                                            </div>
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
    <?php endforeach ?>

    <script>
        function validateForm() {
            addTeacher
            name
            nogur
            email
            phone
            agama
            tempat_lahir
            tgl_lahir
            gender
            alamat
            let x = document.forms["myForm"]["fname"].value;
            if (x == "") {
                alert("Name must be filled out");
                return false;
            }
        }
    </script>