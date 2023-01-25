<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-12 my-4">

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


                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table table-hover table-borderless border-v">
                                    <thead>
                                        <tr>
                                            <th class="col-1">No</th>
                                            <th class="col-10"> Preview Soal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($soal as $s) : ?>
                                            <tr class="accordion-toggle collapsed" id="c-2474" data-toggle="collapse" data-parent="#c-2474" href="#collap-2474">
                                                <td><?= $no++ ?></td>
                                                <td class="overflow-hidden font-weight-bold"><?= ($s['detail_soal'] == null) ? "Soal Belum Dibuat" : $s['detail_soal']  ?></td>
                                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="<?php echo base_url() ?>/Soal/viewQuestion/<?= intval($s['id']); ?>"><?= ($s['detail_soal'] == null) ? "Buat Soal" : "Edit Soal"  ?></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card shadow mt-5">
                            <div class="card-body table-wrap">
                                <!-- table -->
                                <table class="table table-hover table-borderless border-v ">
                                    <thead class="">
                                        <tr>
                                            <th class="col-1">No</th>
                                            <th class="col-10"> Bank SOal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        <?php
                                        $no = 1;
                                        foreach ($bank as $b) :
                                            if ($soal[0]['kategori'] == $b['kategori']) : ?>
                                                <tr class="accordion-toggle collapsed" id="c-2474" data-toggle="collapse" data-parent="#c-2474" href="#collap-2474">
                                                    <td><?= $no++ ?></td>
                                                    <td class="overflow-hidden font-weight-bold"><?= $b['detail_soal']  ?></td>
                                                    <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="text-muted sr-only">Action</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cek<?= $b['id'] ?>" data-whatever="@mdo"><span class="fe fe-edit fe-12 mr-2"></span>Gunakan Soal Ini</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php endif;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <?php foreach ($bank as $b) : ?>
        <div class="modal fade" id="cek<?= $b['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="varyModalLabel">Edit Soal Ujian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <?php $a = 1;
                            foreach ($soal as $s) : ?>
                                <form method="POST" action="<?php echo base_url() ?>/Soal/gunaBankSoal/<?= $s['id']; ?>">
                                    <input type="hidden" name="id_ujian" value="<?= $ujian['id'] ?>">
                                    <input type="hidden" name="jmlopsi" value="<?= $ujian['jml_opsi'] ?>">
                                    <textarea hidden class="form-control" name="soal"><?= $b['detail_soal'] ?></textarea>
                                    <?php
                                    $x = 1;
                                    foreach ($jawab as $j) :
                                        if ($j['id_soal'] == $b['id']) : ?>
                                            <textarea hidden class="form-control" name="detJaw<?= $x ?>"><?= $j['detail_jawaban'] ?></textarea>
                                            <input type="hidden" name="benar<?= $x ?>" value="<?= $j['jawaban_benar'] ?>">
                                    <?php
                                            $x++;
                                        endif;
                                    endforeach; ?>
                                    <button type="submit" class="btn mb-2 btn-secondary">Ganti Soal Nomor <?= $a; ?></button>
                                </form>
                            <?php $a++;
                            endforeach; ?>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>