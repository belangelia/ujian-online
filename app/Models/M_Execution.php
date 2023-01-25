<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Execution extends Model
{

	public function select_konten($tabel)
	{
		$query = $this->db->query("select * from $tabel");
		return $query->getResultArray();
	}

	public function simpan_konten($tabel, $data)
	{
		$query = $this->db->table($tabel)->insert($data);
		return $query;
	}

	public function getKonten($tabel, $id, $kondisi)
	{
		$query = $this->db->query("select * from $tabel where $kondisi = $id");
		return $query->getResultArray();
	}

	public function update_konten($tabel, $data, $id, $kondisi)
	{
		$query = $this->db->table($tabel)->update($data, array($kondisi => $id));
		return $query;
	}


	public function hapus_konten($tabel, $id, $kondisi)
	{
		$query = $this->db->table($tabel)->delete(array($kondisi => $id));
		return $query;
	}

	public function joinSatuTable($table, $table2, $id, $idTable2)
	{
		$query = $this->db->query("select * from $table JOIN $table2 ON $table2.$idTable2 = $table.$id");
		return $query->getResultArray();
	}

	public function getRow($tabel, $id, $kondisi)
	{
		$query = $this->db->query("select * from $tabel where $kondisi = $id");
		return $query->getRowArray();
	}
	public function getRowString($tabel, $id, $kondisi)
	{
		$query = $this->db->query("select * from $tabel where $kondisi = '$id'");
		return $query->getRowArray();
	}
}
