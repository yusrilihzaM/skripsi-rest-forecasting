<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Comparison extends REST_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Comparison_model');
    }

    public function index_get(){
    
      
        $data_comparison= $this->Comparison_model->get_smape_all();
        
        if($data_comparison){
         
            $this->response([
                'status' => true,
                'data_comparison' => $data_comparison
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'data_comparison does not exist'
            ], REST_Controller::HTTP_OK);
        }
    }

    public function result_get(){
    
      
        $data_comparison= $this->Comparison_model->get_smape_good();
        
        if($data_comparison){
         
            $this->response([
                'status' => true,
                'data_comparison' => $data_comparison
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'data_comparison does not exist'
            ], REST_Controller::HTTP_OK);
        }
    }
}