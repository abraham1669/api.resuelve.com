<?php 
require_once 'medoo.php';
require_once '_db.php';

function getGoalforLevel(){
  // Nos conectamos a la base de datos para poder obtener los registros de los niveles.
  global $db;
  $tabla = [];
  $goles_requeridos_por_nivel = $db->select("niveles",["nombre_niv","goles_minimos_niv"]);
  foreach ($goles_requeridos_por_nivel as $goles => $gol) {
    $tabla[$gol['nombre_niv']] = $gol["goles_minimos_niv"];
  }
  return $tabla;
}
function getEquipos(){
  // Nos conectamos a la base de datos para poder obtener los registros de los equipos
  global $db;
  $tabla = [];
  $equipos = $db->select("equipos","*");
  foreach ($equipos as $equipo => $eq) {
    $tabla[] = [
      'nombre' => $eq["nombre_eq"],
      'id' => $eq["id_eq"],
    ];
  }
  echo json_encode($tabla);
}
function obtenerAlcanceEquipo($json){
  $total_requerido = 0;
  $total_obtenido = 0;
  $tabla = getGoalforLevel();
  $datos_procesados = [];
  if(sizeOf($json['jugadores']) > 0){
    foreach ($json['jugadores'] as $jugador => $jug) {
      $jug['goles_minimos'] = $tabla[$jug['nivel']];
      $jug['alcance_individual'] = (floatVal(intVal($jug['goles']) / intVal($jug['goles_minimos'])) > 1) ? 1 : floatVal(intVal($jug['goles']) / intVal($jug['goles_minimos']));
      $total_requerido = intVal($total_requerido) + intVal($jug['goles_minimos']);
      $total_obtenido = intVal($total_obtenido) + intVal($jug['goles']);
      array_push($datos_procesados, $jug);
    }
  }
  if($total_obtenido >= $total_requerido){
    $alcance_equipo = floatval(1);
  }else{
    $alcance_equipo = floatVal($total_obtenido / $total_requerido);
  }
  $arreglo = [
    "alcance_equipo" => $alcance_equipo,
    "datos_procesados" => $datos_procesados,
  ];
  return $arreglo;
}
function crearJsonDeRespuesta($datos_procesados, $alcance_equipo){
  $respuesta = [];
  if(sizeOf($datos_procesados) > 0){
    foreach ($datos_procesados as $datos => $elemento) {
      $suma_porcentajes = floatVal($alcance_equipo + $elemento['alcance_individual']);
      $porcentaje_obtenido = floatVal($suma_porcentajes / 2);
      $bono_obtenido = floatVal($elemento['bono'] * $porcentaje_obtenido);
      $sueldo_completo = floatVal($elemento['sueldo'] + $bono_obtenido);
      $elemento['sueldo_completo'] = $sueldo_completo;
      $respuesta['jugadores'][] = [
        "nombre" => $elemento['nombre'],
        "goles_minimos" => intVal($elemento['goles_minimos']),
        "goles" => $elemento['goles'],
        "sueldo" => $elemento['sueldo'],
        "bono" => $elemento['bono'],
        "sueldo_completo" => round($elemento['sueldo_completo'],2),
        "equipo" => $elemento['equipo'],
      ];
    }
  }
  return $respuesta;
}
function postSueldos($tabla, $suf, $json){
  // Paso 1, se obtienen los goles de acuerdo al nivel
  // Paso 2, se recorre el json de entrada, para procesar la información de los goles mínimos y el alcance individual
  // Paso 3, se recorre el json de entrada, para obtener el total requerido y total obtenido por el equipo completo
  // Paso 4. Se reasigna a un nuevo arreglo de datos procesados
  // Paso 5. Se recorre el arreglo nuevamente para poder realizar las operaciones necesarias para obtener el sueldo
  $datos_generales = obtenerAlcanceEquipo($json);
  $alcance_equipo = $datos_generales["alcance_equipo"];
  $datos_procesados = $datos_generales["datos_procesados"];
  $respuesta = crearJsonDeRespuesta($datos_procesados, $alcance_equipo);
  echo json_encode($respuesta);
  
}
function insertNiveles($tabla, $suf, $json){
  // Función POST para poder insertar nuevos niveles
  global $db;
  $entrada = [
    "nombre".$suf => $json['nombre'],
    "goles_minimos".$suf => $json['goles_minimos'],
  ];
  $datos = $db->insert($tabla, $entrada);
  $error = $db->error();
  $respuesta =  ["status" => "error", "code" => 400, "message" => $error[2]];
  if($datos->rowCount() > 0){
    $respuesta =  ["status" => "ok", "code" => 200, "message" => "Acción realizada correctamente"];
  }
  echo json_encode($respuesta);
}
function insertEquipos($tabla, $suf, $json){
  // Función POST para poder insertar nuevos equipos
  global $db;
  $entrada = [
    "nombre".$suf => $json['nombre']
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