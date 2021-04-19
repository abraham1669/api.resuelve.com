<?php 
require_once 'includes/_functions.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, PATCH, DELETE");
header("Allow: GET, POST, OPTIONS, PUT,PATCH, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

switch ($method) {
  case 'POST':
    $body = file_get_contents("php://input");
    $json = json_decode($body, true);
    if(json_last_error() == 0){
      $tabla="reporte_sueldos";
      $suf="_rs";
      postSueldos($tabla, $suf, $json);
      http_response_code(200);
    }else{
      http_response_code(400);
    }
    break;
  
}
?>