<?php
class ErrorMeasurement_model extends CI_model
{
    public function get_error_measurement_by_method_datatype(
        $id_tourist_data_type=null,
        $id_method_type=null
    ){
        if ($id_tourist_data_type == null){
            return $this->db->query("SELECT * FROM error_measurement")->result_array();
        }else{
            return $this->db->query("SELECT * FROM error_measurement WHERE id_tourist_data_type=$id_tourist_data_type  AND id_method_type=$id_method_type")->result_array();
        }
       
    }
    public function calculate_error_measurement(
        $id_tourist_data_type
    ){
        for ($id_method_type = 1; $id_method_type <= 2; $id_method_type++){
            $sql_data="SELECT
        SUM(error) sum_error,
        -- SUM(mad) sum_mad,
        -- SUM(mape) sum_mape,
        SUM(smape) sum_smape
        FROM calculate_forecasting
        NATURAL JOIN data_pengunjung
        WHERE id_tourist_data_type=$id_tourist_data_type AND id_method_type=$id_method_type";
        $data=$this->db->query($sql_data)->row_array();

        $sql_n="SELECT
        COUNT(id_data_pengunjung) n
        FROM calculate_forecasting
        NATURAL JOIN data_pengunjung
        WHERE id_tourist_data_type=$id_tourist_data_type AND id_method_type=$id_method_type";

        $n=(int)$this->db->query($sql_n)->row_array()['n'];

        if($n){
            $sum_error=(double)$data['sum_error'];
            // $sum_mad=(double)$data['sum_mad'];
            // $sum_mape=(double)$data['sum_mape'];
            $sum_smape=(double)$data['sum_smape'];

            // $mad=1/$n*$sum_mad;
            // $mape=100/$n*$sum_mape;
            // $ts=$sum_error/$mad;
            $smape=100/$n*$sum_smape;
            $data=array(
                "id_error_measurement"=>0,
                "rsfe"=>$sum_error,
                // "mad"=>$mad,
                // "mape"=>$mape,
                // "ts"=>$ts,
                "smape"=>$smape,
                "id_tourist_data_type"=>$id_tourist_data_type,
                "id_method_type"=>$id_method_type
                );
                $this->db->insert('error_measurement', $data);
            }
        }
        
    }
}