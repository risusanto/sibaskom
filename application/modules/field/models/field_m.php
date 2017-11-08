<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Field_m extends CI_Model {

	// inisialisasi nama table
	var $table = 'sertifikat';
	var $primary_key = 'id_sertifikat';

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
	function update($id, $data)
	{
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table, $data);
	}

	// hapus data
	function delete($id)
	{
		$this->db->delete($this->table, array($this->primary_key => $id));
	}

	// cek validasi unique
	function valid_caption($caption)
	{
		$query = $this->db->get_where($this->table, array('caption' => $caption));
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function getRows($params = array()){
        $level = $this->session->userdata('level');
        $nik = $this->session->userdata('nik');

        $this->db->select('*');
        $this->db->from($this->table);

        if($level == 2)
        {
            $this->db->where('nip', $nik);
        }

        //filter data by searched keywords
        if(!empty($params['search']['judul_diklat'])){
            $this->db->like('judul_diklat',$params['search']['judul_diklat']);
        }
        if(!empty($params['search']['masa_alert'])){
            $this->db->like('masa_alert',$params['search']['masa_alert']);
        }
        if(!empty($params['search']['nama'])){
            $this->db->like('nama',$params['search']['nama']);
        }
        if(!empty($params['search']['nip'])){
            $this->db->like('nip',$params['search']['nip']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('judul_diklat',$params['search']['sortBy']);
        }else{
            $this->db->order_by('id_sertifikat','desc');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //echo $this->db->last_query();
        //exit;
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

    function getDuplicat()
    {
        $query = $this->db->query("SELECT *
                                    FROM sertifikat
                                        WHERE nip IN (
                                            SELECT nip
                                            FROM sertifikat
                                            GROUP BY nip
                                            HAVING COUNT(id_sertifikat) > 1
                                    ) AND kode_diklat IN (
                                            SELECT kode_diklat
                                            FROM sertifikat
                                            GROUP BY kode_diklat
                                            HAVING COUNT(id_sertifikat) > 1
                                    ) OR tanggal_mulai_pelatihan IN (
                                            SELECT tanggal_mulai_pelatihan
                                            FROM sertifikat
                                            GROUP BY tanggal_mulai_pelatihan
                                            HAVING COUNT(id_sertifikat) > 1
                                    )
                                    ORDER BY nip");
        return $query->result();

    }

    function countExpired($masa)
    {
        $query = $this->db->query("SELECT COUNT(*) AS jml FROM sertifikat WHERE masa_alert = $masa AND CURDATE() >= masa_belaku_sertifikat + INTERVAL $masa MONTH");

        $result = $query->row();
        return $result->jml;
    }

    function countSertifikat()
    {
        $query = $this->db->query("SELECT COUNT(*) AS jml FROM sertifikat ");

        $result = $query->row();
        return $result->jml;
    }

    function countUser()
    {
        $query = $this->db->query("SELECT COUNT(*) AS jml FROM users ");

        $result = $query->row();
        return $result->jml;
    }

    // mendapatkan semua data
    function getAllExpired($masa){
    	$where = "masa_alert = $masa AND CURDATE() >= masa_belaku_sertifikat + INTERVAL $masa MONTH";
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($where);
        $this->db->order_by($this->primary_key,'DESC');
        $query = $this->db->get();
        
        //echo $this->db->last_query();
        //exit;

        return $query->result();
    }

}

/* End of file level_m.php */
/* Location: ./application/modules/level/models/level_m.php */