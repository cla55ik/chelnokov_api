<?php


class PostAPI{
  $data = file_get_contents('php://input');
  $data = json_decode($data, true);
  $type = $data['type'];



public function sendForm($data){
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


public function sendToMail($message){
  $to = "ivan5420@yandex.ru"; // емайл получателя данных из формы
  $tema = "Заявка с сайта Chelnokov"; // тема полученного емайла

  // заголовок письма
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
        $headers .= "From: Тестовое письмо <no-reply@test.com>\r\n"; // от кого письмо

  mail($to, $tema, $message, $headers); //отправляет получателю на емайл значения переменных



}


}
