<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['type_form'];

if ($type_form == 'login_adm') {

  if (!empty($dataForm['email_address_adm']) && !empty($dataForm['login_password_adm'])) {

    $email_address_adm_form = $dataForm['email_address_adm'];
    $login_password_adm_form = $dataForm['login_password_adm'];
    $new_password = md5($login_password_adm_form);

    $result_adm = $pdo->prepare("SELECT * FROM adm_user WHERE email_address_adm=? and login_password_adm=? LIMIT 1 ");
    $result_adm->execute(array($email_address_adm_form, $new_password));

    if ($result_adm->rowCount() < 1) {
      unset($_SESSION['adm_deal_days_name']);
      unset($_SESSION['adm_deal_days_email']);
      unset($_SESSION['adm_deal_days_permissions']);
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Dados do adm incorreto </div>"];
    } else {

      $adm_name = "";
      $permissions_adm = "";

      foreach ($result_adm as $data) {
        $adm_name = $data['full_name_adm'];
        $permissions_adm = $data['permissions_adm'];
      };

      $_SESSION['adm_deal_days_name'] = $adm_name;
      $_SESSION['adm_deal_days_email'] = $email_address_adm_form;
      $_SESSION['adm_deal_days_permissions'] = $permissions_adm;

      $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'>ADM '$adm_name' logado</div>", 'adm_email' => $email_address_adm_form, 'adm_name' => $adm_name];
    }
  } else {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Preencha todos os dados! </div>"];
  }

  echo json_encode($return);
}

if ($type_form == 'logout_adm') {
  unset($_SESSION['adm_deal_days_name']);
  unset($_SESSION['adm_deal_days_email']);
  unset($_SESSION['adm_deal_days_permissions']);

  echo $return = 'Adm desconectado com sucesso';
}
