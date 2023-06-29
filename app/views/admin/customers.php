<?php $this->layout("_theme"); ?>
<?php
if ((!isset($_SESSION['adm_deal_days_email']))) {
  header('Location:  /admin');
}
?>

<!-- head-title -->
<div class="head-title">
  <div class="left">
    <h1>Cliente</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Cliente</a>
      </li>
    </ul>
  </div>
  <button class="btn-download" data-toggle="modal" data-target="#modalCreate">
    <i class="bx bxs-file-plus"></i>
    <span class="text">Novo Cliente</span>
  </button>
</div>

<!-- MODAL -->
<div id="modalCreate" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Cadastrar novo Cliente</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroCad"></span>
    </div>

    <form id="registerForm" class="modalForm">

      <input name="images_member[]" class="form-control" type="file" id="inputImagens">
      <div id="containerImagens"></div>

      <div>
        <label for="name_customer">
          Nome do Cliente <span class="text-danger">*</span>
        </label>
        <input name="name_customer" class="form-control" type="text" placeholder="Nome do cliente">
      </div>
      <div>
        <label for="email_customer">
          E-mail do Cliente <span class="text-danger">*</span>
        </label>
        <input name="email_customer" class="form-control" type="text" placeholder="E-mail do cliente">
      </div>
      <div>
        <label for="phone_customer">
          Nº de telefone do Cliente <span class="text-danger">*</span>
        </label>
        <input name="phone_customer" class="form-control" type="text" placeholder="Nº de telefone">
      </div>
      <div>
        <label for="login_password_customer">
          Password <span class="text-danger">*</span>
        </label>
        <input name="login_password_customer" class="form-control" type="password" placeholder="Password">
      </div>
      <div>
        <label for="login_confirm_password_customer">
          Confirme a password <span class="text-danger">*</span>
        </label>
        <input name="login_confirm_password_customer" class="form-control" type="password"
          placeholder="Confirme a password">
      </div>

      <button class="base-btn" type="submit">
        Cadastrar Cliente
      </button>
    </form>
  </div>
</div>

<div id="modalEdite" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Editar dados do Cliente</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroEditCad"></span>
    </div>

    <form id="editForm" class="modalForm">
      <input id="id_edit" name="id_customer" hidden>

      <input name="images_member[]" class="form-control" type="file" id="inputImagensEdit">
      <div id="containerImagensEdit">
        <img id="images_member_edit" />
      </div>

      <div>
        <label for="name_customer">
          Nome do Cliente <span class="text-danger">*</span>
        </label>
        <input name="name_customer" id="name_customer_edit" class="form-control" type="text"
          placeholder="Nome do cliente">
      </div>
      <div>
        <label for="email_customer">
          E-mail do Cliente <span class="text-danger">*</span>
        </label>
        <input name="email_customer" id="email_customer_edit" class="form-control" type="text"
          placeholder="E-mail do cliente">
      </div>
      <div>
        <label for="phone_customer">
          Nº de telefone do Cliente <span class="text-danger">*</span>
        </label>
        <input name="phone_customer" id="phone_customer_edit" class="form-control" type="text"
          placeholder="Nº de telefone">
      </div>
      <div>
        <label for="login_password_customer">
          Nova password <span class="text-danger">*</span>
        </label>
        <input name="login_password_customer" class="form-control" type="password" placeholder="Password">
      </div>
      <div>
        <label for="login_confirm_password_customer">
          Confirme a password <span class="text-danger">*</span>
        </label>
        <input name="login_confirm_password_customer" class="form-control" type="password"
          placeholder="Confirme a password">
      </div>

      <button class="base-btn" type="submit">
        Actualizar dados do cliente
      </button>
    </form>
  </div>
</div>

<!-- TABLE -->
<div class="table-data">
  <div class="order">
    <div class="containerFilter">
      <div class="numRegister">
        <span>Registos por pagina</span>
        <select id="numRegister">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="15">15</option>
          <option value="20">20</option>
          <option value="25">25</option>
          <option value="30">30</option>
          <option value="35">35</option>
          <option value="40">40</option>
          <option value="45">45</option>
          <option value="50">50</option>
        </select>
      </div>

      <form class="searchRegister" id='searchRegister'>
        <input type="text" placeholder="Procurar" id="searchRegisterValue" />
        <button type="submit" class="search-btn">
          <i class="bx bx-search"></i>
        </button>
      </form>
    </div>

    <div class="head">
      <h3>Todos os Cliente</h3>
      <i class="bx bx-search"></i>
      <i class="bx bx-filter"></i>
    </div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Fotografia</th>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Nº de telefone</th>
          <th>Data de registo</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<script src="<?= DASHBOARD_ACTIONS . "/actions_customers.js" ?>"></script>