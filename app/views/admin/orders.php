<?php $this->layout("_theme"); ?>

<!-- head-title -->
<div class="head-title">
  <div class="left">
    <h1>Encomendas</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Encomendas</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a href="#">Listagem</a>
      </li>
    </ul>
  </div>
  <button class="btn-download" data-toggle="modal" data-target="#userModal">
    <i class="bx bxs-file-plus"></i>
    <span class="text">Nova encomenda</span>
  </button>
</div>

<!-- MODAL -->
<div id="userModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Cadastrar novo encomenda</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroCad"></span>
    </div>

    <form id="registerForm" class="modalForm">
      <div>
        <label for="">
          Nome do encomenda <span class="text-danger">*</span>
        </label>
        <input name="full_name_user" class="form-control" type="text" placeholder="Nome do encomenda">
      </div>
      <div>
        <label for="">
          E-mail do encomenda <span class="text-danger">*</span>
        </label>
        <input name="email_address_user" class="form-control" type="text" placeholder="E-mail do encomenda">
      </div>
      <div>
        <label for="">
          Nº de telefone do encomenda <span class="text-danger">*</span>
        </label>
        <input name="number_phone_user" class="form-control" type="text" placeholder="Nº de telefone">
      </div>
      <div>
        <label for="">
          Password <span class="text-danger">*</span>
        </label>
        <input name="login_password_user" class="form-control" type="password" placeholder="Password">
      </div>
      <div>
        <label for="">
          Confirme a password <span class="text-danger">*</span>
        </label>
        <input name="login_confirm_password_user" class="form-control" type="password" placeholder="Confirme a password">
      </div>

      <button class="base-btn" type="submit">
        Dar entrada
      </button>
    </form>
  </div>
</div>

<div id="userEditeModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Editar dados do encomenda</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroEditCad"></span>
    </div>

    <form id="editForm" class="modalForm">
      <input id="id_edit" name="id_utente" hidden>

      <div>
        <label for="">
          Nome do encomenda <span class="text-danger">*</span>
        </label>
        <input id="full_name_user_edit" name="full_name_user" class="form-control" type="text" placeholder="Nome do encomenda">
      </div>
      <div>
        <label for="">
          E-mail do encomenda <span class="text-danger">*</span>
        </label>
        <input id="email_address_user_edit" name="email_address_user" class="form-control" type="text" placeholder="E-mail do encomenda">
      </div>
      <div>
        <label for="">
          Nº de telefone do encomenda <span class="text-danger">*</span>
        </label>
        <input id="number_phone_user_edit" name="number_phone_user" class="form-control" type="text" placeholder="Nº de telefone">
      </div>

      <button class="base-btn" type="submit">
        Actualizar dados do encomenda
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
        <select name="" id="">
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

      <form class="searchRegister">
        <input type="text" placeholder="Procurar" />
        <button type="submit" class="search-btn">
          <i class="bx bx-search"></i>
        </button>
      </form>
    </div>

    <div class="head">
      <h3>Todas as encomendas</h3>
    </div>
    <table>
      <thead>
        <tr>
          <th>Nº</th>
          <th>Cliente</th>
          <th>Items</th>
          <th>Total</th>
          <th>Pagamento</th>
          <th>Estado</th>
          <th>Data</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>