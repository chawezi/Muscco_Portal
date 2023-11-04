<?php
session_start();
include_once('../../settings/master-class.php');
$con =new MasterClass;
if(isset($_GET['action']) && $_GET['action'] == 'rates'){
  $value = $_GET['svalue'];
  $band = $con->getRows('band_rates', array('where'=>'band_id="'.$_SESSION['USR_BD'].'"','return_type'=>'single'));
  if($value == 1){
    echo $band['with_accomodation'];
  }elseif($value == 2){
    echo $band['lumpsum'];
  }elseif($value == 3){
    echo $band['withoutaccomodation_nomeals'];
  }
}else if(isset($_GET['action']) && $_GET['action'] == 'fuel'){
  $fuel = $_GET['svalue'];
  $get_fuel = $con->getRows('fuel_prices', array('where'=>'fuel_id="'.$fuel.'"', 'return_type'=>'single'));
  echo $get_fuel['current_price'];
}

?>