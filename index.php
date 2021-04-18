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

if(isset($_GET['url'])){
  $modulo =  $_GET['url'];
  if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id = intval(preg_replace('/[^0-9]+/', '',$modulo));
    switch ($modulo) {
      case 'niveles':
        $tabla = getGoalforLevel();
        $data = [];
        foreach ($tabla as $fila => $registro) {
          $data[] = [
            "nombre" => $fila,
            "goles_minimos" => $registro,
          ];
        }
        echo json_encode($data);
        break;
    }
    http_response_code(200);
  }else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $body = file_get_contents("php://input");
    $json = json_decode($body, true);
    if(json_last_error() == 0){
      switch ($modulo) {
      case 'jugadores':
        $tabla="reporte_sueldos";
        $suf="_rs";
        postSueldos($tabla, $suf, $json);
      break;
      case 'niveles':
        $tabla="niveles";
        $suf="_niv";
        insertNiveles($tabla, $suf, $json);
      break;
    }
    http_response_code(200);
    }else{
      print_r(json_last_error());
      http_response_code(400);
    }
  }else{
    http_response_code(405);
  }
}else{
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <title>API Resuelve</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <h1>BREAKPOINTS</h1>
        <div class="mb-2"></div>
        <h2>Jugadores</h2>
        <div class="mb-1"></div>
        <ul class="list-group">
          <li class="list-group-item"><code>POST /jugadores</code></li>
        </ul>
        <div class="mb-2"></div>
        <h2>Niveles</h2>
        <div class="mb-1"></div>
        <ul class="list-group">
          <li class="list-group-item"><code>GET /Niveles</code></li>
          <li class="list-group-item"><code>POST /Niveles</code></li>
        </ul>
      </div>
    </div>
  </div>
</body>

</html>
<?php
}
?>