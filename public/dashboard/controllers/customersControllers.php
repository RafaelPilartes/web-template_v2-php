<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
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

  $image_customer_form = $_FILES['images_member'];
  $images_array_customer_form = [];

  $name_customer_form = $dataForm['name_customer'];
  $email_customer_form = $dataForm['email_customer'];
  $phone_customer_form = $dataForm['phone_customer'];
  $login_password_customer_form = $dataForm['login_password_customer'];
  $login_confirm_password_customer_form = $dataForm['login_confirm_password_customer'];
  $new_password = md5($login_password_customer_form);

  $date_create_customer_form = $completeDate;

  $result_customer = $pdo->prepare("SELECT * FROM customer WHERE email_customer = ? ORDER BY id ");
  $result_customer->execute(array($email_customer_form));
  $num_customer = $result_customer->rowCount();

  if ($num_customer >= 1) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Este email já encontra-se cadastrado </div>"];
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

      foreach ($image_customer_form['name'] as $key => $name) {
        $size_max = 2097152; //2MB
        $accept  = array("jpg", "png", "jpeg");
        $extension  = pathinfo($image_customer_form['name'][$key], PATHINFO_EXTENSION);

        if ($image_customer_form['size'][$key] >= $size_max) {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
        } else {
          if (in_array($extension, $accept)) {
            // echo "Permitido";
            $folder = '../../_imagesDb/customers/';

            if (!is_dir($folder)) {
              mkdir($folder, 755, true);
            }

            // Nome temporário do arquivo
            $tmp = $image_customer_form['tmp_name'][$key];
            // Novo nome do arquivo
            $newName = "img_customers-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

            if (move_uploaded_file($tmp, $folder . $newName)) {
              $image_customers = 'http://localhost:8000/_imagesDb/customers/' . $newName;
              array_push($images_array_customer_form, $image_customers);
              // echo "Upload realizado com sucesso!";
            } else {
              $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
            }
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
          }
        }
      }

      $encode_images_array_customer = json_encode($images_array_customer_form);

      $sql = $pdo->prepare("INSERT INTO adm_user values(null,?,?,?,?,?,?)");

      if ($sql->execute(array(
        $encode_images_array_customer,
        $name_customer_form,
        $email_customer_form,
        $phone_customer_form,
        $new_password,
        $date_create_customer_form
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Cliente cadastrado com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao cadastrar cliente </div>"];
      };
    }

    echo json_encode($return);
  }
}

if ($type_form == 'get_customers') {
  $num_register = $_GET['numRegister'];

  $result_customers = $pdo->prepare("SELECT * FROM customer ORDER BY id DESC LIMIT :limitRegister");
  $result_customers->bindParam(':limitRegister', $num_register, PDO::PARAM_INT);
  $result_customers->execute();
  $num_customers = $result_customers->rowCount();

  if ($num_customers <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum cliente cadastrado no momento </div>";
  } else {
    $return = "";

    while ($row_customer = $result_customers->fetch(PDO::FETCH_ASSOC)) {
      extract($row_customer);

      $decode_image_customer = json_decode($image_customer);

      $url_image = "";

      if ($image_customer !== '') {
        $url_image = $decode_image_customer;
      } else {
        $url_image = "https://www.pngfind.com/pngs/m/470-4703547_icon-user-icon-hd-png-download.png";
      }

      $return .= "
        <tr>
          <td>
            <p>$id</p>
          </td>
          <td>
            <img src='$url_image' />
          </td>
          <td>
            <p>$name_customer</p>
          </td>
          <td>
            <p>$email_customer</p>
          </td>
          <td>
            <p>$phone_customer</p>
          </td>
          <td>$date_create</td>
          <td>
            <button onclick='editeCustomer($id)' class='btn-edit'>
              <i class='fas fa-edit'></i>
            </button>
            <button onclick='deleteCustomer($id)' class='btn-delete'>
              <i class='fas fa-trash-alt'></i>
            </button>
          </td>
        </tr>
      ";
    }

    echo $return;
  }
}

if ($type_form == 'get_all_customer_search') {
  $searchRegister = $_GET['searchRegisterValue'];

  if (empty($searchRegister)) {
    $return = ['error' => true, 'msg' => "O campo de pesquisa está vazio"];
  } else {
    $result_search = $pdo->prepare("SELECT * FROM customer WHERE name_customer LIKE :searchTerm");
    $result_search->bindValue(':searchTerm', '%' . $searchRegister . '%', PDO::PARAM_STR);
    $result_search->execute();
    $num_search = $result_search->rowCount();

    if ($num_search <= 0) {
      $return = ['error' => true, 'msg' => "Erro: Não foi encontrado nenhum registo"];
    } else {

      $dataRegister = "";

      while ($row_customer = $result_search->fetch(PDO::FETCH_ASSOC)) {

        extract($row_customer);

        $decode_image_customer = json_decode($image_customer);

        $url_image = "";

        if ($image_customer !== '[]') {
          $url_image = $decode_image_customer[0];
        } else {
          $url_image = "https://www.pngfind.com/pngs/m/470-4703547_icon-user-icon-hd-png-download.png";
        }

        $dataRegister .= "
          <tr>
            <td>
              <p>$id</p>
            </td>
            <td>
              <img src='$url_image' />
            </td>
            <td>
              <p>$name_customer</p>
            </td>
            <td>
              <p>$email_customer</p>
            </td>
            <td>
              <p>$phone_customer</p>
            </td>
            <td>$date_create</td>
            <td>
              <button onclick='editeCustomer($id)' class='btn-edit'>
                <i class='fas fa-edit'></i>
              </button>
              <button onclick='deleteCustomer($id)' class='btn-delete'>
                <i class='fas fa-trash-alt'></i>
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

if ($type_form == 'delete_customers') {
  $id_customer = $_GET['idCustomer'];

  $result_customer = $pdo->prepare("DELETE FROM customer WHERE id=?");

  if ($result_customer->execute(array($id_customer))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir o cliente"];
  } else {
    $return = ['error' => true, 'msg' =>  "O cliente não foi excluído :)"];
  }
}

if ($type_form == 'get_customer') {
  $id_customer = $_GET['idCustomer'];

  $result_customer = $pdo->prepare("SELECT * FROM customer WHERE id = ? ORDER BY id LIMIT 1");
  $result_customer->execute(array($id_customer));
  $num_customer = $result_customer->rowCount();

  if ($num_customer >= 1) {
    $row_customer = $result_customer->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_customer];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum cliente com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'edite_customer') {
  $id_customer = $dataForm['id_customer'];

  $image_customer_form = $_FILES['images_member'];
  $images_array_customer_form = [];

  $name_customer_form = $dataForm['name_customer'];
  $email_customer_form = $dataForm['email_customer'];
  $phone_customer_form = $dataForm['phone_customer'];
  $login_password_customer_form = $dataForm['login_password_customer'];
  $login_confirm_password_customer_form = $dataForm['login_confirm_password_customer'];
  $new_password = md5($login_password_customer_form);

  $return = "";

  if (empty($name_customer_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
  } elseif (empty($email_customer_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
  } elseif (empty($phone_customer_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo nº de telefone está vazio </div>"];
  } elseif (empty($login_password_customer_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo senha está vazio </div>"];
  } elseif ($login_password_customer_form !=     $login_confirm_password_customer_form) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: As senhas não coincidem </div>"];
  } else {

    foreach ($image_customer_form['name'] as $key => $name) {
      $size_max = 2097152; //2MB
      $accept  = array("jpg", "png", "jpeg");
      $extension  = pathinfo($image_customer_form['name'][$key], PATHINFO_EXTENSION);

      if ($image_customer_form['size'][$key] >= $size_max) {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
      } else {
        if (in_array($extension, $accept)) {
          // echo "Permitido";
          $folder = '../../_imagesDb/customers/';

          if (!is_dir($folder)) {
            mkdir($folder, 755, true);
          }

          // Nome temporário do arquivo
          $tmp = $image_customer_form['tmp_name'][$key];
          // Novo nome do arquivo
          $newName = "img_customers-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

          if (move_uploaded_file($tmp, $folder . $newName)) {
            $image_customers = 'http://localhost:8000/_imagesDb/customers/' . $newName;
            array_push($images_array_customer_form, $image_customers);
            // echo "Upload realizado com sucesso!";
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
          }
        } else {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
        }
      }
    }

    $encode_images_array_customer = json_encode($images_array_customer_form);

    if ($images_array_customer_form == []) {
      $sql = $pdo->prepare("UPDATE customer SET name_customer=?, email_customer=?, phone_customer=?, login_password_customer=? WHERE id=? ");

      if ($sql->execute(array(
        $name_customer_form,
        $email_customer_form,
        $phone_customer_form,
        $new_password,
        $id_customer
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do cliente actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do cliente </div>"];
      };
    } else {
      $sql = $pdo->prepare("UPDATE customer SET image_customer=?, name_customer=?, email_customer=?, phone_customer=?, login_password_customer=? WHERE id=? ");

      if ($sql->execute(array(
        $encode_images_array_customer,
        $name_customer_form,
        $email_customer_form,
        $phone_customer_form,
        $new_password,
        $id_customer
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do cliente actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do cliente </div>"];
      };
    }
  }
  echo json_encode($return);
}
