<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="row align-items-center my-4">
                            <div class="col">
                                <?php if ($kelas != null) : ?>
                                    <h2 class="h2 mb-0 page-title welcome">Data Murid Kelas <?= $kelas[0]->kelas ?></h2>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>No Absen</th>
                                            <th>Nama</th>
                                            <th>NISN</th>
                                            <th>TTL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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

                                        <?php $i = 1;

                                        use CodeIgniter\I18n\Time;

                                        foreach ($student as $uk) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>

                                                <td>
                                                    <p class="mb-0 text-one"><strong><?= $uk['name']; ?></strong></p>
                                                </td>
                                                <td><?= $uk['nis']; ?></td>

                                                <td>
                                                    <small class="mb-0 text-one"><?= $uk['t_lahir']; ?>, <?= Time::parse(date("d F Y", strtotime($uk['tgl_lahir'])))->toLocalizedString('d MMMM yyyy') ?></small>
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