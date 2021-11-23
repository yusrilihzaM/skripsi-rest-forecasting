<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Evaluation extends REST_Controller {
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
        $id_tourist_data_type=$this->get('id_tourist_data_type');
        $id_method_type=$this->get('id_method_type');
      
        $data_evaluation= $this->ErrorMeasurement_model->get_error_measurement_by_method_datatype($id_tourist_data_type,$id_method_type);
        
        if($data_evaluation){
         
            $this->response([
                'status' => true,
                'data_evaluation' => $data_evaluation
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'data_evaluation does not exist'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}