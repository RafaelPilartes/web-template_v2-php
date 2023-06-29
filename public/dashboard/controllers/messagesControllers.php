<?php
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_message') {
  $num_register = $_GET['numRegister'];

  $result_message = $pdo->prepare("SELECT * FROM messages ORDER BY id DESC LIMIT :limitRegister");
  $result_message->bindParam(':limitRegister', $num_register, PDO::PARAM_INT);
  $result_message->execute();
  $num_message = $result_message->rowCount();

  if ($num_message <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhuma mensagem </div>";
  } else {
    $return = "";

    while ($row_message = $result_message->fetch(PDO::FETCH_ASSOC)) {

      extract($row_message);

      $return .= "
        <tr>
          <td>
            <p>$id</p>
          </td>
          <td>
            <p>$name_user</p>
          </td>
          <td>
            <p>$email_user</p>
          </td>
          <td>
            <p>$summary</p>
          </td>
          <td>
            <p>$date_create</p>
          </td>
          <td class='row'>
            <button onclick='deleteMessage($id)' class='btn-delete'>
              <i class='fas fa-trash-alt'></i>
            </button>
            <button onclick='seeMessage($id)' class='btn-see'>
              <i class='fas fa-eye'></i>
            </button>
          </td>
        </tr>
      ";
    }

    echo $return;
  }
}
if ($type_form == 'get_all_message_search') {
  $searchRegister = $_GET['searchRegisterValue'];

  if (empty($searchRegister)) {
    $return = ['error' => true, 'msg' => "O campo de pesquisa está vazio"];
  } else {
    $result_search = $pdo->prepare("SELECT * FROM messages WHERE name_message LIKE :searchTerm");
    $result_search->bindValue(':searchTerm', '%' . $searchRegister . '%', PDO::PARAM_STR);
    $result_search->execute();
    $num_search = $result_search->rowCount();

    if ($num_search <= 0) {
      $return = ['error' => true, 'msg' => "Erro: Não foi encontrado nenhuma registo"];
    } else {

      $dataRegister = "";

      while ($row_message = $result_search->fetch(PDO::FETCH_ASSOC)) {

        extract($row_message);

        $dataRegister .= "
          <tr>
            <td>
              <p>$id</p>
            </td>
            <td>
              <p>$name_user</p>
            </td>
            <td>
              <p>$email_user</p>
            </td>
            <td>
              <p>$summary</p>
            </td>
            <td>
              <p>$date_create</p>
            </td>
            <td class='row'>
              <button onclick='deleteMessage($id)' class='btn-delete'>
                <i class='fas fa-trash-alt'></i>
              </button>
              <button onclick='seeMessage($id)' class='btn-see'>
                <i class='fas fa-eye'></i>
              </button>
            </td>
          </tr>
        ";
      }

      $return = ['error' => false, 'msg' => $dataRegister];
    }
  }

  echo json_encode($return);
}

if ($type_form == 'get_message') {
  $id_message = $_GET['idMessage'];

  $result_message = $pdo->prepare("SELECT * FROM messages WHERE id = ? ORDER BY id LIMIT 1");
  $result_message->execute(array($id_message));
  $num_message = $result_message->rowCount();

  if ($num_message >= 1) {
    $row_message = $result_message->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_message];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhuma mensagem com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'delete_message') {
  $id_message = $_GET['idMessage'];

  $result_message = $pdo->prepare("DELETE FROM messages WHERE id=?");

  if ($result_message->execute(array($id_message))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir o mensagem"];
  } else {
    $return = ['error' => true, 'msg' =>  "A mensagem não foi excluído :)"];
  }
}
