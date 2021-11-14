<?php
class ErrorMeasurement_model extends CI_model
{
    public function calculate_error_measurement(
        $id_tourist_data_type
    ){
        for ($id_method_type = 1; $id_method_type <= 2; $id_method_type++){
            $sql_data="SELECT
        SUM(error) sum_error,
        SUM(mad) sum_mad,
        SUM(mape) sum_mape
        FROM calculate_forecasting
        NATURAL JOIN data_pengunjung
        WHERE id_tourist_data_type=$id_tourist_data_type AND id_method_type=$id_method_type and data_pengunjung not null";
        $data=$this->db->query($sql_data)->row_array();

        $sql_n="SELECT
        COUNT(id_data_pengunjung) n
        FROM calculate_forecasting
        NATURAL JOIN data_pengunjung
        WHERE id_tourist_data_type=$id_tourist_data_type AND id_method_type=$id_method_type";

        $n=(int)$this->db->query($sql_n)->row_array()['n'];
        $sum_error=(double)$data['sum_error'];
        $sum_mad=(double)$data['sum_mad'];
        $sum_mape=(double)$data['sum_mape'];
        
        $mad=1/$n*$sum_mad;
        $mape=100/$n*$sum_mape;
        $ts=$sum_error/$mad;
        $data=array(
            "id_error_measurement"=>null,
            "rsfe"=>$sum_error,
            "mad"=>$mad,
            "mape"=>$mape,
            "ts"=>$ts,
            "id_tourist_data_type"=>$id_tourist_data_type,
            "id_method_type"=>$id_method_type
            );
            $this->db->insert('error_measurement', $data);
        }
        
    }
}