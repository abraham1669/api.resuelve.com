<?php 
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;

class EndPointTest extends TestCase
{
    public function testObtieneCodigo200(){
      $client = new Client([
    'base_uri' => 'https://api.chalaneros.com',
      ]);
      
    $response = $client->request('POST', '/jugadores', ['body' => '
        {
        "jugadores" : [  
            {  
              "nombre":"Juan Perez",
              "nivel":"C",
              "goles":10,
              "sueldo":50000,
              "bono":25000,
              "sueldo_completo":null,
              "equipo":"rojo"
            },
            {  
              "nombre":"EL Cuauh",
              "nivel":"Cuauh",
              "goles":30,
              "sueldo":100000,
              "bono":30000,
              "sueldo_completo":null,
              "equipo":"azul"
            },
            {  
              "nombre":"Cosme Fulanito",
              "nivel":"A",
              "goles":7,
              "sueldo":20000,
              "bono":10000,
              "sueldo_completo":null,
              "equipo":"azul"

            },
            {  
              "nombre":"El Rulo",
              "nivel":"B",
              "goles":9,
              "sueldo":30000,
              "bono":15000,
              "sueldo_completo":null,
              "equipo":"rojo"

            }
        ]
      }
    ']);

    $body = $response->getBody();
    $arr_body = json_decode($body);
    $this->assertEquals(200, $response->getStatusCode());
    }
    public function testObtieneDatosDeJugadores(){
      $client = new Client([
    'base_uri' => 'https://api.chalaneros.com',
      ]);
      
    $response = $client->request('POST', '/jugadores', ['body' => '
        {
        "jugadores" : [  
            {  
              "nombre":"Juan Perez",
              "nivel":"C",
              "goles":10,
              "sueldo":50000,
              "bono":25000,
              "sueldo_completo":null,
              "equipo":"rojo"
            },
            {  
              "nombre":"EL Cuauh",
              "nivel":"Cuauh",
              "goles":30,
              "sueldo":100000,
              "bono":30000,
              "sueldo_completo":null,
              "equipo":"azul"
            },
            {  
              "nombre":"Cosme Fulanito",
              "nivel":"A",
              "goles":7,
              "sueldo":20000,
              "bono":10000,
              "sueldo_completo":null,
              "equipo":"azul"

            },
            {  
              "nombre":"El Rulo",
              "nivel":"B",
              "goles":9,
              "sueldo":30000,
              "bono":15000,
              "sueldo_completo":null,
              "equipo":"rojo"

            }
        ]
      }
    ']);

    $body = $response->getBody();
    $arr_body = json_decode($body, true);
    if(sizeof($arr_body['jugadores']) > 0){
      foreach ($arr_body['jugadores'] as $jugador => $jug) {
        $this->assertArrayHasKey('sueldo_completo',$jug);
      }
    }
    }
    public function testObtieneLosNivelesGenerales(){
      $client = new Client([
    'base_uri' => 'https://api.chalaneros.com',
      ]);
      
    $response = $client->request('GET', '/niveles');

    $body = $response->getBody();
    $arr_body = json_decode($body, true);
    if(sizeof($arr_body) > 0){
      foreach ($arr_body as $niveles => $nivel) {
        $this->assertArrayHasKey('nombre',$nivel);
        $this->assertArrayHasKey('goles_minimos',$nivel);
      }
    }
    }
}
?>