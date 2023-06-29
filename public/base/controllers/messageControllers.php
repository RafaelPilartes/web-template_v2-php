<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_delete = filter_input(INPUT_GET, 'type', FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'send_message') {
  $data = date('D');
  $mes = date('M');
  $dia = date('d');
  $ano = date('Y');

  $semana = array(
    'Sun' => 'Domingo',
    'Mon' => 'Segunda-Feira',
    'Tue' => 'Terca-Feira',
    'Wed' => 'Quarta-Feira',
    'Thu' => 'Quinta-Feira',
    'Fri' => 'Sexta-Feira',
    'Sat' => 'Sábado'
  );

  $mes_extenso = array(
    'Jan' => 'Janeiro',
    'Feb' => 'Fevereiro',
    'Mar' => 'Marco',
    'Apr' => 'Abril',
    'May' => 'Maio',
    'Jun' => 'Junho',
    'Jul' => 'Julho',
    'Aug' => 'Agosto',
    'Nov' => 'Novembro',
    'Sep' => 'Setembro',
    'Oct' => 'Outubro',
    'Dec' => 'Dezembro'
  );

  $completeDate =  $semana["$data"] . ", {$dia} de " . $mes_extenso["$mes"] . " de {$ano}";

  $name_user_form = $dataForm['name_user'];
  $email_user_form = $dataForm['email_user'];
  $phone_user_form = $dataForm['phone_user'];
  $summary_form = $dataForm['summary'];
  $message_form = $dataForm['message'];

  $date_create = $completeDate;


  if (empty($name_user_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Name field is empty </div>"];
  } elseif (empty($email_user_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Email field is empty </div>"];
  } elseif (empty($phone_user_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Phone number field is empty </div>"];
  } elseif (empty($summary_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: The summary field is empty </div>"];
  } elseif (empty($message_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Message field is empty</div>"];
  } else {

    $sql = $pdo->prepare("INSERT INTO messages values(null,?,?,?,?,?,?)");

    $params = [
      $name_user_form,
      $email_user_form,
      $phone_user_form,
      $summary_form,
      $message_form,
      $date_create
    ];

    if ($sql->execute($params)) {
      $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Message sent successfully </div>"];
    } else {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao enviar a mensagem </div>"];
    };
  }

  echo json_encode($return);
}
