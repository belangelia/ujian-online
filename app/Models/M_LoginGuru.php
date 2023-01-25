<?php

namespace App\Models;

use CodeIgniter\Model;

class M_LoginGuru extends Model
{
    protected $table = 'gurulogin';
    public $key = 'id_LogGuru';
    protected $date_format = 'datetime';
    protected $set_created = TRUE;
    protected $set_modified = TRUE;
    protected $soft_deletes = TRUE;
    protected $allowedFields = [
        'username',
        'password',
        'id_guru',
        'status'
    ];


    public function updateData($table, $data, $id, $con)
    {
        $query = $this->db->table($table)->update($data, array($con => $id));
        return $query;
    }
}
