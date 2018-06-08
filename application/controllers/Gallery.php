<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Gallery extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }
    function index_get() {
        $pil = $this->get('pil');
        $id_event = $this->get('id_event');
        
        if($pil=='1'){ //food category
            $query = "select * from gallery where id_event = '$id_event'";
        }
        $q = $this->db->query($query)->result();
        if($q){
          $this->response($q, 200);
        } else {
          $this->response(array('status' => 'failed', 401));
        }
    }


    //Masukan function selanjutnya disini
}
?>
