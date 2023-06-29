<?php

include_once "../db/config.php";

$type_action = $_GET['typeAction'];

if ($type_action == 'count_teams') {
  $query_get_count_teams = "SELECT * FROM team";
  $result_count_team = $pdo->prepare($query_get_count_teams);
  $result_count_team->execute();

  $num_count_team = $result_count_team->rowCount();

  echo $num_count_team;
}
if ($type_action == 'count_members') {
  $query_get_count_members = "SELECT * FROM members";
  $result_count_member = $pdo->prepare($query_get_count_members);
  $result_count_member->execute();

  $num_count_member = $result_count_member->rowCount();

  echo $num_count_member;
}

if ($type_action == 'count_paid_out') {
  $query_get_paid_outs = "SELECT value_payment_team FROM team WHERE status_payment_team = 'Pago'";
  $result_paid_out = $pdo->prepare($query_get_paid_outs);
  $result_paid_out->execute();

  $num_paid_out = $result_paid_out->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($num_paid_out);
}
if ($type_action == 'count_paid_pending') {
  $query_get_paid_pending = "SELECT value_payment_team FROM team WHERE status_payment_team = 'Pendente'";
  $result_paid_pending = $pdo->prepare($query_get_paid_pending);
  $result_paid_pending->execute();

  $num_paid_pending = $result_paid_pending->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($num_paid_pending);
}

if ($type_action == 'get_team') {

  $result_team = $pdo->prepare("SELECT * FROM team ORDER BY id DESC LIMIT 8");
  $result_team->execute();
  $num_team = $result_team->rowCount();

  if ($num_team <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum member cadastrado no momento </div>";
  } else {
    $return = "";

    while ($row_team = $result_team->fetch(PDO::FETCH_ASSOC)) {
      extract($row_team);

      $state_is = '';

      if ($status_payment_team == 'Pago') {
        $state_is = 'completed';
      } else {
        $state_is = 'pending';
      }

      $return .= "
                  <tr>
                    <td>$name_team</p>
                    </td>
                    <td>
                      <p>$type_team</p>
                    </td>
                    <td>
                      <p>$amount_members_team</p>
                    </td>
                    <td>
                      <p>$value_payment_team,00</p>
                    </td>
                    <td><span class='status $state_is'>$status_payment_team</span></td>
                  </tr>
      ";
    }

    echo $return;
  }
}
