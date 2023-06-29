<?php $this->layout("_theme"); ?>
<?php
if ((!isset($_SESSION['adm_deal_days_email']))) {
  header('Location:  /admin');
}
?>

<!-- head-title -->
<div class="head-title">
  <div class="left">
    <h1>Categorias</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Categorias</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a href="#">Listagem</a>
      </li>
    </ul>
  </div>
  <button class="btn-download" data-toggle="modal" data-target="#modalCreate">
    <i class="bx bxs-file-plus"></i>
    <span class="text">Nova categoria</span>
  </button>
</div>

<!-- MODAL -->
<div id="modalCreate" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Cadastrar novo categoria</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroCad"></span>
    </div>

    <form id="registerForm" class="modalForm">
      <div>
        <label for="name_category">
          Nome da categoria <span class="text-danger">*</span>
        </label>
        <input name="name_category" class="form-control" type="text" placeholder="Nome da categoria">
      </div>
      <div>
        <label for="visibility_category">
          Visibilidade da categoria <span class="text-danger">*</span>
        </label>
        <select name="visibility_category" class="form-control">
          <option value="Hidden">Oculta</option>
          <option value="Visible">Visivel</option>
        </select>
      </div>

      <button class="base-btn" type="submit">
        Criar categoria
      </button>
    </form>
  </div>
</div>

<div id="modalEdite" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Editar dados do categoria</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroEditCard"></span>
    </div>

    <form id="editForm" class="modalForm">
      <input id="id_edit" name="idCategory" hidden>

      <div>
        <label for="name_category">
          Nome da categoria <span class="text-danger">*</span>
        </label>
        <input name="name_category" id="name_category" class="form-control" type="text" placeholder="Nome da categoria">
      </div>
      <div>
        <label for="visibility_category">
          Visibilidade da categoria <span class="text-danger">*</span>
        </label>
        <select name="visibility_category" id="visibility_category" class="form-control">
          <option value="Hidden">Oculta</option>
          <option value="Visible">Visivel</option>
        </select>
      </div>

      <button class="base-btn" type="submit">
        Actualizar categoria
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
      <h3>Todas as Categorias</h3>
    </div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Nome</th>
          <th>Items</th>
          <th>Visibilidade</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <!-- <tr>
          <td>
            <p>1</p>
          </td>
          <td>
            <p> Accessories
            </p>
          </td>
          <td>
            <p>
              10
            </p>
          </td>
          <td><span class="status completed">Hidden</span></td>
          <td class='row'>
            <button onclick='deleteUniversity(1)' class='btn-delete'>
              <i class='fas fa-trash-alt'></i>
            </button>
            <button onclick='editeUniversity(1)' class='btn-edit'>
              <i class='fas fa-edit'></i>
            </button>
            <button onclick='seeUniversity(1)' class='btn-see'>
              <i class='fas fa-eye'></i>
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <p>2</p>
          </td>
          <td>
            <p> Consoles & Organizers
            </p>
          </td>
          <td>
            <p>
              7
            </p>
          </td>
          <td><span class="status pending">Visible</span></td>
          <td class='row'>
            <button onclick='deleteUniversity(1)' class='btn-delete'>
              <i class='fas fa-trash-alt'></i>
            </button>
            <button onclick='editeUniversity(1)' class='btn-edit'>
              <i class='fas fa-edit'></i>
            </button>
            <button onclick='seeUniversity(1)' class='btn-see'>
              <i class='fas fa-eye'></i>
            </button>
          </td>
        </tr> -->
      </tbody>
    </table>
  </div>
</div>

<script src="<?= DASHBOARD_ACTIONS . "/actions_category.js" ?>"></script>