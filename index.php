<?php

//die(print_r($_POST));

header('Content-type: json/application');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header("Access-Control-Max-Age", "3600");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Access-Control-Allow-Credentials", "true");

include 'connect.php';
include 'functions.php';
//include 'sendform.php'

$method = $_SERVER['REQUEST_METHOD'];
if($method == 'GET'){
  $q = $_GET['q'];
  $params = explode('/', $q);

}elseif ($method == 'POST') {

  $data = file_get_contents('php://input');
  $data = json_decode($data, true);
  $type = $data['type'];


  if ($type == 'sendform') {
    sendForm($data);
  }
  die();
}



$type = $params[0];









if (isset($params[1])) {
  $id = $params[1];
}
//$id = $params[1];

if ($method === 'GET') {
  if ($type === 'projects') {

    if (isset($id)) {
      getProject($connect, $id);
    }else{
      getProjects($connect);
    }

  }
}elseif ($method === 'POST') {
  if ($type === 'projects') {
    var_dump($_POST);
    addProject($connect, $_POST);
  }
}elseif ($method === 'PATCH') {
    if ($type === 'projects') {
      if (isset($id)) {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
        updateProject($connect, $data, $id);
      }
    }
}elseif ($method === 'DELETE') {
  if ($type === 'projects') {
    if(isset($id)){
      deleteProject($connect, $id);
    }
  }
}elseif ($method == 'POST') {
  if ($type === 'sendform') {
    sendForm($_POST);
  }
}
