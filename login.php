<?php
require "vendor/autoload.php";
session_start();
$data = $_POST["auth"];
$function = $_POST["function"];

if(!isset($_SESSION["client"])){
    $_SESSION["client"] = new Requests_Session();
}
$response = $_SESSION["client"]->post("https://is.sps-prosek.cz/login.php?function=".$function, array(), array("data" => $data));
$info = json_decode($response->body);
if($info->STATUS == true){
    header("grades.html");
}
?>