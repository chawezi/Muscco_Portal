<?php
include_once('../../settings/master-class.php');
$con = new MasterClass;
$db = $con->backup();

echo $db;

