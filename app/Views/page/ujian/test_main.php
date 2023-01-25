<!doctype html>
<html lang="en">

<head>
    <style>
        .custom {
            width: 50px !important;
            height: 40px !important;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/public/asset/mts.png" />
    <link rel="icon" href="<?php

                            use CodeIgniter\CLI\Console;

                            echo base_url() ?>/public/tinydash-master/light/favicon.ico">
    <title>Ujian-Online Mts Belinyu</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/feather.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/select2.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/dropzone.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/uppy.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/jquery.steps.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/jquery.timepicker.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/quill.snow.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/tinydash-master/light/css/app-dark.css" id="darkTheme" disabled>
    <style>
        :root {
            --primer: #3C6255;
            --kedua: #61876E;
            --ketiga: #A6BB8D;
            --keempat: #EAE7B1;
            --kelima: #E5E5CB;
            --keenam: #939B62;
            --baratas: #000000;
        }

        body {
            background-color: var(--primer);
        }

        .navbar {
            background-color: var(--primer);
        }

        .wrapper {
            background-color: white;
        }

        .main-content {
            background-color: white;
            margin-top: 0 !important;
        }

        .row .page-title .text-muted {
            font-weight: bold;
            text-transform: uppercase;
        }

        .card {
            background-color: white;
        }

        .card-header {
            background-color: var(--kedua);
        }



        .form-control {
            background-color: white;
            color: black;
        }

        .rou {
            margin-top: 0 !important;
        }

        .h5,
        .h2,
        .h3 {
            color: black;
        }
    </style>
</head>

<body class="horizontal light  ">
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light flex-row border-bottom shadow sticky-top mx-auto d-block">
            <div class="container-fluid">
                <div class="w-100 d-flex gap-3 justify-content-center">
                    <img src="<?= base_url() ?>/public/asset/mts.png" class="circle circle-lg  my-1">
                    </img>
                    <div class="d-flex flex-column  align-items-center mt-3">
                        <small class="h5 page-title text-uppercase">Ujian Online</small>
                        <small class="h5 page-title text-uppercase">Mts AL - ISTIQOMAH</small>
                    </div>
                </div>

            </div>
        </nav>
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center ">
                    <?php
                    function myShuffle($arr)
                    {
                        for ($i = count($arr) - 1; $i > 0; $i--) {
                            $r = rand(0, $i);
                            $tmp = $arr[$i];
                            $arr[$i] = $arr[$r];
                            $arr[$r] = $tmp;
                        }
                        return $arr;
                    }
                    ?>


                    <div class="row my-4 rou">
                        <form method="POST" action="<?php echo base_url() ?>/Test/examWork/<?= session()->get('participant')['id_test'] ?>" enctype="multipart/form-data">
                            <div class="tab-content w-100 " id="v-pills-tabContent3">
                                <div class="row">
                                    <div class="col-2 card-body">
                                        <h3 class="h5 page-title col-10"><small class="text-muted text-uppercase"><?= strtoupper(session()->get('participant')['mapel_test']) ?></small><br />#<?= strtoupper(session()->get('role_users')['name']) ?>, <?= strtoupper(session()->get('role_users')['kelas']) ?></h3>
                                    </div>
                                    <div class="col-8" style="margin: auto;">

                                        <div class="card-footer mb-3">
                                            <div class="row">
                                                <div class="col-10">
                                                    <div class="nav">
                                                        <?php
                                                        for ($a = 1; $a <= count($tes); $a++) :
                                                        ?>
                                                            <a class="<?php ($a === 1) ? 'active' : '' ?>" data-toggle="pill" href="#v-pills-home<?= $a ?>" role="tab" aria-controls="v-pills-home<?= $a ?>" aria-selected="<?php ($a === 1) ? 'true' : 'false' ?>">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn mb-2 btn-primary ml-1 mr-1 custom btn-sm"><?= $a ?></button>
                                                                </div>
                                                            </a>
                                                        <?php
                                                        endfor; ?>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <button type="button" class="btn btn-success " data-toggle="modal" data-target="#defaultModal">Selesai</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-2 card-body">
                                        <small class="text-muted text-uppercase">Waktu Tersisa</small>
                                        <small class="text-muted text-uppercase" id="waktu" style="display: none;"><?= session()->get('participant')['durasi'] ?></small>
                                        <h2 class="h5 page-title" id="timer"></h2>
                                    </div>
                                </div>
                                <?php $b = 1;
                                foreach (myShuffle($tes) as $t) : ?>
                                    <div class="tab-pane fade <?php ($b === 1) ? ' show active' : '' ?> col-md-9" id="v-pills-home<?= $b ?>" role="tabpanel" style="margin: auto;">
                                        <div class="card shadow mb-4">
                                            <div class="card-header">
                                                <strong class="card-title">Soal Nomor <?= $b ?></strong>
                                            </div>
                                            <div class="card-body">
                                                <div class="row align-items-center mb-4">
                                                    <div class="col-9">
                                                        <strong class="h3"><?= $t['detail_soal'] ?></strong>
                                                        <input type="hidden" name="idSoal<?= $b ?>" value="<?= $t['id'] ?>">
                                                    </div>

                                                </div> <!-- .row-->
                                            </div>
                                            <div class="card-footer">
                                                <?php
                                                foreach (myShuffle($option) as $op) :
                                                    if ($op['id_soal'] == $t['id'] && $op) :
                                                ?>
                                                        <div class="form-check" id="tess">
                                                            <input class="form-check-input" type="radio" name="optionTrue<?= $b ?>" id="id<?= $b ?>" value="<?= $op['id'] ?>">
                                                            <label class="form-control" for="flexRadioDefault1">
                                                                <?= $op['detail_jawaban'] ?>
                                                            </label>
                                                        </div>
                                                    <?php
                                                    endif;
                                                    if (!$op) : ?>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="flexRadioDefault" value="ddd" id="flexRadioDefault1">
                                                            <label class="form-control" for="flexRadioDefault1">
                                                                Kosong
                                                            </label>
                                                        </div>
                                                <?php
                                                    endif;
                                                endforeach;
                                                ?>


                                            </div>
                                        </div>
                                    </div>
                                <?php $b++;
                                endforeach; ?>

                            </div>

                            <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="defaultModalLabel">Konfirmasi Selesai Ujian</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body"> Apakah Kamu Yakin? </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn mb-2 btn-primary">Ya, Selesai</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .col-md -->

                    <!-- testing -->

                    <!-- Html Template -->

                </div> <!-- .col-md -->
            </div>
        </main> <!-- main -->
    </div>

    <!-- new -->

</body>
<script>
    function addMinutes(numOfMinutes, date = new Date()) {
        date.setMinutes(date.getMinutes() + numOfMinutes);
        return date;
    }
    var waktu = parseInt(<?= session()->get('participant')['durasi'] ?>)
    const result = addMinutes(waktu);
    var one = new Date("<?= session()->get('participant')['durasi_selesai'] ?>");
    var onetwo = one.getTime()

    var countDownDate = result.getTime();

    var x = setInterval(function() {

        var now = new Date().getTime();

        var distance = onetwo - now;


        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("timer").innerHTML = (hours > 0) ? hours + "Jam " : "" +
            minutes + "Menit " + seconds + "Detik ";

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "EXPIRED";
            insertData()
        }

    }, 1000);


    var finish = document.getElementById("finish")
    finish.addEventListener('click', function() {
        clearInterval(x)
    })



    function insertData() {
        // Ambil data yang akan dikirim ke server

        var optionTrue = []
        for (let a = 1; a <= <?= session()->get('participant')['jml_soal'] ?>; a++) {
            var cek = document.getElementsByName("optionTrue" + a);
            var radioSelected = false;
            for (var i = 0; i < cek.length; i++) {
                if (cek[i].checked) {
                    radioSelected = true;
                    break;
                }
            }
            console.log(radioSelected)
            optionTrue[a] = $('#id' + a).val()
            console.log(optionTrue[a])
            console.log(check)
        }
        // Kirim data ke server menggunakan AJAX
        $.ajax({
            type: 'POST',
            url: 'http://example.com/insert_data',
            data: data,
            success: function(response) {
                // Jika berhasil, tampilkan pesan sukses
                alert('Data berhasil disimpan');
            },
            error: function() {
                // Jika gagal, tampilkan pesan error
                alert('Terjadi kesalahan');
            }
        });
    }
</script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/popper.min.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/moment.min.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/simplebar.min.js"></script>
<script src='<?php echo base_url() ?>/public/tinydash-master/light/js/daterangepicker.js'></script>
<script src='<?php echo base_url() ?>/public/tinydash-master/light/js/jquery.stickOnScroll.js'></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/tinycolor-min.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/config.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/d3.min.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/topojson.min.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/datamaps.all.min.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/datamaps-zoomto.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/datamaps.custom.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/Chart.min.js"></script>
<script>
    /* defind global options */
    Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
    Chart.defaults.global.defaultFontColor = colors.mutedColor;
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/gauge.min.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/apexcharts.min.js"></script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/apexcharts.custom.js"></script>
<script src='<?php echo base_url() ?>/public/tinydash-master/light/js/jquery.mask.min.js'></script>
<script src='<?php echo base_url() ?>/public/tinydash-master/light/js/select2.min.js'></script>
<script src='<?php echo base_url() ?>/public/tinydash-master/light/js/jquery.steps.min.js'></script>
<script src='<?php echo base_url() ?>/public/tinydash-master/light/js/jquery.validate.min.js'></script>
<script src='<?php echo base_url() ?>/public/tinydash-master/light/js/jquery.timepicker.js'></script>
<script src='<?php echo base_url() ?>/public/tinydash-master/light/js/dropzone.min.js'></script>
<script src='<?php echo base_url() ?>/public/tinydash-master/light/js/uppy.min.js'></script>
<script src='<?php echo base_url() ?>/public/tinydash-master/light/js/quill.min.js'></script>
<script>
    $('.select2').select2({
        theme: 'bootstrap4',
    });
    $('.select2-multi').select2({
        multiple: true,
        theme: 'bootstrap4',
    });
    $('.drgpicker').daterangepicker({
        singleDatePicker: true,
        timePicker: false,
        showDropdowns: true,
        locale: {
            format: 'MM/DD/YYYY'
        }
    });
    $('.time-input').timepicker({
        'scrollDefault': 'now',
        'zindex': '9999' /* fix modal open */
    });
    /** date range picker */
    if ($('.datetimes').length) {
        $('.datetimes').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD hh:mm A'
            }
        });
    }
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
    cb(start, end);
    $('.input-placeholder').mask("00/00/0000", {
        placeholder: "__/__/____"
    });
    $('.input-zip').mask('00000-000', {
        placeholder: "____-___"
    });
    $('.input-money').mask("#.##0,00", {
        reverse: true
    });
    $('.input-phoneus').mask('(000) 000-0000');
    $('.input-mixed').mask('AAA 000-S0S');
    $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
        translation: {
            'Z': {
                pattern: /[0-9]/,
                optional: true
            }
        },
        placeholder: "___.___.___.___"
    });
    // editor
    var editor = document.getElementById('editor');
    if (editor) {
        var toolbarOptions = [
            [{
                'font': []
            }],
            [{
                'header': [1, 2, 3, 4, 5, 6, false]
            }],
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [{
                    'header': 1
                },
                {
                    'header': 2
                }
            ],
            [{
                    'list': 'ordered'
                },
                {
                    'list': 'bullet'
                }
            ],
            [{
                    'script': 'sub'
                },
                {
                    'script': 'super'
                }
            ],
            [{
                    'indent': '-1'
                },
                {
                    'indent': '+1'
                }
            ], // outdent/indent
            [{
                'direction': 'rtl'
            }], // text direction
            [{
                    'color': []
                },
                {
                    'background': []
                }
            ], // dropdown with defaults from theme
            [{
                'align': []
            }],
            ['clean'] // remove formatting button
        ];
        var quill = new Quill(editor, {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });
    }
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<script>
    var uptarg = document.getElementById('drag-drop-area');
    if (uptarg) {
        var uppy = Uppy.Core().use(Uppy.Dashboard, {
            inline: true,
            target: uptarg,
            proudlyDisplayPoweredByUppy: false,
            theme: 'dark',
            width: 770,
            height: 210,
            plugins: ['Webcam']
        }).use(Uppy.Tus, {
            endpoint: 'https://master.tus.io/files/'
        });
        uppy.on('complete', (result) => {
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
    }
</script>
<script src="<?php echo base_url() ?>/public/tinydash-master/light/js/apps.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
</script>
</body>

</html>