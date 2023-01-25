<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-12 my-4">
                        <?php if ($kelas != null) : ?>
                            <h2 class="h2 mb-0 page-title welcome">Nilai Murid Kelas <?= $kelas[0]->kelas ?></h2>
                        <?php endif; ?>
                        <p class="mb-3 akun">klik Nama Siswa untuk melihat nilai ujian</p>
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table table-hover table-borderless border-v">
                                    <thead>
                                        <tr>
                                            <th class="col-sm-1 font-weight-bold text-uppercase">#</th>
                                            <th class="col-sm-4 font-weight-bold text-uppercase">NISN</th>
                                            <th class="font-weight-bold text-uppercase">Nama</th>
                                        </tr>
                                    </thead>
                                    <?php if ($kelas == null) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <span class="fe fe-minus-circle fe-16 mr-2"></span> Anda Bukan Wali Kelas, Harap Hubungi Admin !
                                        </div>
                                    <?php endif;
                                    if ($student == null) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <span class="fe fe-minus-circle fe-16 mr-2"></span> Anda Belum Memiliki Anggota Kelas, Harap Hubungi Admin !
                                        </div>
                                    <?php endif; ?>
                                    <?php $a = 1;

                                    use CodeIgniter\I18n\Time;

                                    foreach ($student as $stu) : ?>
                                        <tbody>
                                            <tr class="accordion-toggle collapsed" id="c-<?= $stu['id'] ?>" data-toggle="collapse" data-parent="#c-<?= $stu['id'] ?>" href="#collap-<?= $stu['id'] ?>">
                                                <td><?= $a++ ?></td>
                                                <td><?= $stu['nis'] ?></td>
                                                <td><?= $stu['name'] ?></td>
                                            </tr>
                                            <tr id="collap-<?= $stu['id'] ?>" class="collapse in p-3 bg-tt">
                                                <td colspan="12">
                                                    <dl class="row mb-0 mt-1">
                                                        <dt class="col-sm-1">#</dt>
                                                        <dt class="col-sm-3">Mata Pelajaran</dt>
                                                        <!-- <dd class="col-sm">Tristique Ltd</dd> -->
                                                        <dt class="col-sm-2">Nilai</dt>
                                                        <dt class="col-sm-3">Tgl Ujian</dt>
                                                        <dt class="col-sm-3">Guru</dt>
                                                    </dl>
                                                    <hr>
                                                    <dl class="row mb-0 mt-1">
                                                        <?php
                                                        $b = 1;


                                                        foreach ($score as $sco) :
                                                            if ($stu['id'] == $sco['id_murid']) : ?>
                                                                <dd class="col-sm-1"><?= $b++ ?></dt>
                                                                <dd class="col-sm-3"><?= $sco['mapel'] ?></dt>
                                                                    <!-- <dd class="col-sm">Tristique Ltd</dd> -->
                                                                <dd class="col-sm-2"><?= $sco['nilai_ujian'] ?></dt>
                                                                <dd class="col-sm-3"><?= Time::parse(date("d F Y", strtotime($sco['waktu_selesai'])))->toLocalizedString('d MMMM yyyy') ?></dt>
                                                                <dd class="col-sm-3"><?= $sco['nama'] ?></dt>
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