<?php

namespace App\Controllers;

$request = \Config\Services::request();

use CodeIgniter\Controller;
use App\Models\M_Execution;
use App\Models\M_Role;
use App\Models\M_Kelas;
use App\Models\M_Soal;
use App\Models\M_Murid;
use App\Models\M_Mapel;
use App\Models\M_Guru;
use App\Models\M_Ujian;
use CodeIgniter\Exceptions\AlertError;
use DateTime;
use CodeIgniter\I18n\Time;

class Test extends BaseController
{


    #----------------------Test----------------------


    function viewTest()
    {
        $modelUjian = new M_Ujian();
        $modelGuru = new M_Guru();
        $modelKelas = new M_Kelas();
        $modelSubject = new M_Mapel();
        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        $id = intval(session()->get('role_users')['id']);
        $ida = intval(1);

        $data = array(
            'ujian'         => $modelUjian->findTest(),
            'guru'          => $modelGuru->getAllTeacher(),
            'kelas'         => $modelKelas->SemuaKelas(),
            'gujian'        => $modelGuru->findTest(session()->get('role_users')['id']),
            'matapelajaran' => $modelSubject->mySubject($id),
            'matapelajaranA' => $modelSubject->allSubject()
        );
        // d($data);
        echo view('template/header');
        echo view('template/sidebar');
        echo view('page/ujian/view_ujian', $data);
        echo view('template/footer');
    }

    public function addTest()
    {
        $model = new M_Ujian();
        $modelQ = new M_Soal();

        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        $ambil = $this->request->getPost();
        $tanggal = explode(" - ", $ambil['datetimes']);
        // dd($ambil);
        $waktu_mulai = str_replace('/', '-', $tanggal[0]);
        $waktu_selesai = str_replace('/', '-', $tanggal[1]);

        $data = array(
            'nama_ujian'             => $this->request->getPost('nama_ujian'),
            'waktu_mulai'       => $waktu_mulai,
            'waktu_selesai'         => $waktu_selesai,
            'id_guru'               => $this->request->getPost('teacher'),
            'durasi'    => $this->request->getPost('duration'),
            'jml_soal'        => $this->request->getPost('jml_soal'),
            'jml_opsi'          => $this->request->getPost('jml_opsi'),
            'class_id'              => $this->request->getPost('class'),
            'tampil_hasil'           => 1,
            'acak_soal'   => 1,
            'acak_opsi'     => 1,
            'token'                 => $this->request->getPost('token'),
            'mapel'                 => $this->request->getPost('mapel')
        );
        // dd($data['test_name']);
        if ($model->insert($data)) {
            $id = $model->autoQuestion($data['token'], $data['id_guru']);
            $totalSoal = intval($data['jml_soal']);
            for ($a = 1; $a <= $totalSoal; $a++) {
                $soal = array(
                    'id_ujian'            => intval($id['id']),
                    'kategori'            => $id['mapel'],
                    'bank_soal'           => 0
                );
                $modelQ->insertQuestion($soal);
            }
            $url = "/Test/viewTest";
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan !');
            return redirect()->to(base_url($url));
        }
    }

    public function editTest()
    {
        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        $model = new M_Ujian();
        $role_id = $this->request->getPost('id');
        $ambil = $this->request->getPost();
        $tanggal = explode(" - ", $ambil['datetimes']);
        // dd($ambil);
        $waktu_mulai = str_replace('/', '-', $tanggal[0]);
        $waktu_selesai = str_replace('/', '-', $tanggal[1]);
        $data = array(
            'waktu_mulai' => $waktu_mulai,
            'waktu_selesai' => $waktu_selesai,
        );
        $url = "/Test/viewTest";
        if ($model->update($role_id, $data)) {
            session()->setFlashdata('success', 'Data Berhasil Dirubah !');
            return redirect()->to(base_url($url));
        }
        session()->setFlashdata('error', 'Data Gagal Dirubah !');
        return redirect()->to(base_url($url));
    }


    public function deleteTest($id)
    {
        $model = new M_Ujian();
        $model->deleteData($id, 'id');
        $url = "/Test/viewTest";
        if ($model->deleteData($id, 'id')) {
            session()->setFlashdata('error', 'Data Test Berhasil Dihapus !');
            return redirect()->to(base_url($url));
        }
        return redirect()->to(base_url($url));
        session()->setFlashdata('error', $model->errors());
    }
    function testDashboard($id)
    {
        $modelUjian = new M_Ujian();
        $modelGuru = new M_Guru();
        $modelKelas = new M_Kelas();
        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }

        $data['tes'] = $modelUjian->questionView($id);
        $data['option'] = $modelUjian->answerView();
        $data['ujian'] = $modelUjian->getTest($id);

        $token = $this->request->getPost('token');
        $tokken = $this->request->getPost('tokken');

        // dd(session()->get('participant') == null);
        if ($token === $tokken) {
            $cekP = $modelUjian->existParticipant();
            $tes = intval($this->request->getPost('id'));
            if (session()->get('participant') == null) {
                $cekP = $modelUjian->existParticipant();
                $par = array(
                    'id_murid'      => intval(session()->get('role_users')['id']),
                    'id_ujian'       => intval($data['ujian']['id']),
                    'status'        => 1,
                    'dibuat'    => date('Y-m-d H:i:s'),
                    'diperbarui'    => date('Y-m-d H:i:s'),
                    'waktu'         => intval($data['ujian']['durasi']),
                );

                $exist = 0;
                for ($a = 0; $a < count($cekP); $a++) {
                    if ($cekP[$a]['id_murid'] == $par['id_murid'] && $cekP[$a]['id_ujian'] == $par['id_ujian']) {
                        $exist = 1;
                    }
                }
                if ($exist == 0) {
                    $modelUjian->participant($par);
                    $jaw = array(
                        'id_murid'   => $par['id_murid'],
                        'id_ujian'   => $par['id_ujian']
                    );

                    $startTime = date('Y-m-d H:i:s');
                    $waktu = intval($data['ujian']['durasi']);
                    $cenvertedTime = date('Y-m-d H:i:s', strtotime('+' . $waktu . ' minutes', strtotime($startTime)));

                    $room = array(
                        'id_murid'        => intval(session()->get('role_users')['id']),
                        'nama_student'      => session()->get('role_users')['name'],
                        'durasi'            => intval($data['ujian']['durasi']),
                        'durasi_selesai'    => $cenvertedTime,
                        'durasi_mulai'      => $startTime,
                        'id_test'           => intval($data['ujian']['id']),
                        'mapel_test'        => $data['ujian']['mapel'],
                        'answer'            => 0,
                        'jml_soal'    => intval($data['ujian']['jml_soal']),
                        'jml_opsi'      => intval($data['ujian']['jml_opsi'])
                    );

                    $modelUjian->createAnswer($jaw);
                    session()->set('participant', $room);
                    return view('page/ujian/test_main', $data);
                }
                // d(session()->get());
                if ($exist == 1) {
                    $url = "Test/viewExamStudent";
                    // unset($_SESSION["participant"]);
                    session()->setFlashdata("error", "Anda Telah Mengerjakan Ujian ini");
                    return redirect()->back()->to(base_url($url));
                }
            }
            if (session()->get('participant') != null) {
                $now = date('Y-m-d H:i:s');
                $n = strtotime($now);
                $endTime = date(session()->get('participant')['durasi_selesai']);
                $x = strtotime($endTime);
                // d(session()->get());

                $exist = 0;
                for ($a = 0; $a < count($cekP); $a++) {
                    if ($cekP[$a]['id_murid'] == session()->get('participant')['id_murid'] && $cekP[$a]['id_ujian'] == $tes) {
                        $exist = 1;
                    }
                }
                // dd($exist);
                if ($exist == 1 && $x > $n) {
                    return view('page/ujian/test_main', $data);
                }
                // if ($x < $n) {

                //     $url = "Test/examWork";
                //     unset($_SESSION["participant"]);
                //     return redirect()->to(base_url($url));
                // }
            }
        }

        $url = "Test/viewExamStudent";
        session()->setFlashdata("error", "Token Salah, perhatikan huruf besar kecil");
        return redirect()->back()->to(base_url($url));
        // dd($data['option']);
    }
    function examWork()
    {
        $modelUjian = new M_Ujian();
        $modelExe = new M_Execution();
        $modelKelas = new M_Kelas();
        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        if (session()->get('participant') == null) {
            $url = "Test/viewExamStudent";
            return redirect()->back()->to(base_url($url));
        }
        // $nilai = $modelUjian->nilai(session()->get('participant')['id_student'], session()->get('participant')['id_test']);
        // d($nilai);
        $p = 0;
        for ($a = 1; $a <= session()->get('participant')['jml_soal']; $a++) {
            $soal = $modelUjian->truefalse($this->request->getPost('idSoal' . $a));
            $jawab = $this->request->getPost('optionTrue' . $a);
            // dd($soal);
            if ($soal['answerid'] == $jawab) {
                $p = $p + 1;
            }
        }
        $score = $p / session()->get('participant')['jml_soal'] * 100;
        $data = array(
            'jawaban_benar'        => $p,
            'nilai_ujian'    => round($score)
        );
        // d($data);
        if ($modelUjian->update_nilai($data, session()->get('participant')['id_murid'], session()->get('participant')['id_test'])) {
            $url = "/Test/viewExamStudent";
            $it = $data;
            unset($_SESSION["participant"]);
            // d(session()->get());
            // d($it);
            echo view('template/header');
            echo view('page/murid/nilai', $it);
            echo view('template/footer');
        }
    }

    function viewScore()
    {
        echo view('template/header');
        echo view('template/sidebar');
        echo view('page/murid/nilai');
        echo view('template/footer');
        // d(session()->get());
    }
    function viewExamStudent()
    {
        $modelUjian = new M_Ujian();
        $modelGuru = new M_Guru();
        $modelKelas = new M_Kelas();
        $modelMurid = new M_Murid();

        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        // d(session()->get());
        // d(session()->get('participant'));


        $subject =  intval(session()->get('role_users')['id_class']);

        $data['ujian'] = $modelUjian->testMurid($subject);
        // dd($data);
        // dd($data['ujian']);
        echo view('template/header');
        echo view('template/sidebar');
        echo view('page/murid/ujian', $data);
        echo view('template/footer');
    }
}
