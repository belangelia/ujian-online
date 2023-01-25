<?php

namespace App\Controllers;

use App\Models\M_Guru;
use App\Models\M_Murid;
use App\Models\M_Soal;

$session = \Config\Services::session();
class Login extends BaseController
{
	protected $M_Guru;
	protected $M_Murid;
	public function __construct()
	{
		$this->M_Guru = new M_Guru();
		$this->M_Murid = new M_Murid();
		// $this->$session = \Config\Services::session();
		// $this->session->start();
		// $model = new user();
	}

	public function users()
	{
		return view('login');
	}
	public function user()
	{

		$data = $this->request->getPost();
		$modelQuestion = new M_Soal();
		$data['soal'] = $modelQuestion->findQuestion(1);

		$data['password'] = sha1($data['password']);
		if ($data) {
			$guru = $this->M_Guru->login_teacher($data);
			$murid = $this->M_Murid->login_student($data);

			if ($guru > 0) {
				$account = [
					'log' 			=> TRUE,
					'id' 			=> $guru['id'],
					'id_log' 		=> $guru['id_LogGuru'],
					'username' 		=> $guru['username'],
					'password' 		=> $guru['password'],
					'tgl_buat' 		=> $guru['tgl_buat'],
					'status' 		=> $guru['status'],
					'id_lev' 		=> $guru['id_role'],
					'nama' 			=> $guru['nama'],
					'nip' 			=> $guru['nip'],
					'tempat_lahir' 	=> $guru['tempat_lahir'],
					'tgl_lahir' 	=> $guru['tgl_lahir'],
					'jenkel' 		=> $guru['jenkel'],
					'email' 		=> $guru['email'],
					'telp' 			=> $guru['telp'],
					'foto' 			=> $guru['foto'],
					'role' 			=> $guru['role'],

				];
				$level = $account['role'];
				// dd($data['soal']);

				// for ($i = 0; $i < count($data['soal']); $i++) {
				// 	$soal = array(array($data['soal'][$i]));
				// }

				session()->set('role_users', $account);
				// session()->set('question', $soal);
				// dd(session()->get('level_users'));
				return redirect()->to(base_url("Home"));
			}
			if ($murid > 0) {
				$account = [
					'log' 		=> TRUE,
					'id' 		=> $murid['id_murid'],
					'id_log' 	=> $murid['id_LogMurid'],
					'username' 	=> $murid['username'],
					'password' 	=> $murid['password'],
					'id_lev' 	=> $murid['id_role'],
					'name' 		=> $murid['name'],
					'nis' 		=> $murid['nis'],
					'id_class'	=> $murid['id_class'],
					'kelas' 	=> $murid['kelas'],
					'role' 		=> $murid['role'],
					'jenkel'	=> $murid['jenkel'],
					't_lahir'	=> $murid['t_lahir'],
					'tgl_lahir'	=> $murid['tgl_lahir']

				];
				$level = $account['role'];

				// for ($i = 0; $i < count($data['soal']); $i++) {
				// 	$soal = array(array($data['soal'][$i]));
				// }

				session()->set('role_users', $account);
				// session()->set('question', $soal);
				// dd(session()->get('level_users'));
				return redirect()->to(base_url("Home"));
			}
			session()->setFlashdata('error', 'Username atau Password Salah');
			return redirect()->to(base_url('Login/users'));
		}

		// return view('login');
	}


	function logout()
	{
		session_destroy();
		return redirect()->to(base_url('Login/users', 'refresh'));
	}
}
