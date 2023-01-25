<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Murid extends Model
{
	protected $table = 'murid';
	public $key = 'id';
	protected $date_format = 'datetime';
	protected $set_created = TRUE;
	protected $set_modified = TRUE;
	protected $soft_deletes = TRUE;
	protected $allowedFields = [
		'name',
		'nis',
		'jenkel',
		't_lahir',
		'tgl_lahir',
		'id_class',
	];

	function login_student($data)
	{
		return $this->db->table('muridlogin')
			->join('murid', 'muridlogin.id_murid = murid.id')
			->join('role', 'murid.id_role = role.id_role')
			->join('kelas', 'murid.id_class = kelas.id')
			->where('username', $data['username'])
			->where('password', $data['password'])
			->get()->getRowArray();
	}
	function getAllStudent()
	{
		return $this->db->table('muridlogin')
			->join('murid', 'muridlogin.id_murid = murid.id')
			->join('role', 'murid.id_role = role.id_role')
			->join('kelas', 'murid.id_class = kelas.id')
			->where('murid.id_role', 5)
			->get()->getResultArray();
	}
	function deleteLoginStudent($id)
	{
		return $this->db->table('muridlogin')
			->delete($id);
	}
}
