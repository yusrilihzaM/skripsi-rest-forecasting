<?php
class Future_model extends CI_model
{
    public function get_season_index(
        $id_tourist_data_type,
        $id_method_type,
        $season
    ){
        $sql_si="SELECT id_seasonal_index, seasonal_index FROM seasonal_index WHERE id_tourist_data_type=$id_tourist_data_type AND id_method_type=$id_method_type AND `month`=$season";
        $data_si=$this->db->query($sql_si)->row_array();
        return $data_si;
    }
    public function get_count_forecast(){
        $sql_si="SELECT COUNT(id_forecast_future) count_data FROM forecast_future";
        $data_si=$this->db->query($sql_si)->row_array();
        return $data_si;
    }
    public function get_future_forecast(
        $id_tourist_data_type = null,
        $id_method_type = null
        )
    {
        if ($id_tourist_data_type == null){
            return $this->db->get('forecast_future')->result_array();
        }else{
            return $this->db->query("SELECT * FROM forecast_future WHERE id_tourist_data_type=$id_tourist_data_type AND id_method_type=$id_method_type")->result_array();
        }
    }

    public function get_last_data(
        $id_tourist_data_type
    ){
        $sql_last_data="SELECT 
        t,
        `month`,
        `year`
        FROM data_pengunjung
        WHERE 
        id_tourist_data_type=$id_tourist_data_type
        ORDER BY t DESC LIMIT 1";

        $last_data=$this->db->query($sql_last_data)->row_array();
        return $last_data;
    }
    public function insert_future(
        $season_future,
        $year_future,
        $t_future,
        $id_seasonal_index,
        $unadjusted_forecast,
        $adjusted_forecast,
        $id_tourist_data_type,
        $id_method_type
    ){
        $data=array(
            "id_forecast_future"=>0,
            "season_future"=>$season_future,
            "year_future"=>$year_future,
            "t_future"=>$t_future,
            "id_seasonal_index"=>$id_seasonal_index,
            "unadjusted_forecast"=>$unadjusted_forecast,
            "adjusted_forecast"=>$adjusted_forecast,
            "id_tourist_data_type"=>$id_tourist_data_type,
            "id_method_type"=>$id_method_type
        );

        $this->db->insert('forecast_future', $data);
    }

    public function get_coefisien_parameter( 
        $id_tourist_data_type,
        $id_method_type
        ){
        $sql="SELECT a, b FROM coefficient_parameter WHERE id_tourist_data_type=$id_tourist_data_type AND id_method_type=$id_method_type";
        $data=$this->db->query($sql)->row_array();
        return $data;
    }

    public function future_year(
        $period,
        $id_tourist_data_type,
        $id_method_type
    ){
        $last_data=$this->get_last_data($id_tourist_data_type);
        $last_t=(int)$last_data['t'];
        $last_season=(int)$last_data['month'];
        $last_year=(int)$last_data['year'];

        $a=(double) $this->get_coefisien_parameter( $id_tourist_data_type,$id_method_type)['a'];
        $b=(double) $this->get_coefisien_parameter( $id_tourist_data_type,$id_method_type)['b'];

        $current_year=0;
        $current_season=0;
        if($last_season==12){
            $current_season=1;
            $current_year=$last_year+1;
        }
        else{
            $current_season= $last_season+1;
            $current_year=$last_year;
        }
  
       
        for ($x = 1; $x <= $period; $x++){
            $current_t=$last_t+$x+1;
            $id_seasonal_index=(int)$this->get_season_index( $id_tourist_data_type,$id_method_type,$current_season)["id_seasonal_index"];
            $seasonal_index=(double)$this->get_season_index( $id_tourist_data_type,$id_method_type,$current_season)["seasonal_index"];
            $unadjusted_forecast=$a+$b*$current_t;
            if( $id_method_type==1){
                $adjusted_forecast=$unadjusted_forecast+$seasonal_index;
            }else
            if( $id_method_type==2){
                $adjusted_forecast=$unadjusted_forecast*$seasonal_index;
            }
            // echo("--$current_season :id_seasonal_index $id_seasonal_index<br>");
            $this->insert_future(
                $current_season,
                $current_year,
                $current_t,
                $id_seasonal_index,
                $unadjusted_forecast,
                $adjusted_forecast,
                $id_tourist_data_type,
                $id_method_type
            );
            $current_season= $current_season+1;
            if($current_season>12){
                $current_season=1;
                $current_year=$current_year+1;
            }
            else{
                $current_year=$current_year;
            }
        }
    }
}