<?php
require "vendor/autoload.php";
session_start();
if(!isset($_SESSION["client"])){
    $_SESSION["client"] = new Requests_Session();
}
$response = $_SESSION["client"]->get("https://is.sps-prosek.cz/6NpSdyj2TJw45LYb.php");
echo $response->body;
?>