<?php
class Tourist_model extends CI_model
{
    public function get_tourist($id = null)
    {
        if ($id == null){
            return $this->db->get('data_pengunjung')->result_array();
        }else{
            return $this->db->get_where('data_pengunjung',['id_data_pengunjung'=>$id])->result_array();
        }
    }
    public function get_tourist_by_type($id_tourist_data_type = null)
    {
        if ($id_tourist_data_type == null){
            return $this->db->get('data_pengunjung')->result_array();
        }else{
            return $this->db->get_where('data_pengunjung',['id_tourist_data_type'=>$id_tourist_data_type])->result_array();
        }
    }
    public function delete_tourist($id){

        $this->db->where('id_data_pengunjung', $id);
        $this->db->delete('data_pengunjung');
        return $this->db->affected_rows();
        
    }

    public function post_tourist($data){
        $this->db->insert('data_pengunjung', $data);
        return $this->db->affected_rows();
    } 

    public function put_tourist($data, $id){

        $this->db->update('data_pengunjung', $data, ['id_data_pengunjung'=>$id]);
        return $this->db->affected_rows();
    }

}