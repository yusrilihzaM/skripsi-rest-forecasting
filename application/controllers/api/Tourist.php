<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Tourist extends REST_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tourist_model');
    }


    public function index_get(){

        $id=$this->get('id_tourist_data_type');

        if($id == null){
            $tourist = $this->Tourist_model->get_tourist_by_type();
        }else{
            $tourist = $this->Tourist_model->get_tourist_by_type($id);
        }

        
        if($tourist){
            $this->response([
                'status' => true,
                'data_tourist' => $tourist
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data Toursit does not exist'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete(){

        $id=$this->delete('id_data_pengunjung');

        if($id == null){
            $this->response([
                'status' => false,
                'message' => 'ID cannot be empty'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if($this->Tourist_model->delete_tourist($id)>0){
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
        $id=$this->put('id_data_pengunjung');
        $data = array(
            'id_data_pengunjung'=> $this->put('id_data_pengunjung'),
            'data_pengunjung'    => $this->put('data_pengunjung'),
            'month'    => $this->put('month'),
            'year'    => $this->put('year'),
            'id_tourist_data_type'    => $this->put('id_tourist_data_type')
        );

        if($this->Tourist_model->put_tourist($data,$id) > 0){
            $this->response([
                'status' => true,
                'message'=>'tourist updated successfully'
            ], REST_Controller::HTTP_CREATED);
        }{
            // id tidak ada
            $this->response([
                'status' => false,
                'message' => 'Failed to update tourist'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

    }

    public function delete_put(){
        $id=$this->put('id_data_pengunjung');
    
        if($this->Tourist_model->delete_tourist($id) > 0){
            $this->response([
                'status' => true,
                'message'=>'tourist delete successfully'
            ], REST_Controller::HTTP_CREATED);
        }{
            // id tidak ada
            $this->response([
                'status' => false,
                'message' => 'Failed to delete tourist'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

    }
    public function index_post(){
        $data = array(
            'data_pengunjung'    => $this->post('data_pengunjung'),
            'month'    => $this->post('month'),
            'year'    => $this->post('year'),
            'id_tourist_data_type'    => $this->post('id_tourist_data_type'),
        );

        if($this->Tourist_model->post_tourist($data) > 0){
            $this->response([
                'status' => true,
                'message'=>'add new tourist successfully'
            ], REST_Controller::HTTP_CREATED);
        }{
            // id tidak ada
            $this->response([
                'status' => false,
                'message' => 'Failed to add new tourist'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

    }

}