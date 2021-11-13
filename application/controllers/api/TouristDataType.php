<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class TouristDataType extends REST_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('TouristDataType_model');
    }
    public function index_get(){

        $id=$this->get('id');

        if($id == null){
            $tourist = $this->TouristDataType_model->get_tourist_data_type();
        }else{
            $tourist = $this->TouristDataType_model->get_tourist_data_type($id);
        }

        
        if($tourist){
            $this->response([
                'status' => true,
                'data_tourist' => $tourist
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Toursit data type does not exist'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete(){

        $id=$this->delete('id_tourist_data_type');

        if($id == null){
            $this->response([
                'status' => false,
                'message' => 'ID cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if($this->TouristDataType_model->delete_tourist_data_type($id)>0){
                // ok
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message'=>'deleted'
                ], REST_Controller::HTTP_OK);
            }{
                // id tidak ada
                $this->response([
                    'status' => false,
                    'message' => 'ID cannot be empty'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        
    }

    public function index_put(){
        $id=$this->put('id_tourist_data_type');
        $data = array(
            'id_tourist_data_type'=> $this->put('id_tourist_data_type'),
            'tourist_data_type'    => $this->put('tourist_data_type'),
            'data_type'    => $this->put('data_type')
        );

        if($this->TouristDataType_model->put_tourist_data_type($data,$id) > 0){
            $this->response([
                'status' => true,
                'message'=>'Toursit data type updated successfully'
            ], REST_Controller::HTTP_CREATED);
        }{
            // id tidak ada
            $this->response([
                'status' => false,
                'message' => 'Failed to update Toursit data type'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

    }
    public function index_post(){
        $data = array(
            'tourist_data_type'    => $this->post('tourist_data_type'),
            'data_type'    => $this->post('data_type')
        );

        if($this->TouristDataType_model->post_tourist_data_type($data) > 0){
            $this->response([
                'status' => true,
                'message'=>'add new Toursit data type successfully'
            ], REST_Controller::HTTP_CREATED);
        }{
            // id tidak ada
            $this->response([
                'status' => false,
                'message' => 'Failed to add new Toursit data type'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

    }
   
}