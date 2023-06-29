<?php
include_once "../../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];


if ($type_form == 'create_member') {
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

  $name_member_form = $dataForm['name_member'];
  $type_member_form = $dataForm['type_member'];
  $num_members_form = $dataForm['numMembers'];
  $status_payment_member_form = "Pendente";
  $value_payment_member_form = 50000;
  $date_create_form = $completeDate;

  $result_member = $pdo->prepare("SELECT * FROM members WHERE name_member = ? ORDER BY id ");
  $result_member->execute(array($name_member_form));
  $num_member = $result_member->rowCount();

  if ($num_member >= 1) {
    $return = ['error' => true, 'msg' => "Está Equipe já encontra-se cadastrada"];
  } else {
    if (empty($name_member_form)) {
      $return = ['error' => true, 'msg' => "Erro: O campo nome da equipa está vazio"];
    } elseif (empty($type_member_form)) {
      $return = ['error' => true, 'msg' => "Erro: O campo tipo de equipa  está vazio"];
    } elseif (empty($value_payment_member_form)) {
      $return = ['error' => true, 'msg' => "Erro: O campo valor de pagamento está vazio"];
    } else {

      $sql = $pdo->prepare("INSERT INTO member values(null,?,?,?,?,?,?)");

      if ($sql->execute(array(
        $name_member_form,
        $type_member_form,
        $num_members_form,
        $value_payment_member_form,
        $status_payment_member_form,
        $date_create_form,
      ))) {

        $memberId = $pdo->lastInsertId();

        // Insere os dados dos integrantes
        for ($i = 1; $i <= $num_members_form; $i++) {
          $name_member_form = $_POST["name_member_" . $i];
          $identity_card_member_form = $_POST["identity_card_member_" . $i];
          $nif_member_form = $_POST["nif_member_" . $i];
          $age_member_form = $_POST["age_member_" . $i];
          $telephone_member_form = $_POST["telephone_member_" . $i];
          $household_member_form = $_POST["household_member_" . $i];
          $email_member_form = $_POST["email_member_" . $i];
          $province_member_form = $_POST["province_member_" . $i];
          $county_member_form = $_POST["county_member_" . $i];
          $member_member_form = '';
          $school_member_form = '';
          $course_member_form = '';
          $year_attend_member_form = '';
          $year_attend_member_form = '';
          $company_member_form = '';
          $function_member_form = '';
          $skills_member_form = '';

          $sqlIntegrante = "INSERT INTO members (
            member_id,
            name_member,
            identity_card_member,
            nif_member,
            age_member,
            telephone_member,
            household_member,
            email_member,
            province_member,
            county_member,
            member_member,
            school_member,
            course_member,
            year_attend_member,
            company_member,
            function_member,
            skills_member,
            date_create
          ) VALUES (
            :member_id,
            :name_member,
            :identity_card_member,
            :nif_member,
            :age_member,
            :telephone_member,
            :household_member,
            :email_member,
            :province_member,
            :county_member,
            :member_member,
            :school_member,
            :course_member,
            :year_attend_member,
            :company_member,
            :function_member,
            :skills_member,
            :date_create
          )";

          $result_member = $pdo->prepare($sqlIntegrante);
          $result_member->bindParam(':member_id', $memberId);
          $result_member->bindParam(':name_member', $name_member_form);
          $result_member->bindParam(':identity_card_member', $identity_card_member_form);
          $result_member->bindParam(':nif_member', $nif_member_form);
          $result_member->bindParam(':age_member', $age_member_form);
          $result_member->bindParam(':telephone_member', $telephone_member_form);
          $result_member->bindParam(':household_member', $household_member_form);
          $result_member->bindParam(':email_member', $email_member_form);
          $result_member->bindParam(':province_member', $province_member_form);
          $result_member->bindParam(':county_member', $county_member_form);

          if (!empty($_POST["member_member_" . $i])) {
            $member_member_form = $_POST["member_member_" . $i];
          }
          $result_member->bindParam(':member_member', $member_member_form);

          if (!empty($_POST["school_member_" . $i])) {
            $school_member_form = $_POST["school_member_" . $i];
          }
          $result_member->bindParam(':school_member', $school_member_form);

          if (!empty($_POST["course_member_" . $i])) {
            $course_member_form = $_POST["course_member_" . $i];
          }
          $result_member->bindParam(':course_member', $course_member_form);

          if (!empty($_POST["year_attend_member_" . $i])) {
            $year_attend_member_form = $_POST["year_attend_member_" . $i];
          }
          $result_member->bindParam(':year_attend_member', $year_attend_member_form);

          if (!empty($_POST["year_attend_member_" . $i])) {
            $year_attend_member_form = $_POST["year_attend_member_" . $i];
          }
          $result_member->bindParam(':company_member', $company_member_form);

          if (!empty($_POST["company_member_" . $i])) {
            $company_member_form = $_POST["company_member_" . $i];
          }
          $result_member->bindParam(':function_member', $function_member_form);

          if (!empty($_POST["function_member_" . $i])) {
            $function_member_form = $_POST["function_member_" . $i];
          }
          $result_member->bindParam(':skills_member', $skills_member_form);

          if (!empty($_POST["skills_member_" . $i])) {
            $skills_member_form = $_POST["skills_member_" . $i];
          }

          $result_member->bindParam(':date_create', $date_create_form);
          $result_member->execute();
        }

        $return = ['error' => false, 'msg' =>  "Equipe cadastrada com sucesso"];
      } else {
        $return = ['error' => true, 'msg' => "Erro: Ouve um erro ao cadastrar equipa"];
      };
    }
  }

  echo json_encode($return);
}

if ($type_form == 'get_all_member') {
  $id_member = $_GET['idMember'];

  $result_member = $pdo->prepare("SELECT * FROM members WHERE team_id=? ORDER BY id DESC ");
  $result_member->execute(array($id_member));
  $num_member = $result_member->rowCount();

  if ($num_member <= 0) {
    $return = ['error' => false, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum membro cadastrada </div>"];
  } else {
    $rowMember = "";

    while ($row_member = $result_member->fetch(PDO::FETCH_ASSOC)) {
      extract($row_member);

      $rowMember .= "
                  <tr>
                    <td>
                      <p>$name_member</p>
                    </td>
                    <td>
                      <p>$age_member</p>
                    </td>
                    <td>
                      <p>$email_member</p>
                    </td>
                    <td>
                      <p>$telephone_member</p>
                    </td>
                    <td>
                      <p>$identity_card_member</p>
                    </td>
                    <td>
                      <p>$province_member</p>
                    </td>
                    <td>
                      <p>$household_member</p>
                    </td>
                    <td>
                      <button onclick='deleteMember($id)' class='btn-delete'>
                        <i class='fas fa-trash-alt'></i>
                      </button>
                      <button onclick='editMember($id)' class='btn-edit'>
                        <i class='fas fa-edit'></i>
                      </button>
                      <button onclick='seeMember($id)' class='btn-see'>
                        <i class='fas fa-eye'></i>
                      </button>
                    </td>
                  </tr>
                ";
    }

    $return = ['error' => false, 'msg' => $rowMember];
  }
  echo json_encode($return);
}

if ($type_form == 'get_member') {
  $id_member = $_GET['idMember'];

  $result_member = $pdo->prepare("SELECT * FROM members WHERE id = ? ORDER BY id LIMIT 1");
  $result_member->execute(array($id_member));
  $num_member = $result_member->rowCount();

  if ($num_member >= 1) {
    $row_member = $result_member->fetch(PDO::FETCH_ASSOC);

    $return = ['error' => false, 'dados' => $row_member];

    echo json_encode($return);
  } else {
    $return = ['error' => true, 'msg' => "Nenhum equipa com esse id foi encontrado"];

    echo json_encode($return);
  }
}

if ($type_form == 'delete_member') {
  $id_member = $_GET['idMember'];

  $result_member = $pdo->prepare("DELETE FROM members WHERE id=?");

  if ($result_member->execute(array($id_member))) {
    $return = ['error' => false, 'msg' => "Ouve algum erro ao excluir a equipa"];
  } else {
    $return = ['error' => true, 'msg' =>  "A equipa não foi excluído :)"];
  }
}

if ($type_form == 'edite_member') {
  $id_member = $dataForm['idMember'];

  $name_member_form = $dataForm['name_member'];
  $identity_card_member_form = $dataForm['identity_card_member'];
  $nif_member_form = $dataForm['nif_member'];
  $age_member_form = $dataForm['age_member'];
  $telephone_member_form = $dataForm['telephone_member'];
  $household_member_form = $dataForm['household_member'];
  $email_member_form = $dataForm['email_member'];

  $province_member_form = $dataForm['province_member'];
  $county_member_form = $dataForm['county_member'];

  $university_member_form = '----------------';
  $school_member_form = '----------------';
  $course_member_form = '----------------';
  $year_attend_member_form = '----------------';
  $company_member_form = '----------------';
  $function_member_form = '----------------';
  $skills_member_form = '----------------';
  $return = "";

  if (empty($name_member_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> O campo Nome do integrante está vazio </div>"];
  } elseif (empty($identity_card_member_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo Bilhete de Identidade está vazio </div>"];
  } elseif (empty($nif_member_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo NIF está vazio </div>"];
  } elseif (empty($age_member_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo Idade está vazio </div>"];
  } elseif (empty($telephone_member_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo Telefone está vazio </div>"];
  } elseif (empty($household_member_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo Morada está vazio </div>"];
  } elseif (empty($email_member_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: O campo Email está vazio </div>"];
  } elseif (empty($province_member_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A província não foi selecionada </div>"];
  } elseif (empty($county_member_form)) {
    $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Erro: A província não foi selecionada </div>"];
  } else {
    $sql = $pdo->prepare("UPDATE members SET name_member=?, identity_card_member=?, nif_member=?, age_member=?, telephone_member=?, household_member=?, email_member=?, province_member=?, county_member=?, university_member=?, school_member=?, course_member=?, year_attend_member=?, company_member=?, function_member=?, skills_member=? WHERE id=31 ");

    if (!empty($_POST["university_member"])) {
      $university_member_form = $_POST["university_member"];
    }
    if (!empty($_POST["school_member"])) {
      $school_member_form = $_POST["school_member"];
    }
    if (!empty($_POST["course_member"])) {
      $course_member_form = $_POST["course_member"];
    }
    if (!empty($_POST["year_attend_member"])) {
      $year_attend_member_form = $_POST["year_attend_member"];
    }
    if (!empty($_POST["company_member"])) {
      $company_member_form = $_POST["company_member"];
    }
    if (!empty($_POST["function_member"])) {
      $function_member_form = $_POST["function_member"];
    }
    if (!empty($_POST["skills_member"])) {
      $skills_member_form = $_POST["skills_member"];
    }

    if ($sql->execute(array(
      $name_member_form,
      $identity_card_member_form,
      $nif_member_form,
      $age_member_form,
      $telephone_member_form,
      $household_member_form,
      $email_member_form,
      $province_member_form,
      $county_member_form,
      $university_member_form,
      $school_member_form,
      $course_member_form,
      $year_attend_member_form,
      $company_member_form,
      $function_member_form,
      $skills_member_form
    ))) {
      $return = ['error' => false, 'msg' =>  "<div class='alert alert-success' role='alert' id='msgAlerta'> Dados do membro actualizados com sucesso </div>"];
    } else {
      $return = ['error' => true, 'msg' => "<div class='alert alert-danger' role='alert' id='msgAlerta'> Ouve um erro ao actualizar os dados do membro </div>"];
    };
  }
  echo json_encode($return);
}