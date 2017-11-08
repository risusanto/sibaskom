<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_m extends CI_Model {

	// inisialisasi nama table
	var $table = 'email_notifikasi';
	var $primary_key = 'id_email_notifikasi';

	// mendapatkan semua data
	function getAll(){
		$this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by($this->primary_key,'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    // mengambil data 
    function get()
	{
		$this->db->order_by($this->primary_key);
		return $this->db->get($this->table);
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

}

/* End of file level_m.php */
/* Location: ./application/modules/level/models/level_m.php */