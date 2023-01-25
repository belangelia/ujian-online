<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="row align-items-center my-4">
                            <div class="col">
                                <h2 class="h2 mb-0 page-title welcome">Data Kelas</h2>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addClass" data-whatever="@mdo"><span class="fe fe-filter fe-12 mr-2"></span>Tambahkan</button>
                            </div>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kelas</th>
                                            <th>Wali Kelas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($class as $rl) :
                                        ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $rl['kelas']; ?></td>
                                                <?php if (!$rl['nama'] !== null) : ?>
                                                    <td><?= $rl['nama']; ?></td>
                                                <?php endif;
                                                if ($rl['nama'] === null) : ?>
                                                    <td></td>
                                                <?php endif; ?>
                                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editClass<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-edit fe-12 mr-2"></span>Edit</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteClass<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-trash fe-12 mr-2"></span>Hapus</a>
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
    <div class="modal fade" id="addClass" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title akun" id="varyModalLabel">Tambahkan Kelas Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo base_url() ?>/MasterData/addKelas">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label" name="class">Kelas</label>
                            <input type="text" class="form-control" id="message-text" name="class" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label" name="wali">Wali Kelas</label>

                            <select id="inputState5" class="form-control" name="wali" required>
                                <option>Pilih</option>
                                <?php foreach ($teacher as $tea) :  ?>
                                    <option value="<?= $tea['id'] ?>"><?= $tea['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn mb-2 btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php foreach ($class as $rol) : ?>
        <div class="modal fade" id="deleteClass<?= $rol['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" action="<?php echo base_url() ?>/MasterData/deleteKelas/<?= $rol['id']; ?>">
                            <h3 class="justify-content-center mb-3 notif">Apakah kamu yakin mau menghapus Kelas <?= $rol['kelas']; ?>?</h3>
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn mb-2 btn-danger float-right">Ya Hapus!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editClass<?= $rol['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="varyModalLabel">Edit Kelas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?php echo base_url() ?>/MasterData/editKelas/<?= $rol['id']; ?>">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label" name="role">Kelas</label>
                                <input type="text" class="form-control" id="message-text" name="editclass" value="<?= $rol['kelas'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label" name="wali">Wali Kelass</label>
                                <select id="inputState5" class="form-control" name="wali" value="<?= $rol['nama'] ?>" required>
                                    <?php foreach ($teacher as $tea) :
                                    ?>
                                        <option <?php if ($rol['id_guru'] == $tea['id']) {
                                                    echo 'selected';
                                                } ?> value="<?= $tea['id'] ?>"><?= $tea['nama'] ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn mb-2 btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>