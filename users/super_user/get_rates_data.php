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
    echo 0;
  }elseif($value == 4){
    //$rates= [$band['with_accomodation'], $band['lumpsum']];
    //print_r($rates);

    $dataArray = array('value1' => $band['with_accomodation'], 'value2' => $band['lumpsum']);

    // Encode the array as JSON
    $jsonData = json_encode($dataArray);

    // Send JSON response
    header('Content-Type: application/json');
    echo $jsonData;
  }
}else if(isset($_GET['action']) && $_GET['action'] == 'fuel'){
  $fuel = $_GET['svalue'];
  $get_fuel = $con->getRows('fuel_prices', array('where'=>'fuel_id="'.$fuel.'"', 'return_type'=>'single'));
  echo $get_fuel['current_price'];
}

?>