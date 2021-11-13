<?php
class CoefficientParameter_model extends CI_model
{
    public function calculate_parameter_b(
        $id_tourist_data_type,
        $id_method_type
    ){
        
        $sql_b="SELECT
        (N * Sum_XY - Sum_X * Sum_Y)/(N * Sum_X2 - Sum_X * Sum_X) AS b
        FROM
        (SELECT 
        COUNT(*) AS N,
        SUM(smoothed) AS Sum_Y,
        SUM(CAST(t-1 AS INT)) AS Sum_X,
        SUM(CAST(t-1 AS INT) * smoothed) AS Sum_XY,
        SUM(CAST(t-1 AS INT) * CAST(t-1 AS INT)) AS Sum_X2
        FROM data_pengunjung NATURAL JOIN calculate_smoothed WHERE id_tourist_data_type=$id_tourist_data_type AND id_method_type=$id_method_type)AS data_";
        $data_b=(double) $this->db->query($sql_b)->row_array()["b"];
        return $data_b;
    }
    public function calculate_parameter_a(
        $id_tourist_data_type,
        $id_method_type
    ){
        $sql_a="SELECT
        (Sum_Y * Sum_x2 - Sum_X * Sum_XY)/(N * Sum_X2 - Sum_X * Sum_X) AS a
        FROM
        (SELECT 
        COUNT(*) AS N,
        SUM(smoothed) AS Sum_Y,
        SUM(CAST(t-1 AS INT)) AS Sum_X,
        SUM(CAST(t-1 AS INT) * smoothed) AS Sum_XY,
        SUM(CAST(t-1 AS INT) * CAST(t-1 AS INT)) AS Sum_X2
        FROM data_pengunjung NATURAL JOIN calculate_smoothed WHERE id_tourist_data_type=$id_tourist_data_type AND id_method_type=$id_method_type)AS data_
        ";
        $data_a=(double) $this->db->query($sql_a)->row_array()["a"];
        return $data_a;
    }

    public function insert_coefficient_parameter(
        $a,
        $b,
        $id_tourist_data_type,
        $id_method_type
    ){
        $data=array(
            "id_coefficient_parameter"=>null,
            "a"=>$a,
            "b"=>$b,
            "id_tourist_data_type"=>$id_tourist_data_type,
            "id_method_type"=>$id_method_type,
            
        );
        $this->db->insert('coefficient_parameter', $data);
    }
    public function calculate_coefficient_parameter($id_tourist_data_type){
        for ($method_type = 1; $method_type <= 2; $method_type++){
            $id_method_type=$method_type;
            $b=$this->calculate_parameter_b($id_tourist_data_type,$method_type);
            $a=$this->calculate_parameter_a($id_tourist_data_type,$method_type)-$b;
            $this->insert_coefficient_parameter($a,$b,$id_tourist_data_type,$id_method_type);
        }

    }
}