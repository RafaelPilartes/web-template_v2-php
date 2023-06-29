<?php
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_category') {
  $num_register = $_GET['numRegister'];

  $result_category = $pdo->prepare("SELECT * FROM category ORDER BY id DESC LIMIT :limitRegister");
  $result_category->bindParam(':limitRegister', $num_register, PDO::PARAM_INT);
  $result_category->execute();
  $num_category = $result_category->rowCount();

  if ($num_category <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhuma categoria cadastrada </div>";
  } else {
    $return = "";

    while ($row_category = $result_category->fetch(PDO::FETCH_ASSOC)) {

      extract($row_category);

      $return .= "
        <tr>
          <td>
            <p>$id</p>
          </td>
          <td>
            <p>$name_category</p>
          </td>
          <td>
            <p>$visibility_category</p>
          </td>
          <td>
            <p>$date_create</p>
          </td>
          <td>
            <button onclick='deleteCategory($id)' class='btn-delete'>
              <i class='fas fa-trash-alt'></i>
            </button>
            <button onclick='editeCategory($id)' class='btn-edit'>
              <i class='fas fa-edit'></i>
            </button>
          </td>
        </tr>
      ";
    }

    echo $return;
  }
}
if ($type_form == 'get_all_category_search') {
  $searchRegister = $_GET['searchRegisterValue'];

  if (empty($searchRegister)) {
    $return = ['error' => true, 'msg' => "O campo de pesquisa está vazio"];
  } else {
    $result_search = $pdo->prepare("SELECT * FROM category WHERE name_category LIKE :searchTerm");
    $result_search->bindValue(':searchTerm', '%' . $searchRegister . '%', PDO::PARAM_STR);
    $result_search->execute();
    $num_search = $result_search->rowCount();

    if ($num_search <= 0) {
      $return = ['error' => true, 'msg' => "Erro: Não foi encontrado nenhum registo"];
    } else {

      $dataRegister = "";

      while ($row_category = $result_search->fetch(PDO::FETCH_ASSOC)) {

        extract($row_category);

        $dataRegister .= "
          <tr>
            <td>
              <p>$id</p>
            </td>
            <td>
              <p>$name_category</p>
            </td>
            <td>
              <p>$visibility_category</p>
            </td>
            <td>
              <p>$date_create</p>
            </td>
            <td>
              <button onclick='deleteCategory($id)' class='btn-delete'>
                <i class='fas fa-trash-alt'></i>
              </button>
              <button onclick='editeCategory($id)' class='btn-edit'>
                <i class='fas fa-edit'></i>
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

if ($type_form == 'create_category') {
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

  $name_category_form = $dataForm['name_category'];
  $visibility_category_form = $dataForm['visibility_category'];
  $date_create_form = $completeDate;

  $result_category = $pdo->prepare("SELECT * FROM category WHERE name_category = ? ORDER BY id ");
  $result_category->execute(array($name_category_form));
  $num_category = $result_category->rowCount();

  if ($num_category >= 1) {
    $return = ['error' => false, 'msg' =>  "<div class='alert alert-danger' role='alert' id='msgAlerta'> Está categoria já encontra-se cadastrada </div>"];
  } else {
    if (empty($name_category_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo nome da categoria está vazio </div>"];
    } elseif (empty($visibility_category_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo visibilidade da categoria  está vazio </div>"];
    } else {

      $sql = $pdo->prepare("INSERT INTO category values(null,?,?,?)");

      if ($sql->execute(array(
        $name_category_form,
        $visibility_category_form,
        $date_create_form
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Categoria cadastrada com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao cadastrar categoria </div>"];
      };
    }

    echo json_encode($return);
  }
}

if ($type_form == 'get_category') {
  $id_category = $_GET['idCategory'];

  $result_category = $pdo->prepare("SELECT * FROM category WHERE id = ? ORDER BY id LIMIT 1");
  $result_category->execute(array($id_category));
  $num_category = $result_category->rowCount();

  if ($num_category >= 1) {
    $row_category = $result_category->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_category];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhuma categoria com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'delete_category') {
  $id_category = $_GET['idCategory'];

  $result_category = $pdo->prepare("DELETE FROM category WHERE id=?");

  if ($result_category->execute(array($id_category))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir o categoria"];
  } else {
    $return = ['error' => true, 'msg' =>  "A categoria não foi excluído :)"];
  }
}

if ($type_form == 'edite_category') {
  $id_category = $dataForm['idCategory'];

  $name_category_form = $dataForm['name_category'];
  $visibility_category_form = $dataForm['visibility_category'];

  $return = "";

  if (empty($name_category_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome do categoria está vazio </div>"];
  } elseif (empty($visibility_category_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo visibilidade está vazio </div>"];
  } else {
    $sql = $pdo->prepare("UPDATE category SET name_category=?, visibility_category=? WHERE id=? ");

    if ($sql->execute(array(
      $name_category_form,
      $visibility_category_form,
      $id_category
    ))) {
      $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados da categoria actualizados com sucesso </div>"];
    } else {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados da categoria </div>"];
    };
  }
  echo json_encode($return);
}
