<?php

namespace App\Controllers;

$request = \Config\Services::request();

use CodeIgniter\Controller;
use App\Models\M_Execution;
use App\Models\M_Kelas;
use App\Models\M_LoginMurid;
use App\Models\M_Murid;
use CodeIgniter\I18n\Time;

class Murid extends BaseController
{


    #----------------------Test----------------------

    function viewMurid()
    {
        $model = new M_Murid();
        $modelKelas = new M_Kelas();

        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        $data['student'] = $model->getAllStudent();
        $data['kelas'] = $modelKelas->SemuaKelas();
        // $data['anggota'] = $modelKelas->classMember();
        // dd($data['anggota']);
        echo view('template/header');
        echo view('template/sidebar');
        echo view('page/murid/view_murid', $data);
        echo view('template/footer');
    }

    public function addMurid()
    {
        $model = new M_Execution();
        if (session()->get('role_users')['role'] !== 'admin') {
            return redirect()->to(base_url('/login/users'));
        }
        $ambil = $this->request->getPost();
        $tgl = date_create($ambil['tgl_lahir']);
        $data = array(
            'id_role'       => 5,
            'name'          => $this->request->getPost('name'),
            'nis'           => $this->request->getPost('nis'),
            'jenkel'        => $this->request->getPost('jenkel'),
            't_lahir'       => $this->request->getPost('t_lahir'),
            'tgl_lahir'     => date_format($tgl, "Y-m-d"),
            'id_class'      => $this->request->getPost('class'),
        );
        $model->simpan_konten('murid', $data);

        $id_murid = $model->getRow('murid', $ambil['nis'], 'nis');
        $password = sha1($ambil['password']);

        $data = array(
            'id_murid' => $id_murid['id'],
            'username' => $this->request->getPost('username'),
            'password' => $password,
            'status' =>  1,
        );
        $url = "/Murid/viewMurid";
        if ($model->simpan_konten('muridlogin', $data)) {
            session()->setFlashdata('success', 'Data Murid Berhasil Ditambahkan');
            return redirect()->to(base_url($url));
        }

        session()->setFlashdata('error', $model->errors());
        return redirect()->to(base_url($url));
    }

    public function deleteMurid($id)
    {
        if (session()->get('role_users')['role'] !== 'admin') {
            return redirect()->to(base_url('/login/users'));
        }
        $modelStudent = new M_Murid();
        $modelLogStudent = new M_LoginMurid();
        $modelStudent->where('id', $id);
        $modelLogStudent->where('id_murid', $id);

        $url = "/Murid/viewMurid";
        if ($modelStudent->delete('murid') && $modelLogStudent->delete('muridlogin')) {
            session()->setFlashdata('error', 'Data Murid Berhasil Dihapus !');
            return redirect()->to(base_url($url));
        }

        session()->setFlashdata('error', $modelStudent->errors());
        return redirect()->to(base_url($url));
    }

    public function editMurid($id)
    {
        if (session()->get('role_users')['role'] !== 'admin') {
            return redirect()->to(base_url('/login/users'));
        }

        $modelStudent = new M_Murid();
        $modelLogStudent = new M_LoginMurid();

        $ambil = $this->request->getPost();
        $tgl = date_create($ambil['tgl_lahir']);

        $data = array(
            'id'            => $id,
            'name'          => $this->request->getPost('name'),
            'nis'           => $this->request->getPost('nis'),
            'id_class'      => $this->request->getPost('class'),
            'jenkel'        => $this->request->getPost('jenkel'),
            't_lahir'       => $this->request->getPost('t_lahir'),
            'tgl_lahir'     => date_format($tgl, "Y-m-d"),
        );
        if ($modelStudent->update($id, $data)) {
            session()->setFlashdata('change', 'Data Murid Berhasil Diubah !');
        }


        $logId = intval($this->request->getPost('id_LogStudent'));
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
        // dd($dataLog);

        $url = "/Murid/viewMurid";
        if ($dataLog['username'] !== null && $dataLog['password'] !== null) {
            if ($modelLogStudent->updateData('muridlogin', $dataLog, $logId, 'id_LogMurid')) {
                session()->setFlashdata('change', 'Data pass Murid Berhasil Diubah !');
                return redirect()->to(base_url($url));
            }

            session()->setFlashdata('error', $modelStudent->errors());
            return redirect()->to(base_url($url));
        }
        return redirect()->to(base_url($url));
    }

    public function myClass()
    {
        if (session()->get('role_users') == null) {
            return redirect()->to(base_url('/login/users'));
        }
        $model = new M_Kelas();
    }
}
