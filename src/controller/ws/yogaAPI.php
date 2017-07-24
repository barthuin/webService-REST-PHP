<?php
/* Los headers permiten acceso desde otro dominio (CORS) a nuestro REST API o desde un cliente remoto via HTTP
* Removiendo las lineas header() limitamos el acceso a nuestro RESTfull API a el mismo dominio
* Nótese los métodos permitidos en Access-Control-Allow-Methods. Esto nos permite limitar los métodos de consulta a nuestro RESTfull API
* Mas información: https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
**/
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
 
include_once './config/config.php';
 
/* Puedes utilizar este file para conectar con base de datos incluido en este demo;
* si lo usas debes eliminar el include_once del file Config ya que le mismo está incluido en DBHandler
**/
//require_once '../include/DbHandler.php';
 
require './vendor/autoload.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
/* Usando GET para consultar los autos */
$app->get('/canales', 'authenticate', function () {
    include_once('./src/model/dao/daoCanal.php');
    $daoCanal = new daoCanal();
    $response = array();
    $canalesArr = array();
    //$db = new DbHandler();
     
    /* Array de autos para ejemplo response
    * Puesdes usar el resultado de un query a la base de datos mediante un metodo en DBHandler
    **/
    $canales = $daoCanal->listAll();     
    foreach ($canales as $canal) {
        $array =  array('nombre'=>$canal->getNombre(), 'url'=>$canal->getURL(), 'imagen'=>$canal->getImagen(), 'ingles'=>$canal->getIngles(), 'id'=>$canal->getId());

        array_push($canalesArr,$array);
    }
     
    $response["error"] = false;
    $response["message"] = "canales: " . count($canalesArr); //podemos usar count() para conocer el total de valores de un array
    $response["canales"] = $canalesArr;
     
    echoResponse(200, $response);
});

$app->get('/canal/:id', 'authenticate', function ($id) {
    include_once('./src/model/dao/daoCanal.php');
    $daoCanal = new daoCanal();
    $response = array();
    //$db = new DbHandler();
     
    /* Array de autos para ejemplo response
    * Puesdes usar el resultado de un query a la base de datos mediante un metodo en DBHandler
    **/
    $canal = $daoCanal->findById($id);
    $canalRes = array('nombre'=>$canal->getNombre(), 'url'=>$canal->getURL(), 'imagen'=>$canal->getImagen(), 'ingles'=>$canal->getIngles(), 'id'=>$canal->getId());
     
    $response["error"] = false;
    //$response["message"] = "canales: " . count($canal); //podemos usar count() para conocer el total de valores de un array
    $response["canal"] = $canalRes;
     
    echoResponse(200, $response);
});

$app->get('/canal/:id/playlist', 'authenticate', function ($id) {
    include_once('./src/model/dao/daoPlaylist.php');
    $daoPlaylist = new daoPlaylist();
    $response = array();
    $playlistArr = array();

    $playlists = $daoPlaylist->findByIdCanal($id);
    
    foreach ($playlists as $playlist) {
        $array =  array('id'=>$playlist->getId(), 'idYoutube'=>$playlist->getIdYoutube(), 'descripcion'=>$playlist->getDescripcion(), 'ingles'=>$playlist->getIngles(), 'titulo'=>$playlist->getTitulo(), 'imagen'=>$playlist->getImagen());

        array_push($playlistArr,$array);
    } 
    $response["error"] = false;
    $response["message"] = "playlists: " . count($playlistArr); //podemos usar count() para conocer el total de valores de un array
    $response["playlists"] = $playlistArr;
     
    echoResponse(200, $response);
});

$app->get('/canal/:id/videos', 'authenticate', function ($id) {
    include_once('./src/model/dao/daoVideo.php');
    $daoVideo = new daoVideo();
    $response = array();
    $videosArr = array();
    //$db = new DbHandler();
     
    /* Array de autos para ejemplo response
    * Puesdes usar el resultado de un query a la base de datos mediante un metodo en DBHandler
    **/
    $videos = $daoVideo->findByIdCanal($id);
    foreach ($videos as $video) {
        $array =  array('id'=>$video->getId(), 'idYoutube'=>$video->getIdYoutube(), 'titulo'=>$video->getTitulo(), 'imagen'=>$video->getImagen());

        array_push($videosArr,$array);
    }
     
    $response["error"] = false;
    $response["message"] = "videos: " . count($videosArr); //podemos usar count() para conocer el total de valores de un array
    $response["videos"] = $videosArr;
     
    echoResponse(200, $response);
});

$app->get('/playlists', 'authenticate', function () {
    include_once('./src/model/dao/daoPlaylist.php');
    $daoPlaylist = new daoPlaylist();
    $response = array();
    $playlistArr = array();
    //$db = new DbHandler();
     
    /* Array de autos para ejemplo response
    * Puesdes usar el resultado de un query a la base de datos mediante un metodo en DBHandler
    **/
    $playlists = $daoPlaylist->listAll();
    foreach ($playlists as $playlist) {
        $array =  array('id'=>$playlist->getId(), 'idYoutube'=>$playlist->getIdYoutube(), 'descripcion'=>$playlist->getDescripcion(), 'ingles'=>$playlist->getIngles(), 'titulo'=>$playlist->getTitulo(), 'imagen'=>$playlist->getImagen());

        array_push($playlistArr,$array);
    }
     
    $response["error"] = false;
    $response["message"] = "playlists: " . count($playlistArr); //podemos usar count() para conocer el total de valores de un array
    $response["playlists"] = $playlistArr;
     
    echoResponse(200, $response);
});

$app->get('/playlist/:id', 'authenticate', function ($id) {
    include_once('./src/model/dao/daoPlaylist.php');
    $daoPlaylist = new daoPlaylist();
    $response = array();

    $playlist = $daoPlaylist->findById($id);
    if($playlist != null){
        $playlistRes = array('id'=>$playlist->getId(), 'idYoutube'=>$playlist->getIdYoutube(), 'descripcion'=>$playlist->getDescripcion(), 'ingles'=>$playlist->getIngles(), 'titulo'=>$playlist->getTitulo(), 'imagen'=>$playlist->getImagen());    
    }
    else{
        $playlistRes = array();
    }
    
     
    $response["error"] = false;
    //$response["message"] = "canales: " . count($canal); //podemos usar count() para conocer el total de valores de un array
    $response["playlist"] = $playlistRes;
     
    echoResponse(200, $response);
});

$app->get('/videos', 'authenticate', function () {
    include_once('./src/model/dao/daoVideo.php');
    $daoVideo = new daoVideo();
    $response = array();
    $videosArr = array();
    //$db = new DbHandler();
     
    /* Array de autos para ejemplo response
    * Puesdes usar el resultado de un query a la base de datos mediante un metodo en DBHandler
    **/
    $videos = $daoVideo->listAll();
    foreach ($videos as $video) {
        $array =  array('id'=>$video->getId(), 'idYoutube'=>$video->getIdYoutube(), 'titulo'=>$video->getTitulo(), 'imagen'=>$video->getImagen());

        array_push($videosArr,$array);
    }
     
    $response["error"] = false;
    $response["message"] = "videos: " . count($videosArr); //podemos usar count() para conocer el total de valores de un array
    $response["videos"] = $videosArr;
     
    echoResponse(200, $response);
});

$app->get('/video/:id', 'authenticate', function ($id) {
    include_once('./src/model/dao/daoVideo.php');
    $daoVideo = new daoVideo();
    $response = array();

    $video = $daoVideo->findById($id);
    if($video != null){
        $playlistRes = array('id'=>$video->getId(), 'idYoutube'=>$video->getIdYoutube(), 'titulo'=>$video->getTitulo(), 'imagen'=>$video->getImagen());    
    }
    else{
        $playlistRes = array();
    }
    
     
    $response["error"] = false;
    //$response["message"] = "canales: " . count($canal); //podemos usar count() para conocer el total de valores de un array
    $response["video"] = $playlistRes;
     
    echoResponse(200, $response);
});

 
/* corremos la aplicación */
$app->run();
 
/*********************** USEFULL FUNCTIONS **************************************/
 
/**
* Mostrando la respuesta en formato json al cliente o navegador
* @param String $status_code Http response code
* @param Int $response Json response
*/
function echoResponse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);
     
    // setting response content type to json
    $app->contentType('application/json');
     
    echo json_encode($response);
}
 
/**
* Agregando un leyer intermedio e autenticación para uno o todos los metodos, usar segun necesidad
* Revisa si la consulta contiene un Header "Authorization" para validar
*/
function authenticate(\Slim\Route $route) {
    // Getting request headers
    $headers = apache_request_headers();
    $response = array();
    $app = \Slim\Slim::getInstance();
     
    // Verifying Authorization Header
    if (isset($headers['authorization'])) {
        //$db = new DbHandler(); //utilizar para manejar autenticacion contra base de datos
         
        // get the api key
        $token = $headers['authorization'];
         
        // validating api key
        if (!($token == API_KEY)) { //API_KEY declarada en Config.php
         
        // api key is not present in users table
        $response["error"] = true;
        $response["message"] = "Acceso denegado. Token inválido";
        echoResponse(401, $response);
         
        $app->stop(); //Detenemos la ejecución del programa al no validar
         
        } else {
            //procede utilizar el recurso o metodo del llamado
        }
    } else {
        // api key is missing in header
        $response["error"] = true;
        $response["message"] = "Falta token de autorización";
        echoResponse(400, $response);
         
        $app->stop();
    }
}

?>