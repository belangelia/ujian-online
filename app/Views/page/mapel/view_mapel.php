<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="row align-items-center my-4">
                            <div class="col">
                                <h2 class="h2 mb-0 page-title welcome">Data Mata Pelajaran</h2>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSubjects" data-whatever="@mdo"><span class="fe fe-filter fe-12 mr-2"></span>Create</button>
                            </div>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Pelajaran</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Guru Pengajar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($subject as $rl) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= strtoupper($rl['code']); ?></td>
                                                <td><?= strtoupper($rl['name']); ?></td>
                                                <td><?= strtoupper($rl['nama']); ?></td>
                                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editSubjects<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-edit fe-12 mr-2"></span>Edit</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteSubjects<?= $rl['id'] ?>" data-whatever="@mdo"><span class="fe fe-trash fe-12 mr-2"></span>Remove</a>
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
    <div class="modal fade" id="addSubjects" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title akun" id="varyModalLabel">Tambahkan Mapel Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo base_url() ?>/MasterData/addMapel">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label" name="code">Code</label>
                            <input type="text" class="form-control" id="message-text" name="code">
                            <label for="message-text" class="col-form-label" name="subject">Mapel</label>
                            <input type="text" class="form-control" id="message-text" name="subject">
                            <label for="message-text" class="col-form-label" name="guru">Guru Pengajar</label>

                            <select id="inputState5" class="form-control" name="guru" required>
                                <option>Pilih</option>
                                <?php foreach ($teacher as $tea) :  ?>
                                    <option value="<?= $tea['id'] ?>"><?= $tea['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
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

    <?php foreach ($subject as $rol) : ?>
        <div class="modal fade" id="deleteSubjects<?= $rol['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" action="<?php echo base_url() ?>/MasterData/deleteMapel/<?= $rol['id']; ?>">
                            <h3 class="justify-content-center mb-3 notif">Apakah kamu yakin mau menghapus mata pelajaran <?= strtoupper($rol['name']); ?>?</h3>
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn mb-2 btn-danger float-right">Ya Hapus!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editSubjects<?= $rol['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="varyModalLabel">Edit Mata Pelajaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?php echo base_url() ?>/MasterData/editMapel/<?= $rol['id']; ?>">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label" name="code">Kode</label>
                                <input type="text" class="form-control" id="message-text" name="editcode" value="<?= $rol['code'] ?>">
                                <label for="message-text" class="col-form-label" name="subject">Mapel</label>
                                <input type="text" class="form-control" id="message-text" name="editsubject" value="<?= $rol['name'] ?>">
                                <label for="message-text" class="col-form-label" name="guru">Guru Pengajar</label>
                                <select id="inputState5" class="form-control" name="guru" value="<?= $tea['nama'] ?>" required>
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