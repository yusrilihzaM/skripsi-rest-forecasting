<?php
class Comparison_model extends CI_model
{
    function get_smape_good(){
        $query=$this->db->query("SELECT
        smape, tourist_data_type, method_type
        FROM error_measurement
        NATURAL JOIN tourist_data_type
        NATURAL JOIN method_type ORDER BY smape, tourist_data_type, method_type ASC LIMIT 1")->row_array();
        return $query;
    }

    function get_smape_all(){
        $query=$this->db->query("SELECT
        smape, tourist_data_type, method_type
        FROM error_measurement
        NATURAL JOIN tourist_data_type
        NATURAL JOIN method_type ORDER BY  tourist_data_type ")->result_array();
        return $query;
    }

    function get_smape_aditif(){
        $query=$this->db->query("SELECT
        smape, tourist_data_type, method_type
        FROM error_measurement
        NATURAL JOIN tourist_data_type
        NATURAL JOIN method_type
        WHERE id_method_type=1
        ORDER BY  tourist_data_type ")->result_array();
        return $query;
    }

    function get_smape_multiplikatif(){
        $query=$this->db->query("SELECT
        smape, tourist_data_type, method_type
        FROM error_measurement
        NATURAL JOIN tourist_data_type
        NATURAL JOIN method_type
        WHERE id_method_type=2
        ORDER BY  tourist_data_type ")->result_array();
        return $query;
    }


}