<?php

namespace App\Controllers;

$request = \Config\Services::request();

use CodeIgniter\Controller;
use App\Models\M_Execution;
use App\Models\M_Role;
use App\Models\M_Kelas;
use App\Models\M_Jawaban;
use App\Models\M_Guru;
use App\Models\M_Ujian;
use App\Models\M_Soal;
use CodeIgniter\HTTP\RedirectResponse;
use DateTime;

class Soal extends BaseController
{


    #----------------------Test----------------------

    function viewQuestion($id)
    {
        $modelUjian = new M_Ujian();
        $modelGuru = new M_Guru();
        $modelKelas = new M_Kelas();
        $modelQuestion = new M_Soal();
        $modelAnswer = new M_Jawaban();
        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        $data['soal'] = $modelUjian->editQuestion($id);
        $data['ujian'] = $modelUjian->optionTotal($id);
        $data['jawaban'] = $modelQuestion->editAnswer($id);

        // $data['jawaban'] = $modelAnswer->findAnswer($id);

        // foreach ($data['soal'] as $sl) {
        //     print_r($sl['question_detail']);
        //     foreach ($data['jawaban'] as $jw) {
        //         if ($jw['question_id'] == $sl['id']) {
        //             print_r($jw['answer_detail']);
        //         }
        //     }
        //     print_r('<br>');
        // }
        // die();
        // dd($data['jawaban']);
        // $data['guru'] = $modelGuru->getAllTeacher();
        // $data['kelas'] = $modelKelas->findAll();
        // dd($data);

        echo view('template/header');
        echo view('template/sidebar');
        echo view('page/soal/add_soal', $data);
        echo view('template/footer');
    }
    public function detailQuestion($id)
    {
        $modelQ = new M_Soal();
        $modelT = new M_Ujian();

        $data['opsi'] = $modelQ->jumlah();
        $data['ujian'] = $modelQ->ujianSoal($id);
        $data['soal'] = $modelQ->dQuestion($id);
        $data['bank'] = $modelQ->bankSoal();
        $data['jawab'] = $modelQ->bankJawaban();
        // d($data);

        echo view('template/header');
        echo view('template/sidebar');
        echo view('page/guru/soal', $data);
        echo view('template/footer');
    }
    public function addQuestion($id): RedirectResponse
    {
        $model = new M_Soal();
        $model2 = new M_Jawaban();
        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        $ambilId = intval($this->request->getPost('id'));
        // dd($ambil);

        $data = array(
            'id_ujian' => $id,
            'detail_soal' => $this->request->getPost('pengumuman'),
        );
        if ($data['detail_soal'] == null) {
            return redirect()->back()->with("error", "Mohon masukkan soal dengan benar");
        }
        if ($model->update($ambilId, $data)) {
            // dd($question);
            $ambil = $this->request->getPost();
            $jawaban = [];
            $jawabanTrue = [];
            $opsi = intval($ambil['jml_opsi']);
            // dd($opsi);

            for ($i = 1; $i <= $opsi; $i++) {
                array_push($jawaban, $ambil['option' . $i]);
            }
            // d($ambil);

            $option_id = $ambil['id_option1'];
            $set = isset($ambil['optionTrue']) ? $ambil['optionTrue'] : "";
            if ($set == null) {
                return redirect()->back()->withInput()->with("error", "Pilih jawaban mana yang benar");
            }
            if ($option_id != null) {
                // dd($jawaban);
                for ($j = 1; $j <= count($jawaban); $j++) {
                    if ($ambil['optionTrue'] == 'option1' && $j == 1) {
                        $jawabanTrue = 1;
                    } elseif ($ambil['optionTrue'] == 'option2' && $j == 2) {
                        $jawabanTrue = 1;
                    } elseif ($ambil['optionTrue'] == 'option3' && $j == 3) {
                        $jawabanTrue = 1;
                    } elseif ($ambil['optionTrue'] == 'option4' && $j == 4) {
                        $jawabanTrue = 1;
                    } elseif ($ambil['optionTrue'] == 'option5' && $j == 5) {
                        $jawabanTrue = 1;
                    } else {
                        $jawabanTrue = 0;
                    }
                    if ($ambil['option' . $j] == null) {
                        return redirect()->back()->withInput()->with("error", "Opsi Jawaban yang Ke-" . $j . " kosong, harap diisi");
                    }
                    $dataanser = array(
                        'id_soal' => $ambilId,
                        'detail_jawaban' => $ambil['option' . $j],
                        'jawaban_benar' => intval($jawabanTrue),
                    );
                    if ($model2->update(intval($ambil['id_option' . $j]), $dataanser)) {
                        session()->setFlashdata('success', 'Soal Berhasil Diubah');
                    }
                }
            } else {
                for ($j = 0; $j < count($jawaban); $j++) {
                    // dd($ambil);
                    if ($ambil['optionTrue'] == 'option1' && $j == 0) {
                        $jawabanTrue = 1;
                    } elseif ($ambil['optionTrue'] == 'option2' && $j == 1) {
                        $jawabanTrue = 1;
                    } elseif ($ambil['optionTrue'] == 'option3' && $j == 2) {
                        $jawabanTrue = 1;
                    } elseif ($ambil['optionTrue'] == 'option4' && $j == 3) {
                        $jawabanTrue = 1;
                    } elseif ($ambil['optionTrue'] == 'option5' && $j == 4) {
                        $jawabanTrue = 1;
                    } else {
                        $jawabanTrue = 0;
                    }
                    if ($jawaban[$j] == null) {
                        return redirect()->back()->withInput()->with("error", "Opsi Jawaban ada yang kosong, harap diisi");
                    }

                    $dataanser = array(
                        'id_soal' => $ambilId,
                        'detail_jawaban' => $jawaban[$j],
                        'jawaban_benar' => $jawabanTrue,
                    );
                    if ($model2->insert($dataanser)) {
                        session()->setFlashdata('success', 'Soal Berhasil Ditambahkan');
                    }
                }
            }
        }
        $url = "/Soal/detailQuestion/" . $id;
        return redirect()->to(base_url($url));
    }
    public function gunaBankSoal($id)
    {
        $model = new M_Soal();
        $modelOpsi = new M_Jawaban();
        // dd($this->request->getPost());
        // d($id);
        $opsi = $this->request->getPost('jmlopsi');
        $adaopsi = $model->cekopsi($id);
        // d($adaopsi);

        $data = array(
            'detail_soal'   => $this->request->getPost("soal"),
            'bank_soal'     => 1
        );
        if ($model->update($id, $data)) {
            for ($a = 1; $a <= intval($opsi); $a++) {
                $jaw = [
                    'id_soal'       => $id,
                    'detail_jawaban'    => ($this->request->getPost("detJaw" . $a) != null) ? $this->request->getPost("detJaw" . $a) : "",
                    'jawaban_benar'     => ($this->request->getPost("benar" . $a) != null) ? $this->request->getPost("benar" . $a) : 0
                ];
                if (count($adaopsi) != intval($opsi)) {
                    $modelOpsi->insert($jaw);
                }
                if (count($adaopsi) == intval($opsi)) {
                    $modelOpsi->update($adaopsi[$a - 1]['id'], $jaw);
                }
            }

            $idujian = intval($this->request->getPost('id_ujian'));
            session()->setFlashdata('success', 'Soal Berhasil Ditambahkan');
            $url = "/Soal/detailQuestion/" . $idujian;
            return redirect()->to(base_url($url));
        }
    }

    public function gambar_soal()
    {
        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        if ($this->request->getFile('file')) {
            $dataFile = $this->request->getFile('file');
            $fileName = $dataFile->getRandomName();
            $dataFile->move(ROOTPATH . 'public/berkas/upload/img-question/', $fileName);
            echo base_url("public/berkas/upload/img-question/$fileName");
        }
    }
    public function gambar_jawaban()
    {
        // if (session()->get('role_users') == null) {
        //     return redirect()->to(base_url('/login/users'));
        // }
        // for ($a = 1; $a <= 5; $a++) {
        //     d($this->request->getFile('file' . $a));
        // }
        // if ($this->request->getFile('file')) {
        //     $dataFile = $this->request->getFile('file');
        //     $fileName = $dataFile->getRandomName();
        //     d($dataFile);
        //     dd($fileName);
        //     $dataFile->move(ROOTPATH . 'public/berkas/upload/img-answer/', $fileName);
        //     echo base_url("public/berkas/upload/img-answer/$fileName");

        //     // if (isset($_FILES["image"]["name"])) {
        //     //     $config['upload_path'] = './assets/images/';
        //     //     $config['allowed_types'] = 'jpg|jpeg|png|gif';
        //     //     $this->upload->initialize($config);
        //     //     if (!$this->upload->do_upload('image')) {
        //     //         $this->upload->display_errors();
        //     //         return FALSE;
        //     //     } else {
        //     //         $data = $this->upload->data();
        //     //         //Compress Image
        //     //         $config['image_library'] = 'gd2';
        //     //         $config['source_image'] = './assets/images/' . $data['file_name'];
        //     //         $config['create_thumb'] = FALSE;
        //     //         $config['maintain_ratio'] = TRUE;
        //     //         $config['quality'] = '60%';
        //     //         $config['width'] = 800;
        //     //         $config['height'] = 800;
        //     //         $config['new_image'] = './assets/images/' . $data['file_name'];
        //     //         $this->load->library('image_lib', $config);
        //     //         $this->image_lib->resize();
        //     //         echo base_url() . 'public/berkas/upload/img-answer/$fileName';
        //     //     }
        //     // }
        // }
        dd("kocak");
    }
    public function edit_gambar_soal()
    {
        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        if ($this->request->getFile('file')) {
            $dataFile = $this->request->getFile('file');
            $fileName = $dataFile->getRandomName();
            $dataFile->move(ROOTPATH . 'public/berkas/upload/img-question/', $fileName);
            echo base_url("public/berkas/upload/img-question/$fileName");
        }
    }
    public function delete_gambar_pengumuman()
    {
        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        $src = $this->request->getVar('src');
        // http://localhost/simpa/
        // https://localhost/simpa/public/berkas/upload/gambar-bimbingan/1635098619_6f735ed2ab5828766855.png
        if ($src) {
            $fileName = str_replace(base_url() . "/", "", $src);
            if (unlink($fileName)) {
                echo "Delete File Berhasil";
                # code...
            }
        }
    }

    public function edit_gambar_jawaban()
    {
        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        if ($this->request->getFile('file')) {
            $dataFile = $this->request->getFile('file');
            $fileName = $dataFile->getRandomName();
            $dataFile->move(ROOTPATH . 'public/berkas/upload/img-answer/', $fileName);
            echo base_url("public/berkas/upload/img-answer/$fileName");
        }
    }
    public function delete_gambar_jawaban()
    {
        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        $src = $this->request->getVar('src');
        // http://localhost/simpa/
        // https://localhost/simpa/public/berkas/upload/gambar-bimbingan/1635098619_6f735ed2ab5828766855.png
        if ($src) {
            $fileName = str_replace(base_url() . "/", "", $src);
            if (unlink($fileName)) {
                echo "Delete File Berhasil";
                # code...
            }
        }
    }



    public function editTest()
    {
        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        $model = new M_Ujian();
        $role_id = $this->request->getPost('id');
        $data = array(
            'role' => $this->request->getPost('editrole'),
        );
        $model->update($role_id, $data);
        $url = "/MasterData/viewTest";
        return redirect()->to(base_url($url));
    }

    public function deleteTest($id)
    {
        $model = new M_Ujian();
        $model->delete($id);
        $url = "/MasterData/viewTest";
        return redirect()->to(base_url($url));
    }
}
