<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Calculate extends REST_Controller {
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

        
        $countData=$this->db->query("SELECT COUNT(id_calculate_forecasting) countData FROM calculate_forecasting")->row_query();
        
        if($countData){
         
            $this->response([
                'status' => true,
                'countData' => $countData
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'countDatas does not exist'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_get(){
        $this->db->empty_table('calculate_ctdma');
        $this->db->empty_table('seasonal_index');
        $this->db->empty_table('calculate_ratio');
        $this->db->empty_table('calculate_smoothed');
        $this->db->empty_table('coefficient_parameter');
        $this->db->empty_table('calculate_forecasting');
        $this->db->empty_table('error_measurement');
        $tourist_data_type=$this->TouristDataType_model->get_tourist_data_type();
        
        foreach($tourist_data_type as $tourist_datatype){
            // echo($tourist_datatype['id_tourist_data_type']);
            $id_tourist_data_type=$tourist_datatype['id_tourist_data_type'];
            $check_count_data=$this->db->query("SELECT COUNT(id_data_pengunjung) count_data FROM data_pengunjung WHERE id_tourist_data_type=$id_tourist_data_type")->row_array()["count_data"];
            if($check_count_data>=24){
            $this->Ctdma_model->calculate_ctdma($id_tourist_data_type);
            $this->SeasonalIndex_model->calculate_season_index( $id_tourist_data_type);
            $this->Smoothed_model->calculate_smoothed($id_tourist_data_type);
            $this->CoefficientParameter_model->calculate_coefficient_parameter($id_tourist_data_type);
            $this->CalculateForecast_model->calculate_forecast_year($id_tourist_data_type);
            $this->ErrorMeasurement_model->calculate_error_measurement($id_tourist_data_type);
            }
        }
        $this->response([
            'status' => true,
            "message"=>"Berhasil di hitung"
        ], REST_Controller::HTTP_OK);
    }
}