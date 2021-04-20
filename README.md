# API Resuelve Jugadores

Este proyecto está enfocado en la prueba de Backend de Resuelve, en el se generaron algunos Breakpoints para el consumo de la API Básica Pública, puedes ver un demo en el siguiente enlace: [API Resuelve Jugadores](http://api.internet-rv.com.mx/)

Si quieres ver un demo funcionando de una interfaz para la API, puedes ir al siguiente enlace: [Resuelve Jugadores](http://jugadores.internet-rv.com.mx/), Si descargar el repositorio, lo puedes hacer en la siguiente liga: [Repositorio Resuelve Jugadores](https://github.com/abraham1669/jugadores.resuelve.com)

## Comenzando 🚀

Para iniciar, solo necesitamos clonar el repositorio:

1. Sobre la lista de archivos, da clic en Código.
2. Copia la URL que aparece dentro de la sección HTTPS
3. Abre la Terminal.
4. Cambia el directorio de trabajo actual a la ubicación en donde quieres clonar el directorio.
5. Escribe git clone, y luego pega la URL que copiaste antes.

> $ git clone https://github.com/abraham1669/api.resuelve.com.git

6.Presiona Enter para crear tu clon local.

NOTAS:

- Si tienes instalado Github Desktop, Repite el paso 1 pero selecciona la opción Open With Github Desktop y Sigue las indicaciones en GitHub Desktop para completar la clonación.
- Si lo prefieres, puedes descargar el archivo comprimido del proyecto.

Mira **Instalación** para conocer como desplegar el proyecto.

### Pre-requisitos 📋

- PHP 7.3 or PHP 7.4 (Requerimiento mínimo de las pruebas)
- Medoo Framework 1.7.0
- PHPUnit 9
- Guzzle 7.0
- Composer

NOTA: Tanto PHPUnit como Guzzle 7.0 fueron instalados por composer, por lo que se encuentran dentro del directorio vendor, estos directorios no influyen en la implementación del proyecto, solo funcionan para las pruebas.

### Instalación 🔧

1. El despliegue de este proyecto es muy sencillo, simplemente necesitamos subir al servidor los siguientes archivos y directorios:

- .htaccess (Preconfigurado para cargar las rutas)
- index.php
- includes/\*

2. Crear la base de datos en el servidor
3. Una vez creada la base de datos, entrar a la ruta includes/\_db.php y cambiar los datos de conexión a la base de datos
4. Para poder ejecutar las pruebas, es necesario instalar las dependencias de desarrollo, mediante composer
   > $ composer install

NOTA:

- Dentro de la carpeta includes se encuentra una librería llamada JWT.php, utilizada para poder crear Tokens JWT, sin embargo, actualmente en el proyecto no fue implementada por lo que la podríamos omitir
- El archivo \_db.php contiene una sentencia IF, esto es por si necesitan hacer pruebas en local y el else cuando se ejecuta en el servidor.

## Ejecutando las pruebas ⚙️

Para poder hacer uso de las pruebas, se puede seguir dos caminos:

1. Mediante consola o terminal
   1.1. Mediante la consola posicionarnos en el directorio del proyecto, ejemplo:
   Supongamos que estoy en una Mac utilizando XAMPP como servidor local, tendría que dirigirme a /Applications/XAMPP/xamppfiles/htdocs/api.resuelve.com
   1.2. Dentro del directorio del proyecto, podemos ejecutar la instrucción: ./vendor/bin/phpunit tests --verbose
2. En Visual Studio Code, existe un plugin para PHPUnit, por lo que podemos hacer uso del mismo:
   2.1. Instalar el plugin PHPUnit de Elon Mallin.
   2.2. Posicionarnos en el archivo de test que queremos ejecutar
   2.3. Abrir la paleta de comandos (cmd + shift + p) en Mac
   2.4. Ejecutar PHPUnit Test
   2.5. El plugin nos preguntará si deseamos ejecutar únicamente una funcion(test) o el Suite de Tests (Clase)

NOTAS:

- El Flag Verbose sirve para que nos retorne un mensaje más expresivo en los test.
- Es importante revisar como se construye la ruta del directorio de acuerdo al sistema operativo.

## Construido con 🛠️


- [Medoo](https://medoo.in/) - Medoo Framework para Bases de Datos
- [PHPUnit](https://phpunit.de/) - Pruebas Automatizadas
- [Guzzle](https://docs.guzzlephp.org/en/stable/) - Usado para generar Peticiones al servidor

## Versionado 📌

Usamos [SemVer](http://semver.org/) para el versionado.

## Autores ✒️

- **Abraham Pech** - _Proyecto_ - [abraham1669](https://github.com/abraham1669)

---

⌨️ con ❤️ por [abraham1669](https://github.com/abraham1669) 😊
