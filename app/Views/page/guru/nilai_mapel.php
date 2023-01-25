<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-12 my-4">
                        <p class="mb-3 akun">klik Nama Ujian untuk melihat nilai ujian</p>
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table table-hover table-borderless border-v">
                                    <thead>
                                        <tr>
                                            <th class="col-sm-1 font-weight-bold text-uppercase">#</th>
                                            <th class="col-sm-4 font-weight-bold text-uppercase">mapel</th>
                                            <th class="font-weight-bold text-uppercase">tipe</th>
                                            <th class="font-weight-bold text-uppercase">Tanggal Ujian</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    if ($student == null) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <span class="fe fe-minus-circle fe-16 mr-2"></span> Belum Ada Ujian Yang Anda Buat
                                        </div>
                                    <?php endif; ?>
                                    <?php $a = 1;

                                    use CodeIgniter\I18n\Time;

                                    foreach ($student as $stu) : ?>
                                        <tbody>
                                            <tr class="accordion-toggle collapsed" id="c-<?= $stu['id'] ?>" data-toggle="collapse" data-parent="#c-<?= $stu['id'] ?>" href="#collap-<?= $stu['id'] ?>">
                                                <td><?= $a++ ?></td>
                                                <td><?= $stu['mapel'] ?></td>
                                                <td><?= $stu['nama_ujian'] ?></td>
                                                <td><?= Time::parse(date("d F Y h:i:s ", strtotime($stu['waktu_mulai'])))->toLocalizedString('d MMMM yyyy') . " Pukul " . date("H:i", strtotime($stu['waktu_mulai'])) ?></td>
                                            </tr>
                                            <tr id="collap-<?= $stu['id'] ?>" class="collapse in p-3 bg-tt">
                                                <td colspan="12">
                                                    <dl class="row mb-0 mt-1">
                                                        <dt class="col-sm-3">#</dt>
                                                        <dt class="col-sm-3">Nama</dt>
                                                        <!-- <dd class="col-sm">Tristique Ltd</dd> -->
                                                        <dt class="col-sm-3">Kelas</dt>
                                                        <dt class="col-sm-3">Nilai</dt>
                                                    </dl>
                                                    <hr>
                                                    <dl class="row mb-0 mt-1">
                                                        <?php
                                                        $b = 1;
                                                        foreach ($murid as $mur) :
                                                            if ($stu['id_ujian'] == $mur['id_ujian']) : ?>
                                                                <dd class="col-sm-3"><?= $b++ ?></dt>
                                                                <dd class="col-sm-3"><?= $mur['name'] ?></dt>
                                                                    <!-- <dd class="col-sm">Tristique Ltd</dd> -->
                                                                <dd class="col-sm-3"><?= $mur['kelas'] ?></dt>
                                                                <dd class="col-sm-3"><?= $mur['nilai_ujian'] ?></dt>
                                                            <?php endif;
                                                        endforeach; ?>
                                                    </dl>
                                                </td>
                                        </tbody>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->