<?php


function addProject($connect, $data){
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
