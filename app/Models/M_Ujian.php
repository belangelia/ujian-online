<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Ujian extends Model
{
	protected $table      = 'ujian';
	protected $primaryKey = 'id';

	protected $useAutoIncrement = true;

	protected $returnType     = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['nama_ujian', 'id_guru', 'waktu_mulai', 'waktu_selesai', 'durasi', 'jml_soal', 'jml_opsi', 'acak_opsi', 'acak_soal', 'token', 'tampil_hasil', 'class_id', 'mapel'];

	protected $useTimestamps = false;



	function findTest()
	{
		return $this->db->table('ujian')
			->select('ujian.*,guru.nama,kelas.kelas')
			->join('guru', 'ujian.id_guru = guru.id')
			->join('kelas', 'ujian.class_id = kelas.id')

			->get()->getResultArray();
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
	function testMurid($subject)
	{
		return $this->db->table('ujian')
			->select('ujian.*,guru.nama, kelas.kelas')
			->join('guru', 'ujian.id_guru = guru.id')
			->join('kelas', 'ujian.class_id = kelas.id')
			->where('ujian.class_id', $subject)
			->get()
			->getResultArray();
	}
	function joinTest($id)
	{
		return $this->db->table('ujian')->select('ujian.* , soal.* , mapel.code, mapel.name')
			->join('soal', 'soal.id_ujian = ujian.id')
			->join('mapel', 'ujian.id_guru = mapel.id_guru')
			->where('ujian.id', $id)
			->get()
			->getResultArray();
	}

	function optionAnswer()
	{
		return $this->db->table('jawaban')
			->select('soal.*, jawaban.*')
			->join('soal', 'jawaban.id_soal = soal.id')
			// ->where('answer.question_id', 9)
			->get()
			->getResultArray();
	}

	function autoQuestion($token, $id_teacher)
	{
		return $this->db->table('ujian')
			->where('id_guru', $id_teacher)
			->where('token', $token)
			->get()->getRowArray();
	}

	function editQuestion($id)
	{
		return $this->db->table('soal')
			->where('id', $id)
			->get()->getRowArray();
	}
	function optionTotal($id)
	{
		return $this->db->table('soal')
			->select('soal.*, ujian.jml_opsi')
			->join('ujian', 'soal.id_ujian = ujian.id')
			->where('soal.id', $id)
			->get()->getRowArray();
	}

	function questionView($id)
	{
		return $this->db->table('soal')
			->select('soal.*, ujian.id as tes_id')
			->join('ujian', 'soal.id_ujian = ujian.id')
			->where('ujian.id', $id)
			->get()->getResultArray();
	}
	function answerView()
	{
		return $this->db->table('jawaban')
			->select('jawaban.*')
			->orderBy('id', 'rand()')
			->get()->getResultArray();
	}
	function getTest($id)
	{
		return $this->db->table('ujian')
			->select('ujian.*')
			->where('id', $id)
			->get()->getRowArray();
	}
	function existParticipant()
	{
		return $this->db->table('peserta')
			->select('peserta.id_murid, peserta.id_ujian')
			->get()->getResultArray();
	}
	function participant($data)
	{
		return $this->db->table('peserta')->insert($data);
	}

	function truefalse($id)
	{
		return $this->db->table('soal')
			->select('soal.*, jawaban.id_soal, jawaban.id as answerid')
			->join('jawaban', 'jawaban.id_soal = soal.id')
			->where('jawaban.jawaban_benar', 1)
			->where('jawaban.id_soal', $id)
			->get()->getRowArray();
	}
	function createAnswer($data)
	{
		return $this->db->table('jawaban_murid')
			->where('nilai_ujian', 0)
			->where('jawaban_benar', 0)
			->insert($data);
	}
	function nilai($id, $tes)
	{
		return $this->db->table('jawaban_murid')
			->where('id_murid', $id)
			->where('id_ujian', $tes)
			->get()->getRowArray();
	}
	public function update_nilai($data, $id, $tes)
	{
		$query = $this->db->table('jawaban_murid')
			->where('id_murid', $id)
			->where('id_ujian', $tes)
			->update($data);
		return $query;
	}
	public function deleteData($id, $con)
	{
		$query = $this->db->table('ujian')->delete(array($con => $id));
		return $query;
	}
}
