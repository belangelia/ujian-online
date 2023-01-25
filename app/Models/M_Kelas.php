<?php

namespace App\Models;

use CodeIgniter\Model;
use LDAP\Result;

class M_Kelas extends Model
{
	protected $table      = 'kelas';
	protected $primaryKey = 'id';

	protected $useAutoIncrement = true;

	protected $returnType     = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['kelas', 'id_guru'];

	protected $useTimestamps = false;

	function allClass()
	{
		return $this->db->table('kelas as c')
			->select('c.id, c.kelas, c.id_guru, g.nama')
			->join('guru as g', 'c.id_guru = g.id')
			->get()->getResultArray();
	}

	function classMember($id)
	{
		return $this->db->table('murid')
			->join('kelas', 'murid.id_class = kelas.id')
			->join('guru', 'kelas.id = guru.id')
			->where('kelas.id_guru', $id)
			->get()->getResultArray();
	}
	function SemuaKelas()
	{
		return $this->db->table('kelas')->get()->getResultArray();
	}
	function myClass($id)
	{
		return $this->db->table('kelas')
			->where('id_guru', $id)
			->get()->getResult();
	}
	function myTeacher($id)
	{
		return $this->db->table('kelas as c')
			->select('c.id, c.kelas, c.id_guru, g.nama')
			->join('guru as g', 'c.id_guru = g.id')
			->where('c.id', $id)
			->get()->getRow();
	}
	public function deleteData($id, $con)
	{
		$query = $this->db->table('kelas')->delete(array($con => $id));
		return $query;
	}
}
