<?php $this->layout("_theme"); ?>
<?php
if ((!isset($_SESSION['adm_deal_days_email']))) {
  header('Location:  /admin');
}
?>

<!-- head-title -->
<div class="head-title">
  <div class="left">
    <h1>Mensagens</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">mensagens</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a href="#">Listagem</a>
      </li>
    </ul>
  </div>
</div>

<!-- MODAL -->
<div id="modalSee" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Visualização da mensagem</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroSeeCard"></span>
    </div>

    <form id="seeForm" class="modalForm">
      <input ame="id" id="id_see" hidden>

      <div id="containerImagensEdit"></div>

      <div>
        <label for="name_user">
          Nome <span class="text-danger">*</span>
        </label>
        <input id="name_user_see" class="form-control" type="text" disabled>
      </div>

      <div>
        <label for="email_user">
          E-mail <span class="text-danger">*</span>
        </label>
        <input id="email_user_see" class="form-control" type="text" disabled>
      </div>

      <div>
        <label for="phone_user">
          E-mail <span class="text-danger">*</span>
        </label>
        <input id="phone_user_see" class="form-control" type="text" disabled>
      </div>

      <div>
        <label for="summary">
          Assunto
        </label>
        <input id="summary_see" class="form-control" type="text" disabled>
      </div>
      <div>
        <label for="message">
          Mensagem <span class="text-danger">*</span>
        </label>
        <textarea id="message_see" class="form-control" type="text" disabled></textarea>
      </div>

      <div>
        <label for="date_create">
          Ordem de Data <span class="text-danger">*</span>
        </label>
        <input id="date_create_see" class="form-control" type="text" disabled>
      </div>

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
      <h3>Todas as mensagens</h3>
    </div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Assunto</th>
          <th>Ordem de Data</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<script src="<?= DASHBOARD_ACTIONS . "/actions_messages.js" ?>"></script>