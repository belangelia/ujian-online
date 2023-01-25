    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row my-4">
                    <div class="col-12">
                        <div class="card shadow  text-center mb-4 ">
                            <div class="card-body p-5 nilai">
                                <h1 class="text-black mb-4">Nilai Kamu</h1>
                                <span class="circle circle-md ">
                                    <h1><?= $nilai_ujian ?></h2>
                                </span>
                                <h3 class="h4 mt-4 mb-1 text-white"></h3>
                                <h3 class="text-black mb-4"><?= ($nilai_ujian > 50) ? "Tingkatkan Lagi" : "Belajar Lagi Lebih Giat" ?></h3>
                                <a href="<?= base_url() ?>/Test/viewExamStudent" class="btn btn-lg-2 bg-success-light text-white">Kembali<i class="fe fe-arrow-right fe-16 ml-2"></i></a>
                            </div> <!-- .card-body -->
                        </div> <!-- .card -->
                    </div> <!-- .col-md-->
                </div> <!-- .row -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->