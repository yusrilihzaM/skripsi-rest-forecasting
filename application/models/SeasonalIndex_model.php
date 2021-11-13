<?php
class SeasonalIndex_model extends CI_model
{
    public function calculate_season_index(
        $id_tourist_data_type
        ){
        for ($method_type = 1; $method_type <= 2; $method_type++){   
           
            for ($month = 1; $month <= 12; $month++){
                $sql_csi="SELECT AVG(ratio) ratio FROM calculate_ratio
                NATURAL JOIN data_pengunjung
                WHERE id_method_type=$method_type AND id_tourist_data_type=$id_tourist_data_type AND month=$month";
                $csi=(Double) $this->db->query($sql_csi)->row_array() ["ratio"];
                $data=array(
                    "id_seasonal_index"=>null,
                    "id_tourist_data_type"=>$id_tourist_data_type,
                    "seasonal_index"=>$csi,
                    "month"=>$month,
                    "id_method_type"=>$method_type
                );
                $this->db->insert('seasonal_index', $data);
            }
    }
        
    }
}