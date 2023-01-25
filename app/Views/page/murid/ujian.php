<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-12 my-4">
                        <h2 class="h2 mb-0 page-title welcome">Ujian-ku (class <?= session()->get('role_users')['kelas'] ?>)</h2>
                        <div class="card shadow">
                            <div class="card-body">
                                <?php
                                if (Session()->get('error')) : ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= Session()->getFlashdata('error') ?><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <!-- table -->
                                <table class="table table-hover table-borderless border-v">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mapel</th>
                                            <th>Guru</th>
                                            <th class="col-5">Waktu</th>
                                            <th>Durasi</th>
                                            <th>Tipe</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        use CodeIgniter\I18n\Time;

                                        $now = strtotime("now");
                                        ?>
                                        <tr role="group" class="bg-light">
                                            <td colspan="12" class="delay"><strong>Akan Datang</strong></td>
                                        </tr>
                                        <?php $i = 1;
                                        foreach ($ujian as $rl) :
                                            $start = strtotime($rl['waktu_mulai']);
                                            $end = strtotime($rl['waktu_selesai']);
                                            if ($now <= $start) : ?>
                                                <tr class="accordion-toggle collapsed" id="c-5429" data-toggle="collapse" data-parent="#c-5429" href="#collap-5429">
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $rl['mapel']; ?></td>
                                                    <td><?= $rl['nama']; ?></td>
                                                    <td id="onProses" class="col-3 font-weight-bold">
                                                        <input type="hidden" id="proses" value="<?= $rl['waktu_mulai'] ?>">
                                                    </td>
                                                    <td><?= $rl['durasi']; ?> menit</td>
                                                    <td><?= $rl['nama_ujian']; ?></td>
                                                    <td><span class="badge badge-danger">Belum Dimulai</span></td>
                                                    <td> Ujian Belum Dimulai
                                                    </td>
                                                </tr>
                                        <?php endif;
                                        endforeach; ?>
                                        <tr role="group" class="bg-light">
                                            <td colspan="12" class="berjalan"><strong>Berlangsung</strong></td>
                                        </tr>
                                        <?php $i = 1;
                                        foreach ($ujian as $rl) :
                                            $start = strtotime($rl['waktu_mulai']);
                                            $end = strtotime($rl['waktu_selesai']);
                                            if ($now >= $start && $now <= $end) : ?>
                                                <tr class="accordion-toggle collapsed" id="c-5429" data-toggle="collapse" data-parent="#c-5429" href="#collap-5429">
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $rl['mapel']; ?></td>
                                                    <td><?= $rl['nama']; ?></td>
                                                    <td id="onGoing">
                                                        <input type="hidden" id="mulai" value="<?= $rl['waktu_selesai'] ?>">
                                                    </td>
                                                    <td><?= $rl['durasi']; ?> menit</td>
                                                    <td><?= $rl['nama_ujian']; ?></td>
                                                    <?php if (session()->get('participant') != null && $rl['id'] == session()->get('participant')['id_test']) : ?>
                                                        <td> <span class="badge badge-success">Berlangsung</span>
                                                        </td>
                                                    <?php endif;
                                                    if (session()->get('participant') == null) : ?>
                                                        <td><span class="badge badge-success">belum dimulai</span>
                                                        </td>
                                                    <?php endif;
                                                    if (session()->get('participant') !== null && $rl['id'] != session()->get('participant')['id_test']) : ?>
                                                        <td><span class="badge badge-success">Belum Dimulai</span></td>
                                                    <?php endif;
                                                    ?>
                                                    <?php if (session()->get('participant') != null && $rl['id'] == session()->get('participant')['id_test']) : ?>
                                                        <td> <button type="button" class="btn-xs mb-1 btn-primary" data-toggle="modal" data-target=".modal-full-<?= $rl['id']; ?>" data-whatever="@mdo"><span class="fe fe-arrow-right fe-16 mr-2"></span>Kerjakan</button>
                                                            </button>
                                                        </td>
                                                    <?php endif;
                                                    if (session()->get('participant') == null) : ?>
                                                        <td><button type="button" class="btn-xs mb-1 btn-primary" data-toggle="modal" data-target=".modal-full-<?= $rl['id']; ?>" data-whatever="@mdo"><span class="fe fe-arrow-right fe-16 mr-2"></span>Kerjakan</button>
                                                            </button>
                                                        </td>
                                                    <?php endif;
                                                    if (session()->get('participant') !== null && $rl['id'] != session()->get('participant')['id_test']) : ?>
                                                        <td>Anda Sedang mengerjakan ujian lain</td>
                                                    <?php endif;
                                                    ?>

                                                </tr>
                                        <?php endif;
                                        endforeach; ?>
                                        <tr role="group" class="bg-light">
                                            <td colspan="12" class="selesai"><strong>Selesai</strong></td>
                                        </tr>
                                        <?php $i = 1;
                                        foreach ($ujian as $rl) :
                                            $start = strtotime($rl['waktu_mulai']);
                                            $end = strtotime($rl['waktu_selesai']);
                                            if ($now > $end) : ?>
                                                <tr class="accordion-toggle collapsed" id="c-5429" data-toggle="collapse" data-parent="#c-5429" href="#collap-5429">
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $rl['mapel']; ?></td>
                                                    <td><?= $rl['nama']; ?></td>
                                                    <td>Ujian Berakhir</td>
                                                    <td><?= $rl['durasi']; ?> menit</td>
                                                    <td><?= $rl['nama_ujian']; ?></td>
                                                    <td><span class="badge badge-warning">Selesai</span></td>
                                                    <td> Ujian Telah Selesai
                                                    </td>
                                                </tr>
                                        <?php endif;
                                        endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <?php foreach ($ujian as $rl) :
    ?>
        <div class="modal fade modal-full-<?= $rl['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <button aria-label="" type="button" class="close px-2" data-dismiss="modal" aria-hidden="true">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <p> Masukkan Token Untuk Mulai Ujian! </p>
                        <form class="form-inline justify-content-center" method="POST" action="<?php echo base_url() ?>/Test/testDashboard/<?= $rl['id']; ?>">
                            <input type="text" id="token" class="form-control form-control-lg mr-sm-2 bg-transparent" name="token" placeholder="Input Token" autofocus>
                            <input type="hidden" name="tokken" value="<?= $rl["token"] ?>">
                            <input type="hidden" name="id" value="<?= $rl['id'] ?>">

                            <button class="btn btn-primary btn-lg mb-2 my-2 my-sm-0" type="submit">Enter</button>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

    <script>
        var ongoing = document.getElementById("mulai").value
        var countDownDateOnGoing = new Date(ongoing).getTime();
        var x = setInterval(function() {

            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDateOnGoing - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("onGoing").innerHTML = "Berakhir Dalam" + "<br>" + ((days == 0) ? "" : days + " hari ") + ((hours == 0) ? "" : hours + " jam ") +
                ((minutes == 0) ? "" : minutes + " menit ") + seconds + " detik ";
        }, 1000);

        var onProses = document.getElementById("proses").value
        var countDownDateOnProses = new Date(onProses).getTime();
        var y = setInterval(function() {

            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDateOnProses - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("onProses").innerHTML = "Dimulai Dalam" + "<br>" + ((days == 0) ? "" : days + " hari ") + ((hours == 0) ? "" : hours + " jam ") +
                ((minutes == 0) ? "" : minutes + " menit ") + seconds + " detik ";
        }, 1000);
    </script>