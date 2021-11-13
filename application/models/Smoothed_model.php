<?php
class Smoothed_model extends CI_model
{
    public function get_season_index(
        $id_tourist_data_type,
        $id_method_type,
        $month
    ){
        $sql_si="SELECT id_seasonal_index, seasonal_index FROM seasonal_index WHERE id_tourist_data_type=$id_tourist_data_type AND id_method_type=$id_method_type AND `month`=$month";
        $data_si=$this->db->query($sql_si)->row_array();
        return $data_si;
    }
    public function insert_smoothed(
        $id_data_pengunjung,
        $method_type,
        $smoothed
    ){
        $data=array(
            "id_calculate_smoothed"=>null,
            "id_data_pengunjung"=>$id_data_pengunjung,
            "id_method_type"=>$method_type,
            "smoothed"=>$smoothed
            
        );
        $this->db->insert('calculate_smoothed', $data);
    }
    
    public function calculate_smoothed(
        $id_tourist_data_type
    ){
        $sql_data_tourist="SELECT * FROM data_pengunjung WHERE id_tourist_data_type=$id_tourist_data_type";
        $data_tourist=$this->db->query($sql_data_tourist)->result_array();
        for ($method_type = 1; $method_type <= 2; $method_type++){   
        foreach ($data_tourist as $data) {
            $id_tourist_data_type=$data['id_tourist_data_type'];

            $season=$data["month"];
            
            $season_index=(double) $this->get_season_index($id_tourist_data_type,$method_type,$season) ["seasonal_index"];
            $data_pengunjung=$data['data_pengunjung'];
            $id_data_pengunjung=$data['id_data_pengunjung'];
            if($method_type==1){
                $smoothed= $data_pengunjung-$season_index;
            }
            else{
                $smoothed= $data_pengunjung/$season_index;
            }
            $this->insert_smoothed($id_data_pengunjung,$method_type,$smoothed);

            }
        }  
    }
}