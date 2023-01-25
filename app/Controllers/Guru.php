<?php

namespace App\Controllers;

$request = \Config\Services::request();

use CodeIgniter\Controller;
use App\Models\M_Execution;
use App\Models\M_Role;
use App\Models\M_Kelas;
use App\Models\M_LoginGuru;
use App\Models\M_Murid;
use App\Models\M_Ujian;
use App\Models\M_Guru;
use DateTime;

class Guru extends BaseController
{



    #----------------------Test----------------------

    function viewGuru()
    {
        $model = new M_Guru();
        if (session()->get('role_users')['role'] !== 'admin') {
            session()->setFlashdata('error', 'Anda Bukan Admin! Harap Login Sebagai Admin');
            return redirect()->to(base_url('/login/users'));
        }
        $data['teacher'] = $model->getAllTeacher();
        echo view('template/header');
        echo view('template/sidebar');
        echo view('page/guru/view_guru', $data);
        echo view('template/footer');
    }

    public function addGuru()
    {
        $model = new M_Execution();
        if (session()->get('role_users')['role'] !== 'admin') {
            session()->setFlashdata('error', 'Anda Bukan Admin! Harap Login Sebagai Admin');
            return redirect()->to(base_url('/login/users'));
        }
        $ambil = $this->request->getPost();
        if (!$this->validate([
            'foto' => [
                'rules' => 'max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]',
            ]
        ])) {
            session()->setFlashdata('error', 'Harap melampirkan file jpg/jpeg/png dengan Max ukuran 2MB');
            $url = "/Guru/viewGuru";
            return redirect()->to(base_url($url));
        }
        helper(['form', 'url']);
        $model = new M_Execution();
        $tanggal_now = date('Y-m-d');
        $time = date('Y-m-d h:i:s');
        $file1 = $this->request->getFile('foto');
        $newName = $file1->getRandomName();
        $ambil = $this->request->getPost();
        $tgl = date_create($ambil['tgl_lahir']);

        // dd($tgl_lahir);

        if ($file1->getError() == 4) {
            if ($this->request->getPost('gender') == 'Perempuan') {
                $foto = 'user_wanita.png';
            } else {
                $foto = 'user_pria.png';
            }
            $data = array(
                'id_role' => 4,
                'nama' => $this->request->getPost('name'),
                'nip' => $this->request->getPost('nogur'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tgl_lahir' => date_format($tgl, "Y-m-d"),
                'jenkel' => $this->request->getPost('gender'),
                'agama' => $this->request->getPost('agama'),
                'email' => $this->request->getPost('email'),
                'telp' => $this->request->getPost('phone'),
                'alamat' => $this->request->getPost('alamat'),
                'tgl_buat' =>  $time,
                'foto' => $foto,
            );
            $model->simpan_konten('guru', $data);

            $id_guru = $model->getRow('guru', $ambil['nogur'], 'nip');
            $password = sha1($ambil['password']);

            $data = array(
                'id_guru' => $id_guru['id'],
                'username' => $this->request->getPost('username'),
                'password' => $password,
                'status' =>  1,
            );

            $url = "/Guru/viewGuru";
            if ($model->simpan_konten('gurulogin', $data)) {
                session()->setFlashdata('success', 'Data Guru Berhasil Ditambahkan');
                return redirect()->to(base_url($url));
            }

            session()->setFlashdata('error', $model->errors());
            return redirect()->to(base_url($url));
        } else {
            $file1->move(ROOTPATH . 'public/berkas/users/teachers', $newName);
            $data = array(
                'id_role' => 4,
                'nama' => $this->request->getPost('name'),
                'nip' => $this->request->getPost('nogur'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tgl_lahir' => date_format($tgl, "Y-m-d"),
                'jenkel' => $this->request->getPost('gender'),
                'agama' => $this->request->getPost('agama'),
                'email' => $this->request->getPost('email'),
                'telp' => $this->request->getPost('phone'),
                'alamat' => $this->request->getPost('alamat'),
                'tgl_buat' =>  $time,
                'foto' => $newName,
            );

            $model->simpan_konten('guru', $data);
            $id_guru = $model->getRow('guru', $ambil['nogur'], 'nip');
            $password = sha1($ambil['password']);

            $data1 = array(
                'id_guru' => $id_guru['id'],
                'username' => $this->request->getPost('username'),
                'password' => $password,
                'status' =>  1,
            );

            $url = "/Guru/viewGuru";
            if ($model->simpan_konten('gurulogin', $data1)) {
                session()->setFlashdata('success', 'Data Guru Berhasil Ditambahkan');
                return redirect()->to(base_url($url));
            }

            session()->setFlashdata('error', $model->errors());
            return redirect()->to(base_url($url));
        }
    }

    public function deleteGuru($id)
    {
        if (session()->get('role_users')['role'] !== 'admin') {
            session()->setFlashdata('error', 'Anda Bukan Admin! Harap Login Sebagai Admin');
            return redirect()->to(base_url('/login/users'));
        }
        $modelTeacher = new M_Guru();
        $modelLogTeacher = new M_LoginGuru();
        $modelTeacher->where('id', $id);
        $modelLogTeacher->where('id_guru', $id);

        $url = "/Guru/viewGuru";
        if ($modelTeacher->delete('guru') && $modelLogTeacher->delete('gurulogin')) {
            session()->setFlashdata('error', 'Data Guru Berhasil Dihapus !');
            return redirect()->to(base_url($url));
        }

        session()->setFlashdata('error', $modelTeacher->errors());
        return redirect()->to(base_url($url));
    }

    public function editGuru($id)
    {
        if (session()->get('role_users')['role'] !== 'admin') {
            session()->setFlashdata('error', 'Anda Bukan Admin! Harap Login Sebagai Admin');
            return redirect()->to(base_url('/login/users'));
        }

        $modelTeacher = new M_Guru();
        $modelLogTeacher = new M_LoginGuru();

        if (!$this->validate([
            'foto' => [
                'rules' => 'max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]',
            ]
        ])) {
            session()->setFlashdata('error', 'file harus jpg/jpeg/png');
            $url = "/Guru/viewGuru";
            return redirect()->to(base_url($url));
        }

        $ambil = $this->request->getPost();
        $tgl = date_create($ambil['tgl_lahir']);

        $data = array(
            'nama'          => $this->request->getPost('name'),
            'nip'          => $this->request->getPost('nogur'),
            'email'         => $this->request->getPost('email'),
            'telp'          => $this->request->getPost('phone'),
            'agama'         => $this->request->getPost('agama'),
            'tempat_lahir'  => $this->request->getPost('tempat_lahir'),
            'tgl_lahir'     => date_format($tgl, "Y-m-d"),
            'jenkel'        => $this->request->getPost('gender'),
            'alamat'        => $this->request->getPost('alamat'),
        );
        $foto = $this->request->getFile('foto');
        if ($foto->getError() !== 4) {
            if (!$this->validate([
                'foto' => [
                    'rules' => 'mime_in[foto,image/jpg,image/jpeg,image/png]',
                ]
            ])) {
                session()->setFlashdata('error', 'file harus jpg/jpeg/png');
                $url = "/Guru/viewGuru";
                return redirect()->to(base_url($url));
            }
            $fileNew = $this->request->getFile('foto');
            $fileOld = $this->request->getPost('recentfoto');
            if ($fileOld === "user_pria.png" || $fileOld === "user_wanita.png") {
                $data['foto'] = $fileOld;
            }
            $newName = $fileNew->getRandomName();
            $path = FCPATH . 'public/berkas/users/teachers/' . $fileOld;
            unlink($path);
            $fileNew->move(FCPATH . 'public/berkas/users/teachers', $newName);
        } else {
            $data['foto'] = $this->request->getPost('recentfoto');
        }
        if ($modelTeacher->update($id, $data)) {
            session()->setFlashdata('change', 'Data Guru Berhasil Diubah !');
        }

        $logId = intval($this->request->getPost('id_LogTeacher'));
        if ($this->request->getPost('username') !== "") {
            $dataLog['username'] = $this->request->getPost('username');
        } else {
            $dataLog['username'] = null;
        }
        if ($this->request->getPost('password') !== "") {
            $password = sha1($this->request->getVar('password'));
            $dataLog['password'] = $password;
        } else {
            $dataLog['password'] = null;
        }


        $url = "/Guru/viewGuru";
        if ($dataLog['username'] !== null && $dataLog['password'] !== null) {
            if ($modelLogTeacher->updateData('gurulogin', $dataLog, $logId, 'id_LogGuru')) {
                session()->setFlashdata('change', 'Data Guru Berhasil Diubah !');
                return redirect()->to(base_url($url));
            }

            session()->setFlashdata('error', $modelLogTeacher->errors());
            return redirect()->to(base_url($url));
        }
        return redirect()->to(base_url($url));
    }
    public function myStudent()
    {
        if (session()->get('role_users') === null) {
            session()->setFlashdata('error', 'Harap Login Terlebih Dahulu');
            return redirect()->to(base_url('/login/users'));
        }
        if (session()->get('role_users')['role'] !== 'Guru') {
            return redirect()->to(base_url('/login/users'));
        }

        $model = new M_Guru();
        $modelKelas = new M_Kelas();

        $id = intval(session()->get('role_users')['id']);

        $data['student'] = $model->myStudent($id);
        $data['kelas'] = $modelKelas->myClass($id);
        echo view('template/header');
        echo view('template/sidebar');
        echo view('page/guru/muridku', $data);
        echo view('template/footer');
    }
    public function myStudentScore()
    {
        if (session()->get('role_users') === null) {
            session()->setFlashdata('error', 'Harap Login Terlebih Dahulu');
            return redirect()->to(base_url('/login/users'));
        }
        if (session()->get('role_users')['role'] !== 'Guru') {
            session()->setFlashdata('error', 'Harap Login Sebagai Guru');
            return redirect()->to(base_url('/login/users'));
        }
        $model = new M_Guru();
        $modelKelas = new M_Kelas();

        $id = intval(session()->get('role_users')['id']);

        $data['student'] = $model->myStudent($id);
        $data['score'] = $model->score();
        $data['kelas'] = $modelKelas->myClass($id);

        // dd($data['score']);
        echo view('template/header');
        echo view('template/sidebar');
        echo view('page/guru/nilai_murid_kelas', $data);
        echo view('template/footer');
    }

    public function myTestScore()
    {
        if (session()->get('role_users') === null) {
            session()->setFlashdata('error', 'Harap Login Terlebih Dahulu');
            return redirect()->to(base_url('/login/users'));
        }
        if (session()->get('role_users')['role'] !== 'Guru') {
            session()->setFlashdata('error', 'Harap Login Sebagai Guru');
            return redirect()->to(base_url('/login/users'));
        }
        $model = new M_Guru();
        $modelKelas = new M_Kelas();

        $id = intval(session()->get('role_users')['id']);

        $data['student'] = $model->testScore($id);
        $data['murid'] = $model->scoreMurid();
        // dd($data);

        echo view('template/header');
        echo view('template/sidebar');
        echo view('page/guru/nilai_mapel', $data);
        echo view('template/footer');
    }
}
