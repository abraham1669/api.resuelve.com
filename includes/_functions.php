<?php 
require_once 'medoo.php';
require_once '_db.php';
// require_once 'JWT.php';

// function generateToken($json) {
//   global $db;
//   if(isset($json['usuario']) && !empty($json['usuario']) && isset($json["password"]) && !empty($json['password'])){
//     $usuario = trim($json['usuario']);
//     $password = md5($json['password']);
//     $siExiste = $db->count("tbl_usuarios",["AND" =>["correo_usr" => $usuario, "clave_usr" => $password]]);
//     if($siExiste > 0){
//       $data = $db->get("tbl_usuarios","*",["AND" =>["correo_usr" => $usuario, "clave_usr" => $password]]);
//         if($data['activo_usr'] == 1){
//             session_start();
//             $_SESSION['id'] = $data['id_usr'];
//             $_SESSION['nombre'] = $data['nombre_usr'];
//             $_SESSION['correo'] = $data['correo_usr'];
//             $_SESSION['permisos'] = $data['permisos_usr'];
//             $payload = [
//               'iat' => time(),
//               'iss' => 'localhost',
//               'exp' => time() + (15*60),
//               'userId' => $data['id_usr']
//             ];
//             $token = JWT::encode($payload, 'Genotipo');
//             $respuesta = [
//               "status" => 1,
//               "texto" => "Token Generado con éxito",
//               "id" => $data['id_usr'],
//               "nombre" => $data['nombre_usr'],
//               "imagen" => $data['imagen_usr'],
//               "token" => $token,
//             ];
//         }else{
//             $respuesta = [
//               "status" => 0,
//               "texto" => "Contacte al administrador",
//             ];
//         }
//     }else{
//         $respuesta = [
//           "status" => 0,
//           "texto" => "Usuario o contraseña incorrectos",
//         ];
//     }
//   }else{
//       $respuesta = [
//         "status" => 0,
//         "texto" => "Datos Vacios",
//       ];
//   }
//   echo json_encode($respuesta);
// }
// function validateSesion(){
//   $headers = apache_request_headers();
//   if(isset($headers['Authorization'])){
//     $token = str_replace('Bearer ','',$headers['Authorization']);
    
//   }else{
//     return false;
//   }
//   // $datos = [
//   //   "status" => 500,
//   //   "texto" => "Inicie Sesión",
//   // ];
//   // if(!isset($_SESSION['token']) && empty($_SESSION['token'])){
//   //   echo json_encode($datos, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
//   //   exit;
//   // }
// }
function getGoalforLevel(){
  global $db;
  $tabla = [];
  $goles_requeridos_por_nivel = $db->select("niveles",["nombre_niv","goles_minimos_niv"]);
  foreach ($goles_requeridos_por_nivel as $goles => $gol) {
    $tabla[$gol['nombre_niv']] = $gol["goles_minimos_niv"];
  }
  return $tabla;
}
function postSueldos($tabla, $suf, $json){
  // Paso 1, se obtienen los goles de acuerdo al nivel
  // Paso 2, se recorre el json de entrada, para procesar la información de los goles mínimos y el alcance individual
  // Paso 3, se recorre el json de entrada, para obtener el total requerido y total obtenido por el equipo completo
  // Paso 4. Se reasigna a un nuevo arreglo de datos procesados
  // Paso 5. Se recorre el arreglo nuevamente para poder realizar las operaciones necesarias para obtener el sueldo
  $total_requerido = 0;
  $total_obtenido = 0;
  $tabla = getGoalforLevel();
  $datos_procesados = [];
  if(sizeOf($json['jugadores']) > 0){
    foreach ($json['jugadores'] as $jugador => $jug) {
      $jug['goles_minimos'] = $tabla[$jug['nivel']];
      $jug['alcance_individual'] = floatVal(intVal($jug['goles']) / intVal($jug['goles_minimos']));
      $total_requerido = intVal($total_requerido) + intVal($jug['goles_minimos']);
      $total_obtenido = intVal($total_obtenido) + intVal($jug['goles']);
      array_push($datos_procesados, $jug);
    }
  }
  $alcance_equipo = floatVal($total_obtenido / $total_requerido);
  $respuesta = [];
  if(sizeOf($datos_procesados) > 0){
    foreach ($datos_procesados as $datos => $elemento) {
      $suma_porcentajes = floatVal($alcance_equipo + $elemento['alcance_individual']);
      $porcentaje_obtenido = floatVal($suma_porcentajes / 2);
      // print_r("Alcance de ".$elemento['nombre'].": ".$porcentaje_obtenido."<br>");
      $bono_obtenido = floatVal($elemento['bono'] * $porcentaje_obtenido);
      // print_r("Bono de ".$elemento['nombre'].": ".$obtener_bono."<br>");
      $sueldo_completo = floatVal($elemento['sueldo'] + $bono_obtenido);
      // print_r("El sueldo de ".$elemento['nombre'].": ".$sueldo_completo."<br>");
      $elemento['sueldo_completo'] = $sueldo_completo;
      $respuesta['jugadores'][] = [
        "nombre" => $elemento['nombre'],
        "goles_minimos" => $elemento['goles_minimos'],
        "goles" => $elemento['goles'],
        "sueldo" => $elemento['sueldo'],
        "bono" => $elemento['bono'],
        "sueldo_completo" => $elemento['sueldo_completo'],
        "equipo" => $elemento['equipo'],
      ];
    }
  }
  echo json_encode($respuesta);
  // print("<pre>".print_r($respuesta,true)."</pre>");
  // $password = md5($clave);
  // $entrada = [
  //   "nombre".$suf => $nombre,
  //   "correo".$suf => $correo,
  //   "usuario".$suf => $usuario,
  //   "clave".$suf => $password,
  //   "permisos".$suf => $permiso,
  //   "modulos".$suf => $modulos
  // ];
  // $datos = $db->insert($tabla, $entrada);
  // $error = $db->error();
  // $respuesta =  ["status" => "error", "code" => 400, "message" => $error[2]];
  // if($datos->rowCount() > 0){
  //   $respuesta =  ["status" => "ok", "code" => 200, "message" => "Acción realizada correctamente"];
  // }
  // echo json_encode($respuesta);
}
function insertNiveles($tabla, $suf, $json){
  global $db;
  $entrada = [
    "nombre".$suf => $nombre,
    "goles_minimos".$suf => $correo,
  ];
  $datos = $db->insert($tabla, $entrada);
  $error = $db->error();
  $respuesta =  ["status" => "error", "code" => 400, "message" => $error[2]];
  if($datos->rowCount() > 0){
    $respuesta =  ["status" => "ok", "code" => 200, "message" => "Acción realizada correctamente"];
  }
  echo json_encode($respuesta);
}
?>