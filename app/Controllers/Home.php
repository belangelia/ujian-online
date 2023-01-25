<?php

namespace App\Controllers;

$session = \Config\Services::session();

use App\Models\M_Execution;
use App\Models\M_Kelas;
use App\Models\M_Murid;
use App\Models\M_Guru;
use App\Models\M_Mapel;
use CodeIgniter\Model;

class Home extends BaseController
{

	function index()
	{
		$mClass = new M_Kelas();
		$mstudent = new M_Murid();
		$mTeacher = new M_Guru();
		$mSubject = new M_Mapel();
		// dd(session()->get('role_users'));
		// d(session()->get());
		if (session()->get('role_users') == null) {
			return redirect()->to(base_url('/login/users'));
		}
		$id = intval(session()->get('role_users')['id']);

		echo view('template/header');
		echo view('template/sidebar');
		if (session()->get('role_users')['role'] === "admin") {
			$data = array(
				'kelas'		=> count($mClass->allClass()),
				'murid'		=> count($mstudent->getAllStudent()),
				'guru'		=> count($mTeacher->getAllTeacher()),
				'subject'	=> count($mSubject->allSubject()),
			);
			echo view('menuutama', $data);
		} else if (session()->get('role_users')['role'] === "Guru") {
			$data = array(
				'kelas'		=> $mClass->myClass($id),
				'murid'		=> count($mTeacher->myStudent($id)),
				'subject'	=> $mSubject->mySubject($id),
			);
			echo view('menuutama', $data);
		} else if (session()->get('role_users')['role'] === "Peserta") {
			$data = array(
				'guru'		=> $mClass->myTeacher(session()->get('role_users')['id_class'])
			);
			echo view('menuutama', $data);
		} else {
			echo view('menuutama');
		}
		echo view('template/footer');
	}
}
