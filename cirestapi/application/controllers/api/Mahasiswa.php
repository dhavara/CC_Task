<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends REST_Controller {

    function __construct($config = 'rest')
    {
        parent::__construct($config);

        $this->load->model('Mahasiswamodel', 'model');
    }

    public function index_get() {
        $data = $this->model->getMahasiswa();
        $this->set_response([
            'status' => TRUE,
            'code' => 200,
            'message'=> 'Success',
            'data'   => $data ,
            ], REST_Controller::HTTP_OK);
        
    }

    public function sendmail_post(){
        $to_email = $this->post('email');
        $this->load->library('email');
        $this->email->from('dhava@stellaris.site', 'Stellaris');
        $this->email->to($to_email);
        $this->email->subject('Hi Welcome to the Club');
        $this->email->message("
            <center>
                <h1 style='color: #5C2E7E'>WELCOME TO STELLARIS</h1>
                <img src='https://www.pushengage.com/wp-content/uploads/2022/02/Best-Website-Welcome-Message-Examples.png' alt='welcome' width='850' height='500'>
                <br>
                <h3>We hope you can learn something new with us!</h3>
                <br>
                <a href='http://stellaris.site/'>Visit Stellaris.site!</a>
            </center>
        ");

        if($this->email->send()){
            $this->set_response([
                'status' => TRUE,
                'code' => 200,
                'message'=> 'Email informasi berhasil dikirim, silahkan periksa inbox email!'
                ], REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                'status' => FALSE,
                'code' => 404,
                'message' => 'Gagal mengirimkan email informasi'
                ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

}