<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

	// inisialisasi nama table
	var $table = 'users';
	var $primary_key = 'id_user';

	// mendapatkan semua data
	function getAll(){
		$this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by($this->primary_key,'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    // mendapatkan satu data berdasarkan id
	function get_by_id($id)
	{
		return $this->db->get_where($this->table, array($this->primary_key => $id))->row();
	}

    // insert data
    function add($data){
		$this->db->insert($this->table, $data);
	}

	// update data
	function update($id_level, $data)
	{
		$this->db->where($this->primary_key, $id_level);
		$this->db->update($this->table, $data);
	}

	// hapus data
	function delete($id)
	{
		$this->db->delete($this->table, array($this->primary_key => $id));
	}

	// cek validasi unique
	function valid_nik($nik)
	{
		$query = $this->db->get_where($this->table, array('nik' => $nik));
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getDuplicat()
    {
        $query = $this->db->query("SELECT *
                                    FROM users
                                        WHERE nik IN (
                                            SELECT nik
                                            FROM users
                                            GROUP BY nik
                                            HAVING COUNT(id_user) > 1
                                    )
                                    ORDER BY nik");
        return $query->result();

    }

}

/* End of file level_m.php */
/* Location: ./application/modules/level/models/level_m.php */