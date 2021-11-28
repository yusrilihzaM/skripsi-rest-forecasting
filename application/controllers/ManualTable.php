<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManualTable extends CI_Controller {

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

        $data["data_manual"]= $this->db->query("SELECT t, data_pengunjung, ctdma, ratio, seasonal_index, smoothed, unadjusted, adjusted,error, mad, mape
        FROM data_pengunjung
        NATURAL JOIN calculate_ctdma
        NATURAL JOIN calculate_ratio
        NATURAL JOIN calculate_forecasting
        NATURAL JOIN calculate_smoothed
        NATURAL JOIN seasonal_index
        WHERE id_tourist_data_type=$id_tourist_data_type  AND id_method_type=$id_method_type")->result_array();

     
        $this->load->view('Templates/header.php',$data);
        $this->load->view('manual.php',$data);
        $this->load->view('Templates/footer.php',$data);
	
	}
}
