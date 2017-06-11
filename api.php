<?php
require "vendor/autoload.php";
session_start();

function main(){
    $request = json_decode($_POST["request"]);
    switch($request->type){
        case "RSAInfo":
            GetRSAInfo();
            break;
        case "login":
            Login($request);
            break;
        case "classification":
            GetClassification($request);
            break;
    }
}

function GetClient() {
    if(!isset($_SESSION["client"])){
        $_SESSION["client"] = new Requests_Session();
    }

    return $_SESSION["client"];
}

function GetRSAInfo() {
    $client = GetClient();
    $response = $client->get("https://is.sps-prosek.cz/6NpSdyj2TJw45LYb.php");
    echo $response->body;
} 

function Login($request) {
    $response = GetClient()->post("https://is.sps-prosek.cz/login.php?function=".$request->function, array(), array("data" => json_encode($request->auth)));
    $info = json_decode($response->body);
    if($info->STATUS == true){
        header("Location: grades.html");
    }
}

function GetClassification($request){
    $response = GetClient()->post("https://is.sps-prosek.cz/classification.php?function=".$request->function, array(), array("data" => json_encode($request->data)));
    echo $response->body;
}

main();
?>