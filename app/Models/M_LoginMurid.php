<?php

namespace App\Models;

use CodeIgniter\Model;

class M_LoginMurid extends Model
{
    protected $table = 'muridlogin';
    public $key = 'id_LogMurid';
    protected $date_format = 'datetime';
    protected $set_created = TRUE;
    protected $set_modified = TRUE;
    protected $soft_deletes = TRUE;
    protected $allowedFields = [
        'username',
        'password',
        'id_murid',
        'status'
    ];

    public function updateData($table, $data, $id, $con)
    {
        $query = $this->db->table($table)->update($data, array($con => $id));
        return $query;
    }
}
