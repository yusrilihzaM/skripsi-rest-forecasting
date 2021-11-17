<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChartForecasting extends CI_Controller {

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
	public function index()
	{
        //http://192.168.100.6/skripsi-rest-forecasting/ChartForecasting/index/id_tourist_data_type/id_method_type
        $id_tourist_data_type=$this->uri->segment(3);
        $id_method_type=$this->uri->segment(4);

        $data['name'] = $this->db->query("SELECT tourist_data_type FROM tourist_data_type where id_tourist_data_type=$id_tourist_data_type")->row_array()["tourist_data_type"];
        $data['data']=$this->CalculateForecast_model->get_data_all_forecast($id_tourist_data_type,$id_method_type);
        $data['data1']=$this->CalculateForecast_model->get_data_all_forecast($id_tourist_data_type,$id_method_type);
        $data['bulan']=$this->CalculateForecast_model->get_data_all_forecast($id_tourist_data_type,$id_method_type);
      
        // var_dump($data['data']);
        // die;
		$this->load->view('chart.php',$data);
	}
}
