<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Schedule extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }
    function index_get() {
        $pil = $this->get('pil');
        $id_event = $this->get('id_event');
        
        if($pil=='1'){ //food category
            $query = "select * from schedule_cat where id_event = '$id_event'";
        }
        else if($pil=='2'){ //food
            $query = "select A.*,B.* from schedule A,schedule_cat B where A.id_schedule_cat = B.id_schedule_cat AND B.id_event = '$id_event'";
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
