<?php


function getProjects($connect){
  $projects = mysqli_query($connect, "SELECT * FROM `projects`");
  $projectsList = [];


  while($project = mysqli_fetch_assoc($projects)){
    $projectsList[] = $project;
  }
  echo json_encode($projectsList);
}


function getProject($connect, $id){
  $project = mysqli_query($connect, "SELECT * FROM `projects` WHERE `id` = '$id'");

  if (mysqli_num_rows($project) === 0) {
    http_response_code(404);
    $res = [
      "status" => false,
      "message" => 'No found'
    ];

    echo json_encode($res);
  }else{
    $project = mysqli_fetch_assoc($project);

    echo json_encode($project);
  }


}


function addProject($connect, $data){
  $title = $data['title'];
  $description = $data['description'];
  //$img = $data['img'];
  //$stack = $data['stack'];
  //$url_site = $data['url_site'];
  //$url_git = $data['url_git'];



  mysqli_query($connect, "INSERT INTO `projects`(`title`, `description`, `img`, `stack`, `url_site`, `url_git`) VALUES ('$title','$description','$img','$stack','$url_site','$url_git')");

  http_response_code(201);

  $res=[
    "status"=>true,
    "project_id" => mysqli_insert_id($connect)
  ];

  echo json_encode($res);

}



function updateProject($connect, $data, $id){
  $title = $data['title'];
  $description = $data['description'];
  $img = $data['img'];
  $stack = $data['stack'];
  $url_site = $data['url_site'];
  $url_git = $data['url_git'];

  mysqli_query($connect, "UPDATE `projects` SET `title`='$title',`description`='$description',`img`='$img',`stack`='$stack',`url_site`='$url_site',`url_git`='$url_git' WHERE `projects`.`id` = '$id'");

  http_response_code(200);

  $res = [
    "status" => true,
    "message" => "Updated"
  ];
  echo json_encode($res);
}


function deleteProject($connect, $id){
  mysqli_query($connect, "DELETE FROM `projects` WHERE `projects`.`id` = '$id'");

  http_response_code(200);

  $res = [
    "status" => true,
    "message" => 'Proj is delete'
  ];

  echo json_encode($res);
}



function sendForm($data){
  http_response_code(200);

  $name = $data['name'];
  $phone = $data['phone'];
  $sitetype = $data['sitetype'];
  $description = $data['description'];

  if($phone != ''){

    $message = "Имя: ".$name."<br />".
                "Телефон: ".$phone."<br />".
                "Тип сайта: ".$sitetype."<br />".
                "Подробности: ".$description."<br />";

    sendToMail($message);
    $res = [
      "status" => 'ok',
      "message" => 'Ваша заявка отправлена',
    ];

  }elseif ($phone == '') {
    $res = [
      "status" => 'error',
      "message" => 'Укажите номер телефона',
    ];
  }


  echo json_encode($res);
}


function sendToMail($message){
  $to = "ivan5420@yandex.ru"; // емайл получателя данных из формы
  $tema = "Заявка с сайта Chelnokov"; // тема полученного емайла

  // заголовок письма
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
        $headers .= "From: Тестовое письмо <no-reply@test.com>\r\n"; // от кого письмо

  mail($to, $tema, $message, $headers); //отправляет получателю на емайл значения переменных



}
