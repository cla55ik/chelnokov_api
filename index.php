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
include 'classProject.php';

//include($_SERVER['DOCUMENT_ROOT'] . '/objects/post.php');



$method = $_SERVER['REQUEST_METHOD'];

$uri = $_SERVER['REQUEST_URI'];
$data = file_get_contents('php://input');
$params = explode('/', $uri);

$type = $params[1];

if ($type == 'sendform') {

  $data = file_get_contents('php://input');
  $data = json_decode($data, true);


  include 'sendform.php';
  sendForm($data);
  }

if ($type == 'projects') {
  $project = new Project;

switch ($method) {
  case 'GET':
    $project->getAll($connect);
    break;
  case 'POST':
    $data = file_get_contents('php://input');
    $data = json_decode($data, true);

    $project->postOne($connect, $data);
    break;
  case 'DELETE':
    $id = $params[2];
    $project->deleteOne($connect, $id);
    break;
  default:
    echo json_encode('unknown Request');
    break;
}

}elseif ($type == 'admin' ) {
  if($params[2] == 'projects'){
    switch ($method) {
      case 'GET':
        $project = new Project;
        $project->getAdminAll($connect);
        break;

      default:
        echo json_encode('unknown Request');
        break;
    }


  }
}






//echo json_encode($params);


/*

if($method == 'GET'){
  $q = $_GET['q'];
  $params = explode('/', $q);
  $type = $params[0];

  if ($type == 'projects') {
    getProjects($connect);
  }elseif ($type == 'admin') {
    getProjectAdmin($connect);
  }

}elseif ($method == 'POST') {

  include 'postAPI.php';

  $data = file_get_contents('php://input');
  $data = json_decode($data, true);
  $type = $data['type'];



  if ($type == 'sendform') {
    include 'sendform.php';
    sendForm($data);
  }elseif ($type == 'project') {
    addProject($connect, $data);
  }

}elseif ($method == 'DELETE') {
  $uri = $_SERVER['REQUEST_URI'];
  $params = explode('/', $uri);
  $type = $params[1];
  $id = $params[2];
  if ($type == 'projects' && isset($id)) {
    deleteProject($connect, $id);
  }

}

*/


/*
elseif ($method == 'DELETE') {
  $params = split("/", substr(@$_SERVER['PATH_INFO'], 1));
//  $params = explode('/', $q);
  $type = $params[0];
  $id = $params[1];

  if ($type == 'projects') {
    if (!isset($id)) {
      $res = 'ID не получен';

      echo json_encode($res);
      die();
    }else{
      deleteProject($connect, $id)
    }
  }


}
*/









/*

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
*/
