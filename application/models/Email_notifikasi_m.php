<?php

class Email_notifikasi_m extends MY_Model
{
    function __construct(){
        parent::__construct();
        $this->data['table_name'] = 'email_notifikasi';
        $this->data['primary_key'] = 'id_email_notifikasi';
    }
}
