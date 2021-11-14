<?php
class CalculateForecast_model extends CI_model
{

    public function get_coefisien_parameter(
        $id_tourist_data_type,
        $id_method_type
    ){
        $sql_c="SELECT * FROM coefficient_parameter WHERE id_tourist_data_type=$id_tourist_data_type AND id_method_type=$id_method_type";
        $data=$this->db->query($sql_c)->row_array();
        return $data;
    }
    
    public function get_data_all(
        $id_tourist_data_type,
        $id_method_type
    ){
        $sql_data_tourist="SELECT t,
        id_data_pengunjung,
        data_pengunjung,
        `month`,
        `year`,
        ctdma,
        ratio,
        id_seasonal_index,
        seasonal_index,
        smoothed
        FROM data_pengunjung
        NATURAL JOIN calculate_ctdma
        NATURAL JOIN calculate_ratio
        NATURAL JOIN seasonal_index
        NATURAL JOIN calculate_smoothed
        WHERE 
        id_tourist_data_type=$id_tourist_data_type
        AND 
        id_method_type=$id_method_type
        ORDER BY t ASC";
        $data_tourist=$this->db->query($sql_data_tourist)->result_array();
        return $data_tourist;
    }

    public function insert_calculate_forecast(
        $id_data_pengunjung,
        $unadjusted,
        $adjusted,
        $error,
        $mad,
        $mape,
        $id_method_type
    ){
        $data=array(
            "id_calculate_forecasting"=>null,
            "id_data_pengunjung"=>$id_data_pengunjung,
            "unadjusted"=>$unadjusted,
            "adjusted"=>$adjusted,
            "error"=>$error,
            "mad"=>$mad,
            "mape"=>$mape,
            "id_method_type"=>$id_method_type
            );
            $this->db->insert('calculate_forecasting', $data);
    }


    public function calculate_forecast_year(
        $id_tourist_data_type
    ){
        for ($id_method_type = 1; $id_method_type <= 2; $id_method_type++){
            $coefisien_parameter=$this->get_coefisien_parameter(
                $id_tourist_data_type,
                $id_method_type
            );
    
            $a=(double)$coefisien_parameter['a'];
            $b=(double)$coefisien_parameter['b'];
            $data_tourist= $this->get_data_all($id_tourist_data_type,$id_method_type);
            foreach ($data_tourist as $data) {
                // echo($data['season']. "<br>");
                $t=$data['t'];
                $id_data_pengunjung=$data['id_data_pengunjung'];
                $data_pengunjung=$data['data_pengunjung'];
                $seasonal_index=$data['seasonal_index'];
                $unadjusted=$a+$b*$t;
    
                if( $id_method_type==1){
                    $adjusted=$seasonal_index+$unadjusted;
                }else
                if( $id_method_type==2){
                    $adjusted=$seasonal_index*$unadjusted;
                }
                
                $error=$data_pengunjung-$adjusted;
                $mad=abs($error);
                $mape=abs($error/$data_pengunjung);
    
                $this-> insert_calculate_forecast(
                    $id_data_pengunjung,
                    $unadjusted,
                    $adjusted,
                    $error,
                    $mad,
                    $mape,
                    $id_method_type
                );
    
            }
        }

        
    }
}