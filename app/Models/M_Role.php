<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Role extends Model
{
	protected $table      = 'role';
	protected $primaryKey = 'id_role';

	protected $useAutoIncrement = true;

	protected $returnType     = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['role'];

	protected $useTimestamps = false;
	function login_teacher($data)
	{
		return $this->db->table('gurulogin')
			->join('guru', 'gurulogin.id_guru = guru.id')
			->join('role', 'guru.id_role = role.id_role')
			->where('username', $data['username'])
			->where('password', $data['password'])
			->get()->getRowArray();
	}
	public function deleteData($id, $con)
	{
		return $this->db->table('role')->delete(array($con => $id));
	}
}
