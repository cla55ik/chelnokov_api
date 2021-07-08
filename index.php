<?php

//die(print_r($_POST));

header('Content-type: json/application');
header('Access-Control-Allow-Origin: *');

require 'connect.php';
require 'functions.php';

$method = $_SERVER['REQUEST_METHOD'];

$q = $_GET['q'];
$params = explode('/', $q);

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
}
