<?php

namespace App\Controllers;

$request = \Config\Services::request();

use CodeIgniter\Controller;
use App\Models\M_Role;
use App\Models\M_Kelas;
use App\Models\M_Mapel;
use App\Models\M_Guru;

class MasterData extends BaseController
{

    #----------------------Kelas----------------------

    function viewKelas()
    {
        $model = new M_Kelas();
        $modelTeacher = new M_Guru();
        if (session()->get('role_users')['role'] !== 'admin') {
            return redirect()->to(base_url('/login/users'));
        }
        $data['class'] = $model->allClass();

        $data['teacher'] = $modelTeacher->where('id_role', 4)->findAll();
        echo view('template/header');
        echo view('template/sidebar');
        echo view('page/kelas/view_kelas', $data);
        echo view('template/footer');
    }

    public function addKelas()
    {
        $model = new M_Kelas();
        if (session()->get('role_users')['role'] !== 'admin') {
            return redirect()->to(base_url('/login/users'));
        }
        $data = array(
            'kelas'         => $this->request->getPost('class'),
            'id_guru'  => intval($this->request->getPost('wali')),
        );
        $url = "/MasterData/viewKelas";
        if ($model->insert($data)) {

            session()->setFlashdata('success', 'Data Kelas Berhasil Ditambahkan');
            return redirect()->to(base_url($url));
        }
        session()->setFlashdata('error', $model->errors());
        return redirect()->to(base_url($url));
    }

    public function editKelas($id)
    {
        if (session()->get('role_users')['role'] !== 'admin') {
            return redirect()->to(base_url('/login/users'));
        }
        $model = new M_Kelas();
        $data = array(
            'kelas'         => $this->request->getPost('editclass'),
            'id_guru'  => intval($this->request->getPost('wali')),
        );
        $url = "/MasterData/viewKelas";
        if ($model->update($id, $data)) {

            session()->setFlashdata('change', 'Data Kelas Berhasil Diubah !');
            return redirect()->to(base_url($url));
        }
        session()->setFlashdata('error', $model->errors());
        return redirect()->to(base_url($url));
    }

    public function deleteKelas($id)
    {
        if (session()->get('role_users')['role'] !== 'admin') {
            return redirect()->to(base_url('/login/users'));
        }
        $model = new M_Kelas();
        $url = "/MasterData/viewKelas";
        if ($model->deleteData($id, 'id')) {
            session()->setFlashdata('error', 'Data Kelas Berhasil Dihapus !');
            return redirect()->to(base_url($url));
        }
        return redirect()->to(base_url($url));
        session()->setFlashdata('error', $model->errors());
    }

    #----------------------Mapel----------------------

    function viewMapel()
    {
        $model = new M_Mapel();
        $modelGuru = new M_Guru();
        if (session()->get('role_users')['role'] !== 'admin') {
            return redirect()->to(base_url('/login/users'));
        }
        $data['subject'] = $model->allSubject();
        $data['teacher'] = $modelGuru->where('id_role', 4)->findAll();
        // dd($data['subject']);
        echo view('template/header');
        echo view('template/sidebar');
        echo view('page/mapel/view_mapel', $data);
        echo view('template/footer');
    }

    public function addMapel()
    {
        $model = new M_Mapel();
        if (session()->get('role_users')['role'] !== 'admin') {
            return redirect()->to(base_url('/login/users'));
        }
        $data = array(
            'code'          => $this->request->getPost('code'),
            'name'          => $this->request->getPost('subject'),
            'id_guru'  => $this->request->getPost('guru'),
        );
        $url = "/MasterData/viewMapel";
        if ($model->insert($data)) {

            session()->setFlashdata('success', 'Mata Pelajaran Berhasil Ditambahkan');
            return redirect()->to(base_url($url));
        }
        session()->setFlashdata('error', $model->errors());
        return redirect()->to(base_url($url));
    }

    public function editMapel($id)
    {
        if (session()->get('role_users')['role'] !== 'admin') {
            return redirect()->to(base_url('/login/users'));
        }
        $model = new M_Mapel();
        $data = array(
            'name'          => $this->request->getPost('editsubject'),
            'code'          => $this->request->getPost('editcode'),
            'id_guru'  => intval($this->request->getPost('guru')),
        );
        $url = "/MasterData/viewMapel";

        if ($model->update($id, $data)) {

            session()->setFlashdata('change', 'Data Mata Pelajaran Berhasil Diubah !');
            return redirect()->to(base_url($url));
        }
        session()->setFlashdata('error', $model->errors());
        return redirect()->to(base_url($url));
    }

    public function deleteMapel($id)
    {
        if (session()->get('role_users')['role'] !== 'admin') {
            return redirect()->to(base_url('/login/users'));
        }
        $model = new M_Mapel();
        $url = "/MasterData/viewMapel";
        if ($model->deleteData($id, 'id')) {
            session()->setFlashdata('error', 'Mata Pelajaran Berhasil Dihapus !');
            return redirect()->to(base_url($url));
        }
        return redirect()->to(base_url($url));
        session()->setFlashdata('error', $model->errors());
    }
}
