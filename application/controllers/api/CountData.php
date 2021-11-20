<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class CountData extends REST_Controller {
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
    public function Count_get(){

        
        $countData=$this->db->query("SELECT COUNT(id_calculate_forecasting) countData FROM calculate_forecasting")->row_array()["countData"];
        
        if($countData){
         
            $this->response([
                'status' => true,
                'message' => $countData
            ], REST_Controller::HTTP_OK);
        }else if($countData==0){
         
            $this->response([
                'status' => false,
                'message' => $countData
            ], REST_Controller::HTTP_OK);
        }
    }
}