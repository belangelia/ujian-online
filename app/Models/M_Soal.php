<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Soal extends Model
{
	protected $table      = 'soal';
	protected $primaryKey = 'id';

	protected $useAutoIncrement = true;

	protected $returnType     = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['id_ujian', 'id', 'detail_soal', 'kategori', 'bank_soal'];

	protected $useTimestamps = false;



	function findTest()
	{
		return $this->db->table('ujian')
			->select('ujian.*,guru.nama,kelas.kelas')
			->join('guru', 'ujian.id_guru = guru.id')
			->join('kelas', 'ujian.class_id = kelas.id')
			->get()->getResultArray();
	}
	function findQuestion($id)
	{
		return $this->db->table('soal')
			->select('soal.*')
			->orderBy('rand()')
			->get()->getResultArray();
		// shuffle($shuffled_query);
	}
	function findTestId($id)
	{
		return $this->db->table('ujian')
			->select('ujian.*,guru.nama,kelas.kelas')
			->join('guru', 'ujian.id_guru = guru.id')
			->join('kelas', 'ujian.class_id = kelas.id')
			->where('ujian.id', $id)
			->get()->getRowArray();
	}
	function jumlah()
	{
		return $this->db->table('soal')
			->select('soal.*,jawaban.detail_jawaban, jawaban.jawaban_benar')
			->join('jawaban', 'soal.id=jawaban.id_soal')
			->get()->getResultArray();
	}
	function cekopsi($id)
	{
		return $this->db->table('jawaban')
			->where('id_soal', $id)
			->get()->getResultArray();
	}

	function ujianSoal($id)
	{
		return $this->db->table('ujian')
			->where('id', $id)
			->get()->getRowArray();
	}
	function dQuestion($id)
	{
		return $this->db->table('soal')
			->where('id_ujian', $id)
			->get()->getResultArray();
	}

	function bankSoal()
	{
		return $this->db->table('soal')
			->where('detail_soal', !"null")
			->where('bank_soal', 0)
			->get()->getResultArray();
	}
	function bankJawaban()
	{
		return $this->db->table('jawaban')
			->get()->getResultArray();
	}

	function insertQuestion($data)
	{
		return $this->db->table('soal')->where('detail_soal', null)->insert($data);
	}

	function editAnswer($id)
	{
		return $this->db->table('jawaban')
			->select('jawaban.*, soal.id as que_id')
			->join('soal', 'soal.id = jawaban.id_soal')
			->where('id_soal', $id)
			->get()->getResultArray();
	}
}
