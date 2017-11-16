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
}

 ?>
