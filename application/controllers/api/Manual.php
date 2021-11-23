<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Manual extends REST_Controller {
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
      
        $data_manual= $this->db->query("SELECT t, data_pengunjung, ctdma, ratio, seasonal_index, smoothed, unadjusted, adjusted,error, mad, mape
        FROM data_pengunjung
        NATURAL JOIN calculate_ctdma
        NATURAL JOIN calculate_ratio
        NATURAL JOIN calculate_forecasting
        NATURAL JOIN calculate_smoothed
        NATURAL JOIN seasonal_index
        WHERE id_tourist_data_type=$id_tourist_data_type  AND id_method_type=$id_method_type")->result_array();
        
        if($data_manual){
         
            $this->response([
                'status' => true,
                'data_manual' => $data_manual
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'data_manual does not exist'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}