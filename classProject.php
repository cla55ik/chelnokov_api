<?php


class Project{

public function getAll($connect){
  $projects = mysqli_query($connect, "SELECT * FROM `projects` WHERE img != ''");
  $projectsList = [];


  while($project = mysqli_fetch_assoc($projects)){
    $projectsList[] = $project;
  }
  echo json_encode($projectsList);
}

public function getAdminAll($connect){

    $projects = mysqli_query($connect, "SELECT * FROM `projects`");
    $projectsList = [];


    while($project = mysqli_fetch_assoc($projects)){
      $projectsList[] = $project;
    }
    echo json_encode($projectsList);

}

public function getOne($connect, $id){

}

public function postOne($connect, $data){
  $title = $data['title'];
  $description = $data['description'];
  $img = $data['img'];
  $stack = $data['stack'];
  $url_site = $data['url_site'];
  $url_git = $data['url_git'];
  $status = $data['status'];



  mysqli_query($connect, "INSERT INTO `projects`(`title`, `description`, `img`, `stack`, `url_site`, `url_git`, `status`) VALUES ('$title','$description','$img','$stack','$url_site','$url_git', '$status')");

  http_response_code(201);

  $res=[
    "status"=>true,
    "project_id" => mysqli_insert_id($connect)
  ];

/*
$res = [
  "message"=>'ok',
];

*/
  echo json_encode($res);
}


public function deleteOne($connect, $id){
  mysqli_query($connect, "DELETE FROM `projects` WHERE `id` = '$id'");

  http_response_code(200);

  $res = [
    "status" => true,
    "message" => 'Proj is delete' . $id,
    "id" => $id
  ];

  echo json_encode($res);
}

public function punchOne($connect, $id){

}


public function getId($params){

}

}
