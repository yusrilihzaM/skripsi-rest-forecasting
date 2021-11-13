<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Coba extends REST_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ctdma_model');
        $this->load->model('TouristDataType_model');
        $this->load->model('SeasonalIndex_model');
        $this->load->model('Smoothed_model');
    }


    public function index_get(){
        $this->db->empty_table('calculate_ctdma');
        $this->db->empty_table('seasonal_index');
        $this->db->empty_table('calculate_ratio');
        $this->db->empty_table('calculate_smoothed');
        $tourist_data_type=$this->TouristDataType_model->get_tourist_data_type();
        foreach($tourist_data_type as $tourist_data_type){
            $id_tourist_data_type=$tourist_data_type['id_tourist_data_type'];
         
            $this->Ctdma_model->calculate_ctdma($id_tourist_data_type);
            $this->SeasonalIndex_model->calculate_season_index( $id_tourist_data_type);
            $this->Smoothed_model->calculate_smoothed($id_tourist_data_type);
        }
       
    }
}