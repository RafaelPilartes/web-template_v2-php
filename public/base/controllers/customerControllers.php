<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_delete = filter_input(INPUT_GET, 'type', FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'create_customer') {
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

  $name_customer_form = $dataForm['name_customer'];
  $email_customer_form = $dataForm['email_customer'];
  $phone_customer_form = $dataForm['email_customer'];
  $login_password_customer_form = $dataForm['login_password_customer'];
  $login_confirm_password_customer_form = $dataForm['login_confirm_password_customer'];
  $new_password = md5($login_password_customer_form);

  $date_create = $completeDate;

  $result_customer = $pdo->prepare("SELECT * FROM customer WHERE email_customer = ? ORDER BY id ");
  $result_customer->execute(array($email_customer_form));
  $num_customer = $result_customer->rowCount();

  if ($num_customer >= 1) {
    $return = ['error' => false, 'msg' =>  "<div class='alert alert-danger' role='alert' id='msgAlerta'> Este email já encontra-se cadastrado </div>"];
  } else {
    if (empty($name_customer_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
    } elseif (empty($email_customer_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
    } elseif (empty($phone_customer_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo nº de telefone está vazio </div>"];
    } elseif (empty($login_password_customer_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo senha está vazio </div>"];
    } elseif ($login_password_customer_form != $login_confirm_password_customer_form) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: As senhas não coincidem </div>"];
    } else {

      $encode_images_array_adm = "";

      $sql = $pdo->prepare("INSERT INTO customer values(null,?,?,?,?,?,?)");

      if ($sql->execute(array(
        $encode_images_array_adm,
        $name_customer_form,
        $email_customer_form,
        $phone_customer_form,
        $new_password,
        $date_create
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Usuário cadastrado com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao cadastrar usuário </div>"];
      };
    }
  }
}


if ($type_form == 'login_customer') {

  if (!empty($dataForm['email_customer']) && !empty($dataForm['login_password_customer'])) {

    $email_customer_form = $dataForm['email_customer'];
    $login_password_customer_form = $dataForm['login_password_customer'];
    $new_password = md5($login_password_customer_form);

    $result_customer = $pdo->prepare("SELECT * FROM customer WHERE email_customer=? and login_password_customer=? LIMIT = 1");
    $result_customer->execute(array($email_customer_form, $new_password));

    if ($result_customer->rowCount() < 1) {
      unset($_SESSION['customer_name']);
      unset($_SESSION['customer_email']);
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Dados do customer incorreto </div>"];
    } else {

      $customer_name = "";

      foreach ($result_customer as $data) {
        $customer_name = $data['name_customer'];
      };

      $_SESSION['customer_name'] = $customer_name;
      $_SESSION['customer_email'] = $email_customer_form;

      $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'>customer '$customer_name' logado</div>", 'email_customer' => $email_customer_form];
    }
  } else {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Preencha todos os dados! </div>"];
  }
}

if ($type_form == 'logout_customer') {
  unset($_SESSION['customer_name']);
  unset($_SESSION['customer_email']);
}

echo json_encode($return);
