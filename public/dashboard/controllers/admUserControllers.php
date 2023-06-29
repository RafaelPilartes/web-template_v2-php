<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'create_adm') {
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

  $images_adm_form = $_FILES['images_member'];
  $images_array_adm_form = [];

  $full_name_adm_form = $dataForm['full_name_adm'];
  $email_address_adm_form = $dataForm['email_address_adm'];
  $number_phone_adm_form = $dataForm['number_phone_adm'];
  $permissions_adm_form = $dataForm['permissions_adm'];
  $login_password_adm_form = $dataForm['login_password_adm'];
  $login_confirm_password_adm_form = $dataForm['login_confirm_password_adm'];
  $new_password = md5($login_password_adm_form);

  $date_create_adm_form = $completeDate;

  $result_adm = $pdo->prepare("SELECT * FROM adm_user WHERE email_address_adm = ? ORDER BY id ");
  $result_adm->execute(array($email_address_adm_form));
  $num_adm = $result_adm->rowCount();

  if ($num_adm >= 1) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Este email já encontra-se cadastrado </div>"];
  } else {
    if (empty($full_name_adm_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
    } elseif (empty($email_address_adm_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
    } elseif (empty($number_phone_adm_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo nº de telefone está vazio </div>"];
    } elseif (empty($login_password_adm_form)) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo senha está vazio </div>"];
    } elseif ($login_password_adm_form != $login_confirm_password_adm_form) {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: As senhas não coincidem </div>"];
    } else {

      foreach ($images_adm_form['name'] as $key => $name) {
        $size_max = 2097152; //2MB
        $accept  = array("jpg", "png", "jpeg");
        $extension  = pathinfo($images_adm_form['name'][$key], PATHINFO_EXTENSION);

        if ($images_adm_form['size'][$key] >= $size_max) {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
        } else {
          if (in_array($extension, $accept)) {
            // echo "Permitido";
            $folder = '../../_imagesDb/members/';

            if (!is_dir($folder)) {
              mkdir($folder, 755, true);
            }

            // Nome temporário do arquivo
            $tmp = $images_adm_form['tmp_name'][$key];
            // Novo nome do arquivo
            $newName = "img_members-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

            if (move_uploaded_file($tmp, $folder . $newName)) {
              $image_members = 'http://localhost:8000/_imagesDb/members/' . $newName;
              array_push($images_array_adm_form, $image_members);
              // echo "Upload realizado com sucesso!";
            } else {
              $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
            }
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
          }
        }
      }

      $encode_images_array_adm = json_encode($images_array_adm_form);

      $sql = $pdo->prepare("INSERT INTO adm_user values(null,?,?,?,?,?,?,?)");

      if ($sql->execute(array(
        $encode_images_array_adm,
        $full_name_adm_form,
        $email_address_adm_form,
        $number_phone_adm_form,
        $permissions_adm_form,
        $new_password,
        $date_create_adm_form
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> adm cadastrado com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao cadastrar usuário </div>"];
      };
    }

    echo json_encode($return);
  }
}

if ($type_form == 'get_adms') {
  $num_register = $_GET['numRegister'];

  $result_adms = $pdo->prepare("SELECT * FROM adm_user ORDER BY id DESC LIMIT :limitRegister");
  $result_adms->bindParam(':limitRegister', $num_register, PDO::PARAM_INT);
  $result_adms->execute();
  $num_adms = $result_adms->rowCount();

  if ($num_adms <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum adm cadastrado no momento </div>";
  } else {
    $return = "";

    while ($row_adm = $result_adms->fetch(PDO::FETCH_ASSOC)) {
      extract($row_adm);

      $namePermission = '';

      if ($permissions_adm == 'read') {
        $namePermission = 'Apenas leitura';
      } elseif ($permissions_adm == 'write') {
        $namePermission = 'Apenas cadastrar';
      } elseif ($permissions_adm == 'all_permissions') {
        $namePermission = 'Todas as permissões';
      }

      $decode_image_adm = json_decode($image_adm);

      $url_image = "";

      if ($image_adm !== '[]') {
        $url_image = $decode_image_adm[0];
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
            <p>$full_name_adm</p>
          </td>
          <td>
            <p>$email_address_adm</p>
          </td>
          <td>
            <p>$number_phone_adm</p>
          </td>
          <td>
            <p>$namePermission</p>
          </td>
          <td>$date_create_adm</td>
          <td>
            <button onclick='editeAdm($id)' class='btn-edit'>
              <i class='fas fa-edit'></i>
            </button>
            <button onclick='deleteAdm($id)' class='btn-delete'>
              <i class='fas fa-trash-alt'></i>
            </button>
          </td>
        </tr>
      ";
    }

    echo $return;
  }
}

if ($type_form == 'get_all_adm_search') {
  $searchRegister = $_GET['searchRegisterValue'];

  if (empty($searchRegister)) {
    $return = ['error' => true, 'msg' => "O campo de pesquisa está vazio"];
  } else {
    $result_search = $pdo->prepare("SELECT * FROM adm_user WHERE full_name_adm LIKE :searchTerm");
    $result_search->bindValue(':searchTerm', '%' . $searchRegister . '%', PDO::PARAM_STR);
    $result_search->execute();
    $num_search = $result_search->rowCount();

    if ($num_search <= 0) {
      $return = ['error' => true, 'msg' => "Erro: Não foi encontrado nenhum registo"];
    } else {

      $dataRegister = "";

      while ($row_adm = $result_search->fetch(PDO::FETCH_ASSOC)) {

        extract($row_adm);

        $namePermission = '';

        if ($permissions_adm == 'read') {
          $namePermission = 'Apenas leitura';
        } elseif ($permissions_adm == 'write') {
          $namePermission = 'Apenas cadastrar';
        } elseif ($permissions_adm == 'all_permissions') {
          $namePermission = 'Todas as permissões';
        }

        $decode_image_adm = json_decode($image_adm);

        $url_image = "";

        if ($image_adm !== '[]') {
          $url_image = $decode_image_adm[0];
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
              <p>$full_name_adm</p>
            </td>
            <td>
              <p>$email_address_adm</p>
            </td>
            <td>
              <p>$number_phone_adm</p>
            </td>
            <td>
              <p>$namePermission</p>
            </td>
            <td>$date_create_adm</td>
            <td>
              <button onclick='editeAdm($id)' class='btn-edit'>
                <i class='fas fa-edit'></i>
              </button>
              <button onclick='deleteAdm($id)' class='btn-delete'>
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

if ($type_form == 'delete_adms') {
  $id_adm = $_GET['idAdm'];

  $result_adm = $pdo->prepare("DELETE FROM adm_user WHERE id=?");

  if ($result_adm->execute(array($id_adm))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir o adm"];
  } else {
    $return = ['error' => true, 'msg' =>  "O adm não foi excluído :)"];
  }
}

if ($type_form == 'get_adm') {
  $id_adm = $_GET['idAdm'];

  $result_adm = $pdo->prepare("SELECT * FROM adm_user WHERE id = ? ORDER BY id LIMIT 1");
  $result_adm->execute(array($id_adm));
  $num_adm = $result_adm->rowCount();

  if ($num_adm >= 1) {
    $row_adm = $result_adm->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_adm];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum adm com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'edite_adm') {
  $id_adm = $dataForm['id_adm'];

  $images_adm_form = $_FILES['images_member'];
  $images_array_adm_form = [];

  $full_name_adm_form = $dataForm['full_name_adm'];
  $email_address_adm_form = $dataForm['email_address_adm'];
  $number_phone_adm_form = $dataForm['number_phone_adm'];
  $permissions_adm_form = $dataForm['permissions_adm'];
  $login_password_adm_form = $dataForm['login_password_adm'];
  $login_confirm_password_adm_form = $dataForm['login_confirm_password_adm'];
  $new_password = md5($login_password_adm_form);

  $return = "";

  if (empty($full_name_adm_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo nome está vazio </div>"];
  } elseif (empty($email_address_adm_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo email está vazio </div>"];
  } elseif (empty($permissions_adm_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo permissões está vazio </div>"];
  } elseif (empty($number_phone_adm_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo nº de telefone está vazio </div>"];
  } elseif (empty($login_password_adm_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo senha está vazio </div>"];
  } elseif ($login_password_adm_form !=     $login_confirm_password_adm_form) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: As senhas não coincidem </div>"];
  } else {

    foreach ($images_adm_form['name'] as $key => $name) {
      $size_max = 2097152; //2MB
      $accept  = array("jpg", "png", "jpeg");
      $extension  = pathinfo($images_adm_form['name'][$key], PATHINFO_EXTENSION);

      if ($images_adm_form['size'][$key] >= $size_max) {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A imagem excedeu o tamanho máximo de 2MB! </div>"];
      } else {
        if (in_array($extension, $accept)) {
          // echo "Permitido";
          $folder = '../../_imagesDb/members/';

          if (!is_dir($folder)) {
            mkdir($folder, 755, true);
          }

          // Nome temporário do arquivo
          $tmp = $images_adm_form['tmp_name'][$key];
          // Novo nome do arquivo
          $newName = "img_members-" . date('d-m-Y') . '-' . date('H') . 'h-' . uniqid() . ".$extension";

          if (move_uploaded_file($tmp, $folder . $newName)) {
            $image_members = 'http://localhost:8000/_imagesDb/members/' . $newName;
            array_push($images_array_adm_form, $image_members);
            // echo "Upload realizado com sucesso!";
          } else {
            $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: ao realizar Upload... </div>"];
          }
        } else {
          $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: Extensão ($extension) não permitido! </div>"];
        }
      }
    }

    $encode_images_array_adm = json_encode($images_array_adm_form);

    if ($images_array_adm_form == []) {
      $sql = $pdo->prepare("UPDATE adm_user SET full_name_adm=?, email_address_adm=?, permissions_adm=?, number_phone_adm=?, login_password_adm=? WHERE id=? ");

      if ($sql->execute(array(
        $full_name_adm_form,
        $email_address_adm_form,
        $permissions_adm_form,
        $number_phone_adm_form,
        $new_password,
        $id_adm
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do adm actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do adm </div>"];
      };
    } else {
      $sql = $pdo->prepare("UPDATE adm_user SET image_adm=?, full_name_adm=?, email_address_adm=?, permissions_adm=?, number_phone_adm=?, login_password_adm=? WHERE id=? ");

      if ($sql->execute(array(
        $encode_images_array_adm,
        $full_name_adm_form,
        $email_address_adm_form,
        $permissions_adm_form,
        $number_phone_adm_form,
        $new_password,
        $id_adm
      ))) {
        $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do adm actualizados com sucesso </div>"];
      } else {
        $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do adm </div>"];
      };
    }
  }
  echo json_encode($return);
}