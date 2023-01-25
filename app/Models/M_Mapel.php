<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Mapel extends Model
{
	protected $table      = 'mapel';
	protected $primaryKey = 'id';

	protected $useAutoIncrement = true;

	protected $returnType     = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['code', 'name', 'id_guru'];

	protected $useTimestamps = false;



	function allSubject()
	{
		return $this->db->table('mapel as s')
			->select('s.id, s.code, s.name,s.id_guru, g.nama')
			->join('guru as g', 's.id_guru = g.id')
			->get()->getResultArray();
	}
	function mySubject($id)
	{
		return $this->db->table('mapel')
			->where('id_guru', $id)
			->get()->getResultArray();
	}
	public function deleteData($id, $con)
	{
		return $this->db->table('mapel')->delete(array($con => $id));
	}
}
