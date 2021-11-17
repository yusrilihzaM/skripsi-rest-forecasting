<?php
class TouristDataType_model extends CI_model
{
    public function get_tourist_data_type($id = null)
    {
        if ($id == null){
            return $this->db->get('tourist_data_type')->result_array();
        }else{
            return $this->db->get_where('tourist_data_type',['id_tourist_data_type'=>$id])->result_array();
        }
    }
    public function get_tourist_data_type_place($id = null)
    {
        if ($id == null){
            return $this->db->get_where('tourist_data_type',['data_type'=>"tempat wisata"])->result_array();
        }else{
            return $this->db->get_where('tourist_data_type',['id_tourist_datas_type'=>$id])->result_array();
        }
    }
    public function delete_tourist_data_type($id){

        $this->db->where('id_tourist_data_type', $id);
        $this->db->delete('tourist_data_type');
        return $this->db->affected_rows();
        
    }

    public function post_tourist_data_type($data){
        $this->db->insert('tourist_data_type', $data);
        return $this->db->affected_rows();
    } 

    public function put_tourist_data_type($data, $id){

        $this->db->update('tourist_data_type', $data, ['id_tourist_data_type'=>$id]);
        return $this->db->affected_rows();
    }

}