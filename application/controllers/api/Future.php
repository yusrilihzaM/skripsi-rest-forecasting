<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Future extends REST_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Future_model');
        $this->load->model('TouristDataType_model');
    }
    // public function index_get(){
    //     $id_tourist_data_type = $this->get('id_tourist_data_type');
    //     $id_method_type = $this->get('id_method_type');
    //     if($id_tourist_data_type == null){
    //         $future = $this->Future_model->get_future_forecast();
    //     }else{
    //         $future = $this->Future_model->get_future_forecast($id_tourist_data_type,$id_method_type);
    //     }
    //     if($future){
    //         $this->response([
    //             'status' => true,
    //             'data_future' => $future
    //         ], REST_Controller::HTTP_OK);
    //     }else{
    //         $this->response([
    //             'status' => false,
    //             'message' => 'Data Future does not exist'
    //         ], REST_Controller::HTTP_NOT_FOUND);
    //     }

    // }
    public function index_post(){

        $period= $this->post('period');
        $this->db->empty_table('forecast_future');
        $tourist_data_type=$this->TouristDataType_model->get_tourist_data_type();
        
        foreach($tourist_data_type as $tourist_datatype){
            $id_tourist_data_type=$tourist_datatype['id_tourist_data_type'];
            echo("tourist_data_type :  $id_tourist_data_type <br>");
            $check_count_data=$this->db->query("SELECT COUNT(id_data_pengunjung) count_data FROM data_pengunjung WHERE id_tourist_data_type=$id_tourist_data_type")->row_array()["count_data"];
            if($check_count_data>=24){
                for ($method_type = 1; $method_type <= 2; $method_type++){  
                    echo("-method : $method_type <br>");
                        $this->Future_model->future_year($period,$id_tourist_data_type,$method_type);
                }
            }
        
    }
        // if($this->Tourist_model->post_tourist($data) > 0){
        //     $this->response([
        //         'status' => true,
        //         'message'=>'add new tourist successfully'
        //     ], REST_Controller::HTTP_CREATED);
        // }{
        //     // id tidak ada
        //     $this->response([
        //         'status' => false,
        //         'message' => 'Failed to add new tourist'
        //     ], REST_Controller::HTTP_BAD_REQUEST);
        // }

    }
}
