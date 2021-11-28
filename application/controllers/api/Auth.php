<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Auth extends REST_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ctdma_model');
        $this->load->model('TouristDataType_model');
        $this->load->model('SeasonalIndex_model');
        $this->load->model('Smoothed_model');
        $this->load->model('CoefficientParameter_model');
        $this->load->model('CalculateForecast_model');
        $this->load->model('ErrorMeasurement_model');
    }

    public function index_get(){
        $email=$this->get('email');
        $password=$this->get('password');
        $user=$this->db->get_where('user', ['email' => $email])->row_array();
        if($user){
            if (password_verify($password, $user['password'])) {
                $this->response([
                    'status' => true,
                    'data_user' => $user
                ], REST_Controller::HTTP_OK);
            }
            else{
                $this->response([
                    'status' => false,
                    'message' => 'Password failed'
                ], REST_Controller::HTTP_OK);
            }
        }
        else{
            $this->response([
                'status' => false,
                'message' => 'User not found'
            ], REST_Controller::HTTP_OK);
        }
    }
}