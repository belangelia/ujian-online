<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Guru extends Model
{
	protected $table = 'guru';
	public $key = 'id';
	protected $date_format = 'datetime';
	protected $set_created = TRUE;
	protected $set_modified = TRUE;
	protected $soft_deletes = TRUE;
	protected $allowedFields = [
		'nama',
		'agama',
		'alamat',
		'nip',
		'tempat_lahir',
		'tgl_lahir',
		'jenkel',
		'email',
		'telp',
		'tgl_buat',
		'foto'
	];
	protected $validationRules = [
		'nama'			=> 'required',
		'agama'			=> 'required',
		'alamat'		=> 'required',
		'nip'			=> 'required|integer',
		'tempat_lahir'	=> 'required',
		'tgl_lahir'		=> 'required',
		'jenkel'		=> 'required',
		'email'			=> 'required',
		'telp'			=> 'required',
		'tgl_buat'		=> 'required',
		'foto'			=> 'required',
	];


	function login_teacher($data)
	{
		return $this->db->table('gurulogin')
			->join('guru', 'gurulogin.id_guru = guru.id')
			->join('role', 'guru.id_role = role.id_role')
			->where('username', $data['username'])
			->where('password', $data['password'])
			->get()->getRowArray();
	}
	function getAllTeacher()
	{
		return $this->db->table('gurulogin')
			->join('guru', 'gurulogin.id_guru = guru.id')
			->join('role', 'guru.id_role = role.id_role')
			->where('guru.id_role', 4)
			->get()->getResultArray();
	}
	function myStudent($id)
	{
		return $this->db->table('kelas as c')
			->select('c.id, c.kelas, c.id_guru, g.nama, s.*')
			->join('guru as g', 'c.id_guru = g.id')
			->join('murid as s', 's.id_class = c.id')
			->where('id_guru', $id)
			->orderBy('s.name', 'ASC')
			->get()->getResultArray();
	}

	function findTest($id)
	{
		return $this->db->table('ujian')
			->select('ujian.*,guru.nama,kelas.kelas')
			->join('guru', 'ujian.id_guru = guru.id')
			->join('kelas', 'ujian.class_id = kelas.id')
			->where('guru.id', $id)
			->get()->getResultArray();
	}

	function score()
	{
		return $this->db->table('jawaban_murid')
			->select('jawaban_murid.*,ujian.id_guru,ujian.mapel,ujian.waktu_selesai,guru.nama')
			->join('ujian', 'ujian.id = jawaban_murid.id_ujian')
			->join('guru', 'guru.id = ujian.id_guru')
			->get()->getResultArray();
	}

	function testScore($id)
	{
		return $this->db->table('jawaban_murid')
			->select('jawaban_murid.*, ujian.id_guru, ujian.nama_ujian, ujian.waktu_mulai, ujian.class_id, ujian.mapel, murid.name, kelas.kelas')
			->join('ujian', 'ujian.id = jawaban_murid.id_ujian')
			->join('murid', 'murid.id = jawaban_murid.id_murid')
			->join('kelas', 'kelas.id = ujian.class_id')
			->where('ujian.id_guru', $id)
			->get()->getResultArray();
	}
	function scoreMurid()
	{
		return $this->db->table('jawaban_murid')
			->select('jawaban_murid.id_murid, jawaban_murid.id_ujian, jawaban_murid.nilai_ujian, ujian.class_id, murid.name, kelas.kelas')
			->join('ujian', 'ujian.id = jawaban_murid.id_ujian')
			->join('murid', 'murid.id = jawaban_murid.id_murid')
			->join('kelas', 'kelas.id = ujian.class_id')
			->get()->getResultArray();
	}
}
