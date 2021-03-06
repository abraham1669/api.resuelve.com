# API Resuelve Jugadores

Este proyecto est谩 enfocado en la prueba de Backend de Resuelve, en el se generaron algunos Breakpoints para el consumo de la API B谩sica P煤blica, puedes ver un demo en el siguiente enlace: [API Resuelve Jugadores](http://api.internet-rv.com.mx/)

Si quieres ver un demo funcionando de una interfaz para la API, puedes ir al siguiente enlace: [Resuelve Jugadores](http://jugadores.internet-rv.com.mx/), Si descargar el repositorio, lo puedes hacer en la siguiente liga: [Repositorio Resuelve Jugadores](https://github.com/abraham1669/jugadores.resuelve.com)

## Comenzando 馃殌

Para iniciar, solo necesitamos clonar el repositorio:

1. Sobre la lista de archivos, da clic en C贸digo.
2. Copia la URL que aparece dentro de la secci贸n HTTPS
3. Abre la Terminal.
4. Cambia el directorio de trabajo actual a la ubicaci贸n en donde quieres clonar el directorio.
5. Escribe git clone, y luego pega la URL que copiaste antes.

> $ git clone https://github.com/abraham1669/api.resuelve.com.git

6.Presiona Enter para crear tu clon local.

NOTAS:

- Si tienes instalado Github Desktop, Repite el paso 1 pero selecciona la opci贸n Open With Github Desktop y Sigue las indicaciones en GitHub Desktop para completar la clonaci贸n.
- Si lo prefieres, puedes descargar el archivo comprimido del proyecto.

Mira **Instalaci贸n** para conocer como desplegar el proyecto.

### Pre-requisitos 馃搵

- PHP 7.3 or PHP 7.4 (Requerimiento m铆nimo de las pruebas)
- Medoo Framework 1.7.0
- PHPUnit 9
- Guzzle 7.0
- Composer

NOTA: Tanto PHPUnit como Guzzle 7.0 fueron instalados por composer, por lo que se encuentran dentro del directorio vendor, estos directorios no influyen en la implementaci贸n del proyecto, solo funcionan para las pruebas.

### Instalaci贸n 馃敡

1. El despliegue de este proyecto es muy sencillo, simplemente necesitamos subir al servidor los siguientes archivos y directorios:

- .htaccess (Preconfigurado para cargar las rutas)
- index.php
- includes/\*

2. Crear la base de datos en el servidor
3. Una vez creada la base de datos, entrar a la ruta includes/\_db.php y cambiar los datos de conexi贸n a la base de datos
4. Para poder ejecutar las pruebas, es necesario instalar las dependencias de desarrollo, mediante composer
   > $ composer install

NOTA:

- Dentro de la carpeta includes se encuentra una librer铆a llamada JWT.php, utilizada para poder crear Tokens JWT, sin embargo, actualmente en el proyecto no fue implementada por lo que la podr铆amos omitir
- El archivo \_db.php contiene una sentencia IF, esto es por si necesitan hacer pruebas en local y el else cuando se ejecuta en el servidor.

## Ejecutando las pruebas 鈿欙笍

Para poder hacer uso de las pruebas, se puede seguir dos caminos:

1. Mediante consola o terminal
   1.1. Mediante la consola posicionarnos en el directorio del proyecto, ejemplo:
   Supongamos que estoy en una Mac utilizando XAMPP como servidor local, tendr铆a que dirigirme a /Applications/XAMPP/xamppfiles/htdocs/api.resuelve.com
   1.2. Dentro del directorio del proyecto, podemos ejecutar la instrucci贸n: ./vendor/bin/phpunit tests --verbose
2. En Visual Studio Code, existe un plugin para PHPUnit, por lo que podemos hacer uso del mismo:
   2.1. Instalar el plugin PHPUnit de Elon Mallin.
   2.2. Posicionarnos en el archivo de test que queremos ejecutar
   2.3. Abrir la paleta de comandos (cmd + shift + p) en Mac
   2.4. Ejecutar PHPUnit Test
   2.5. El plugin nos preguntar谩 si deseamos ejecutar 煤nicamente una funcion(test) o el Suite de Tests (Clase)

NOTAS:

- El Flag Verbose sirve para que nos retorne un mensaje m谩s expresivo en los test.
- Es importante revisar como se construye la ruta del directorio de acuerdo al sistema operativo.

## Construido con 馃洜锔?


- [Medoo](https://medoo.in/) - Medoo Framework para Bases de Datos
- [PHPUnit](https://phpunit.de/) - Pruebas Automatizadas
- [Guzzle](https://docs.guzzlephp.org/en/stable/) - Usado para generar Peticiones al servidor

## Versionado 馃搶

Usamos [SemVer](http://semver.org/) para el versionado.

## Autores 鉁掞笍

- **Abraham Pech** - _Proyecto_ - [abraham1669](https://github.com/abraham1669)

---

鈱笍 con 鉂わ笍 por [abraham1669](https://github.com/abraham1669) 馃槉
