<?php
/**
 *
 */
class Penugasan_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['table_name'] = 'penugasan';
    $this->data['primary_key'] = 'id_penugasan';
  }

  function getRows($params = array()){
        $level = $this->session->userdata('level');
        $nik = $this->session->userdata('nik');

        $this->db->select('*');
        $this->db->from($this->data['table_name']);

        if($level == 2)
        {
            $this->db->where('nip', $nik);
        }

        //filter data by searched keywords
        if(!empty($params['search']['lokasi_penugasan'])){
            $this->db->like('lokasi_penugasan',$params['search']['lokasi_penugasan']);
        }
        if(!empty($params['search']['nama'])){
            $this->db->like('nama',$params['search']['nama']);
        }
        if(!empty($params['search']['nip'])){
            $this->db->like('nip',$params['search']['nip']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('lokasi_penugasan',$params['search']['sortBy']);
        }else{
            $this->db->order_by('id_penugasan','desc');
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
}

 ?>
