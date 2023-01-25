<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <form method="POST" action="<?php echo base_url() ?>/Soal/addQuestion/<?= $soal['id_ujian'] ?>" enctype="multipart/form-data">
                            <div class="row align-items-center my-4">
                                <div class="col">
                                    <h2 class="h2 mb-0 page-title welcome">Soal</h2>
                                    <p class="akun">Silahkan Buat soal di kolom dibawah ini</p>

                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary"><span class="fe fe-save fe-12 mr-2"></span>Simpan</button>
                                    <input type="hidden" name="jml_opsi" value="<?= $ujian['jml_opsi'] ?>">
                                    <input type="hidden" name="id" value="<?= $soal['id'] ?>">
                                </div>
                            </div>
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
                            <div class="row tambah-soal">
                                <div class="col-7">
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <!-- Create the editor container -->
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="pengumuman" name="pengumuman" rows="3" placeholder=" isi"><?= $soal['detail_soal'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end section -->
                                </div>
                                <div class="tambah-opsi col-5">
                                    <div class="accordion accordion-boxed" id="accordion2">
                                        <?php if ($jawaban == null) : ?>
                                            <div class="card shadow">
                                                <div class="card-header" id="headingOne">
                                                    <a role="button" href="#collapseOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                        <strong>Option A</strong>
                                                    </a>
                                                    <div class="form-check form-check-inline float-right">
                                                        <input class="form-check-input" type="radio" name="optionTrue" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1"><b>Jawaban Benar A</b></label>
                                                    </div>
                                                </div>
                                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion2">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <textarea class="form-control" id="option1" name="option1" rows="3" placeholder=" isi"></textarea>
                                                            <input type="hidden" name="id_option1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card shadow">
                                                <div class="card-header" id="headingTwo">
                                                    <a role="button" href="#collapseTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        <strong>Option B</strong>
                                                    </a>
                                                    <div class="form-check form-check-inline float-right">
                                                        <input class="form-check-input" type="radio" name="optionTrue" id="inlineRadio2" value="option2">
                                                        <label class="form-check-label" for="inlineRadio2"><b>Jawaban Benar B</b></label>
                                                    </div>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <textarea class="form-control" id="option2" name="option2" rows="3" placeholder=" isi"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card shadow">
                                                <div class="card-header" id="headingThree">
                                                    <a role="button" href="#collapseThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        <strong>Option C</strong>
                                                    </a>
                                                    <div class="form-check form-check-inline float-right">
                                                        <input class="form-check-input" type="radio" name="optionTrue" id="inlineRadio3" value="option3">
                                                        <label class="form-check-label" for="inlineRadio3"><b>Jawaban Benar C</b></label>
                                                    </div>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion2">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <textarea class="form-control" id="option3" name="option3" rows="3" placeholder=" isi"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card shadow">
                                                <div class="card-header" id="headingFour">
                                                    <a role="button" href="#collapseFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                        <strong>Option D</strong>
                                                    </a>
                                                    <div class="form-check form-check-inline float-right">
                                                        <input class="form-check-input" type="radio" name="optionTrue" id="inlineRadio4" value="option4">
                                                        <label class="form-check-label" for="inlineRadio4"><b>Jawaban Benar D</b></label>
                                                    </div>
                                                </div>
                                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion2">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <textarea class="form-control" id="option4" name="option4" rows="3" placeholder=" isi"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if ($ujian['jml_opsi'] == 5) : ?>
                                                <div class="card mb-2">
                                                    <div class="card-header" id="headingFive">
                                                        <a role="button" href="#collapseFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                            <strong>Option E</strong>
                                                        </a>
                                                        <div class="form-check form-check-inline float-right">
                                                            <input class="form-check-input" type="radio" name="optionTrue" id="inlineRadio5" value="option5">
                                                            <label class="form-check-label" for="inlineRadio5"><b>Jawaban Benar E</b></label>
                                                        </div>
                                                    </div>

                                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion2">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <textarea class="form-control" id="option5" name="option5" rows="3" placeholder=" isi"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php endif;
                                        $a = 1;
                                        if ($jawaban != null) :
                                            foreach ($jawaban as $jaw) :
                                                // d($jaw)
                                            ?>
                                                <div class="card shadow">
                                                    <div class="card-header" id="heading<?= $a ?>">
                                                        <a role="button" href="#collapse<?= $a ?>" data-toggle="collapse" data-target="#collapse<?= $a ?>" aria-expanded="false" aria-controls="collapse<?= $a ?>">
                                                            <strong>Opsi <?= $a ?></strong>
                                                        </a>
                                                        <div class="form-check form-check-inline float-right">
                                                            <input class="form-check-input" type="radio" name="optionTrue" id="inlineRadio<?= $a ?>" value="option<?= $a ?>" <?= ($jaw['jawaban_benar'] == 1) ? "checked='checked'" : "" ?>>
                                                            <label class="form-check-label" for="inlineRadio<?= $a ?>"><b>Jawaban Benar Opsi <?= $a ?></b></label>
                                                            <input type="hidden" name="id_option<?= $a ?>" value="<?= $jaw['id'] ?>">
                                                            <input type="hidden" name="correct<?= $a ?>" value="<?= $jaw['jawaban_benar'] ?>">
                                                        </div>
                                                    </div>
                                                    <div id="collapse<?= $a ?>" class="collapse" aria-labelledby="heading<?= $a ?>" data-parent="#accordion2">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <textarea class="form-control" id="option<?= $a ?>" name="option<?= $a ?>" rows="3" placeholder=" isi"><?= $jaw['detail_jawaban'] ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php $a++;
                                            endforeach;

                                        endif; ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->