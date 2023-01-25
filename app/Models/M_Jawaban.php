<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Jawaban extends Model
{
	protected $table      = 'jawaban';
	protected $primaryKey = 'id';

	protected $useAutoIncrement = true;

	protected $returnType     = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['id_soal', 'id', 'detail_jawaban', 'jawaban_benar'];

	protected $useTimestamps = false;



	function findTest()
	{
		return $this->db->table('ujian')
			->select('ujian.*,guru.nama,kelas.kelas')
			->join('guru', 'ujian.id_guru = guru.id')
			->join('kelas', 'ujian.class_id = kelas.id')
			->get()->getResultArray();
	}
	function findAnswer($id)
	{
		return $this->db->table('jawaban')
			->select('jawaban.*')
			->join('soal', 'soal.id = jawaban.id_soal')
			->where('soal.id_ujian', $id)
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
}
