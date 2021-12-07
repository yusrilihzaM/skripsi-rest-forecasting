<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compare extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Comparison_model');
        $this->load->model('TouristDataType_model');
        $this->load->model('CalculateForecast_model');
    }
    // public function index(){

    // }
	public function chart()
	{
    
        $id_tourist_data_type=$this->uri->segment(3);
        $id_method_type=$this->uri->segment(4);

        $data['name'] = "Grafik perbandingan";
        $data['aditif']=$this->Comparison_model->get_smape_aditif();
        $data['multiplikatif']=$this->Comparison_model->get_smape_multiplikatif();
        $data['tempat']=$this->TouristDataType_model->get_tourist_data_type();
        // var_dump($data['tempat']);
        // die;
		$this->load->view('chart_compare.php',$data);
	}

    public function detail()
	{
    
        $id_tourist_data_type=$this->uri->segment(3);
        $id_method_type=$this->uri->segment(4);

        $data['name'] = "Detail perbandingan";
        $data['data']=$this->Comparison_model->get_smape_all();
    
        // var_dump($data['data']);
        // die;
		$this->load->view('detail_compare.php',$data);
	}
}
