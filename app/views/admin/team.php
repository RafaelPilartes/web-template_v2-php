<?php $this->layout("_theme"); ?>
<?php
if ((!isset($_SESSION['adm_deal_days_email']))) {
  header('Location:  /admin');
}
?>

<!-- head-title -->
<div class="head-title">
  <div class="left">
    <h1>Membros</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Membros</a>
      </li>
    </ul>
  </div>
  <button class="btn-download" data-toggle="modal" data-target="#modalCreate">
    <i class="bx bxs-file-plus"></i>
    <span class="text">Novo Membro</span>
  </button>
</div>

<!-- MODAL -->
<div id="modalCreate" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Cadastrar novo Membro</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroCad"></span>
    </div>

    <form id="registerForm" class="modalForm">

      <input name="images_member[]" class="form-control" type="file" id="inputImagens">
      <div id="containerImagens"></div>

      <div>
        <label for="full_name_adm">
          Nome do Membro <span class="text-danger">*</span>
        </label>
        <input name="full_name_adm" class="form-control" type="text" placeholder="Nome do Adm">
      </div>
      <div>
        <label for="email_address_adm">
          E-mail do Membro <span class="text-danger">*</span>
        </label>
        <input name="email_address_adm" class="form-control" type="text" placeholder="E-mail do Adm">
      </div>
      <div>
        <label for="number_phone_adm">
          Nº de telefone do Membro <span class="text-danger">*</span>
        </label>
        <input name="number_phone_adm" class="form-control" type="text" placeholder="Nº de telefone">
      </div>
      <div>
        <label for="permissions_adm">
          Permissões do Membro <span class="text-danger">*</span>
        </label>
        <select name="permissions_adm" class="form-control">
          <option value="read">Apenas leitura</option>
          <option value="write">Apenas cadastrar</option>
          <option value="all_permissions">Todas as permissões</option>
        </select>
      </div>
      <div>
        <label for="login_password_adm">
          Password <span class="text-danger">*</span>
        </label>
        <input name="login_password_adm" class="form-control" type="password" placeholder="Password">
      </div>
      <div>
        <label for="login_confirm_password_adm">
          Confirme a password <span class="text-danger">*</span>
        </label>
        <input name="login_confirm_password_adm" class="form-control" type="password" placeholder="Confirme a password">
      </div>

      <button class="base-btn" type="submit">
        Cadastrar membro
      </button>
    </form>
  </div>
</div>

<div id="modalEdite" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Editar dados do Membro</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroEditCad"></span>
    </div>

    <form id="editForm" class="modalForm">
      <input id="id_edit" name="id_adm" hidden>

      <input name="images_member[]" class="form-control" type="file" id="inputImagensEdit">
      <div id="containerImagensEdit">
        <img id="images_member_edit" />
      </div>

      <div>
        <label for="full_name_adm">
          Nome do Membro <span class="text-danger">*</span>
        </label>
        <input name="full_name_adm" id="full_name_adm_edit" class="form-control" type="text" placeholder="Nome do Adm">
      </div>
      <div>
        <label for="email_address_adm">
          E-mail do Membro <span class="text-danger">*</span>
        </label>
        <input name="email_address_adm" id="email_address_adm_edit" class="form-control" type="text"
          placeholder="E-mail do Adm">
      </div>
      <div>
        <label for="number_phone_adm">
          Nº de telefone do Membro <span class="text-danger">*</span>
        </label>
        <input name="number_phone_adm" id="number_phone_adm_edit" class="form-control" type="text"
          placeholder="Nº de telefone">
      </div>
      <div>
        <label for="permissions_adm">
          Permissões do Membro <span class="text-danger">*</span>
        </label>
        <select name="permissions_adm" id="permissions_adm_edit" class="form-control">
          <option value="read">Apenas leitura</option>
          <option value="write">Apenas cadastrar</option>
          <option value="all_permissions">Todas as permissões</option>
        </select>
      </div>
      <div>
        <label for="login_password_adm">
          Nova password <span class="text-danger">*</span>
        </label>
        <input name="login_password_adm" class="form-control" type="password" placeholder="Password">
      </div>
      <div>
        <label for="login_confirm_password_adm">
          Confirme a password <span class="text-danger">*</span>
        </label>
        <input name="login_confirm_password_adm" class="form-control" type="password" placeholder="Confirme a password">
      </div>

      <button class="base-btn" type="submit">
        Actualizar dados do Adm
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
      <h3>Todos os Membros</h3>
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
          <th>Permissão</th>
          <th>Data de registo</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<script src="<?= DASHBOARD_ACTIONS . "/actions_adm.js" ?>"></script>