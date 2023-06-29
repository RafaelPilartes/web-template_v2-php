<?php $this->layout("_theme"); ?>
<?php
if ((!isset($_SESSION['adm_deal_days_email']))) {
  header('Location:  /admin');
}
?>

<div class="head-title">
  <div class="left">
    <h1>Painel</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Casa</a>
      </li>
    </ul>
  </div>
</div>

<ul class="box-info">
  <li>
    <i class="fas fa-user"></i>
    <span class="text">
      <h3>0</h3>
      <p>Customers</p>
    </span>
  </li>
  <li>
    <i class="bx bxs-group"></i>
    <span class="text">
      <h3>0</h3>
      <p>Nº Product</p>
    </span>
  </li>
  <li>
    <i class="fas fa-users"></i>
    <span class="text">
      <h3>0</h3>
      <p>Nº Orders </p>
    </span>
  </li>
</ul>
<ul class="box-info2">
  <li>
    <i class="fas fa-money-bill-wave"></i>
    <span class="text">
      <h3>0</h3>
      <p>Amount Paid</p>
    </span>
  </li>
  <li>
    <i class="fas fa-hand-holding-usd"></i>
    <span class="text">
      <h3>0</h3>
      <p>Nº Sales</p>
    </span>
  </li>
</ul>

<div class="table-data">
  <div class="order">
    <div class="head">
      <h3>Resumo dos pedidos</h3>
    </div>
    <table>
      <thead>
        <tr>
          <th>Nome da Equipa</th>
          <th>Nº Participantes</th>
          <th>Valor Pago</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <p>Tchossy Solution</p>
          </td>
          <td>
            <p>5</p>
          </td>
          <td>
            <p>50.000,00</p>
          </td>
          <td><span class="status completed">Concluído</span></td>
        </tr>
        <tr>
          <td>
            <p>Toqueplay</p>
          </td>
          <td>
            <p>3</p>
          </td>
          <td>
            <p>50.000,00</p>
          </td>
          <td><span class="status pending">Pendente</span></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script src="<?= DASHBOARD_ACTIONS . "/actions_home.js" ?>"></script>