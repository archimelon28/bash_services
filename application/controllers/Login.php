<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Login extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data
    function index_get() {
        $email   = $this->input->get('email');
        $password   = md5($this->input->get('password'));
        $pil = $this->input->get('pil'); //1: login attendee 2:login admin

        if($pil=='1'){ //login attendee
          $query = "select A.*,B.qrcode,B.is_attending,B.id_event, B.id_attendee, C.nama_event, C.mulai, C.akhir, C.greeting,C.nama_lokasi, C.longt, C.lat, C.gambar_utama, C.qrcode from user A, attendee B,event C where A.id_user = B.id_user AND A.email='$email' AND A.password='$password' AND B.id_event = C.id_event AND C.is_aktif=1";
        }
        else if($pil=='2'){ //login event_organizer
          $query = "select A.*, B.id_event_organizer from user A, event_organizer B where A.id_user = B.id_user AND A.email='$email' AND A.password='$password'";
        }
        $q = $this->db->query($query)->result();
        if($q){
          $this->response($q, 200);
        } else {
          $this->response(array('status' => 'failed', 401));
        }
    }

    function index_post() {
        $email   = $this->input->post('email');
        $password   = md5($this->input->post('password'));
        $pil = $this->input->post('pil'); //1: login user 2:login admin

        if($pil=='1'){ //login attendee
          $query = "select A.*,B.qrcode,B.is_attending from user A, attendee B where A.id_user = B.id_user AND A.email='$email' AND A.password='$password'";
        }
        else if($pil=='2'){
          $query = "select A.* from user A, event_organizer B where A.id_user = B.id_user AND A.email='$email' AND A.password='$password'";
        }
        $q = $this->db->query($query)->result();
        if($q){
          $this->response($q, 200);
        } else {
          $this->response(array('status' => 'failed', 401));
        }
    }
}
?>
