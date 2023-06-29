<?php $this->layout("_theme"); ?>
<?php
if ((!isset($_SESSION['adm_deal_days_email']))) {
  header('Location:  /admin');
}
?>

<!-- head-title -->
<div class="head-title">
  <div class="left">
    <h1>Produtos</h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Produtos</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a href="#">Listagem</a>
      </li>
    </ul>
  </div>
  <button class="btn-download" data-toggle="modal" data-target="#modalCreate">
    <i class="bx bxs-file-plus"></i>
    <span class="text">Novo produto</span>
  </button>
</div>

<!-- MODAL -->
<div id="modalCreate" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Cadastrar novo produto</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroCad"></span>
    </div>

    <form id="registerForm" class="modalForm">

      <input name="images_product[]" class="form-control" type="file" id="inputImagens" multiple>
      <div id="containerImagens"></div>

      <div>
        <label for="name_product">
          Nome do produto <span class="text-danger">*</span>
        </label>
        <input name="name_product" class="form-control" type="text" placeholder="Nome do produto">
      </div>

      <div>
        <label for="description_product">
          Descrição do produto <span class="text-danger">*</span>
        </label>
        <textarea name="description_product" class="form-control" type="text"
          placeholder="Descrição do produto"></textarea>
      </div>

      <div>
        <label for="old_price_product">
          Preço Antigo
        </label>
        <input name="old_price_product" class="form-control" type="number" placeholder="Preço Antigo">
      </div>
      <div>
        <label for="new_price_product">
          Preço Novo <span class="text-danger">*</span>
        </label>
        <input name="new_price_product" class="form-control" type="number" placeholder="Preço Novo">
      </div>

      <div>
        <label for="category_product">
          Categoria do produto <span class="text-danger">*</span>
        </label>
        <select name="category_product" id="category_select" class="form-control">
          <option value="In Stock">Selecione a categoria</option>
        </select>
      </div>

      <div>
        <label for="stock_product">
          Stock do produto <span class="text-danger">*</span>
        </label>
        <select name="stock_product" class="form-control">
          <option value="In Stock">Em estoque</option>
          <option value="Out of Stock" selected>Fora de estoque</option>
        </select>
      </div>

      <hr />
      <br />

      <div>
        <label for="product_store">
          É um produto da loja? <span class="text-danger">*</span>
        </label>
        <select name="product_store" id="product_store_select" class="form-control">
          <option value="no">Não</option>
          <option value="yes">Sim</option>
        </select>
      </div>
      <div id="link_product_container">
        <label for="link_product">
          Link do produto
        </label>
        <input name="link_product" id="link_product" class="form-control" type="text" placeholder="Link do produto">
      </div>

      <div>
        <label for="is_best_sellers">
          Faz parte dos mais vendidos? <span class="text-danger">*</span>
        </label>
        <select name="is_best_sellers" id="is_best_sellers_select" class="form-control">
          <option value="yes">Sim</option>
          <option value="no">Não</option>
        </select>
      </div>
      <div>
        <label for="is_new_arrivals">
          É recém-chegado? <span class="text-danger">*</span>
        </label>
        <select name="is_new_arrivals" id="is_new_arrivals_select" class="form-control">
          <option value="no">Não</option>
          <option value="yes">Sim</option>
        </select>
      </div>
      <div>
        <label for="is_top_rated">
          É muito bem avaliado? <span class="text-danger">*</span>
        </label>
        <select name="is_top_rated" id="is_top_rated_select" class="form-control">
          <option value="yes">Sim</option>
          <option value="no">Não</option>
        </select>
      </div>

      <hr />

      <div id="characteristics-container">
        <h3>Caracteristicas do produto</h3>
        <div class="rowItems">
          <div class="characteristic-input col-md-6 p-sm-0">
            <label for="characteristic-name-0">Nome da Característica 1:</label>
            <input name="name_characteristic[]" type="text" id="characteristic-name-0"
              class="form-control characteristic-name" required />
          </div>
          <div class="characteristic-input col-md-6 p-sm-0">
            <label for="characteristic-value-0">Valor da Característica 1:</label>
            <input name="value_characteristic[]" type="text" id="characteristic-value-0"
              class="form-control characteristic-value" required />
          </div>
        </div>
      </div>

      <div>
        <button class="alternative-btn" type="button" id="add-characteristic-button">
          Adicionar Característica
        </button>
      </div>

      <br />
      <hr />
      <br />


      <button class="base-btn" type="submit">
        Criar produto
      </button>
    </form>
  </div>
</div>

<div id="modalEdite" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Editar dados do produto</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroEditCard"></span>
    </div>

    <form id="editForm" class="modalForm">
      <input name="idProduct" id="id_edite" hidden>

      <input name="images_product[]" class="form-control" type="file" id="inputImagensEdit" multiple>
      <div id="containerImagensEdit">
        <img id="images_product_edit" />
      </div>

      <div>
        <label for="name_product">
          Nome do produto <span class="text-danger">*</span>
        </label>
        <input name="name_product" id="name_product_edite" class="form-control" type="text"
          placeholder="Nome do produto">
      </div>

      <div>
        <label for="description_product">
          Descrição do produto <span class="text-danger">*</span>
        </label>
        <textarea name="description_product" id="description_product_edite" class="form-control" type="text"
          placeholder="Descrição do produto"></textarea>
      </div>

      <div>
        <label for="old_price_product">
          Preço Antigo
        </label>
        <input name="old_price_product" id="old_price_product_edite" class="form-control" type="number"
          placeholder="Preço Antigo">
      </div>
      <div>
        <label for="new_price_product">
          Preço Novo <span class="text-danger">*</span>
        </label>
        <input name="new_price_product" id="new_price_product_edite" class="form-control" type="number"
          placeholder="Preço Novo">
      </div>

      <div>
        <label for="category_product">
          Categoria do produto <span class="text-danger">*</span>
        </label>
        <select name="category_product" id="category_product_edite" class="form-control">
          <option value="">Selecione a categoria</option>
        </select>
      </div>

      <div>
        <label for="stock_product">
          Stock do produto <span class="text-danger">*</span>
        </label>
        <select name="stock_product" id="stock_product_edite" class="form-control">
          <option value="Out of Stock" selected>Fora de estoque</option>
          <option value="In Stock">Em estoque</option>
        </select>
      </div>

      <hr />
      <br />

      <div>
        <label for="product_store">
          É um produto da loja? <span class="text-danger">*</span>
        </label>
        <select name="product_store" id="product_store_select_edit" class="form-control">
          <option value="no">Não</option>
          <option value="yes">Sim</option>
        </select>
      </div>
      <div id="link_product_container_edit">
        <label for="link_product">
          Link do produto
        </label>
        <input name="link_product" id="link_product_edit" class="form-control" type="text"
          placeholder="Link do produto">
      </div>

      <div>
        <label for="is_best_sellers">
          Faz parte dos mais vendidos? <span class="text-danger">*</span>
        </label>
        <select name="is_best_sellers" id="is_best_sellers_select_edit" class="form-control">
          <option value="yes">Sim</option>
          <option value="no">Não</option>
        </select>
      </div>
      <div>
        <label for="is_new_arrivals">
          É recém-chegado? <span class="text-danger">*</span>
        </label>
        <select name="is_new_arrivals" id="is_new_arrivals_select_edit" class="form-control">
          <option value="no">Não</option>
          <option value="yes">Sim</option>
        </select>
      </div>
      <div>
        <label for="is_top_rated">
          É muito bem avaliado? <span class="text-danger">*</span>
        </label>
        <select name="is_top_rated" id="is_top_rated_select_edit" class="form-control">
          <option value="yes">Sim</option>
          <option value="no">Não</option>
        </select>
      </div>

      <hr />
      <br />

      <h3>Caracteristicas do produto</h3>
      <div id="characteristics-container-edit">
      </div>

      <div>
        <button class="alternative-btn" type="button" id="add-characteristic-button-edit">
          Adicionar Característica
        </button>
      </div>

      <br />
      <hr />
      <br />

      <button class="base-btn" type="submit">
        Actualizar produto
      </button>
    </form>
  </div>
</div>

<div id="modalSee" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="container-modal">
      <h2>Visualização dos dados do produto</h2>
    </div>

    <div class="container-modal">
      <span id="msgAlertaErroSeeCard"></span>
    </div>

    <form id="seeForm" class="modalForm">
      <input ame="id" id="id_see" hidden>

      <div id="containerImagensSee">
        <img id="images_product_see" />
      </div>

      <div>
        <label for="name_product">
          Nome do produto <span class="text-danger">*</span>
        </label>
        <input id="name_product_see" class="form-control" type="text" disabled>
      </div>

      <div>
        <label for="description_product">
          Descrição do produto <span class="text-danger">*</span>
        </label>
        <textarea id="description_product_see" class="form-control" type="text" disabled></textarea>
      </div>

      <div>
        <label for="old_price_product">
          Preço Antigo
        </label>
        <input id="old_price_product_see" class="form-control" type="text" disabled>
      </div>
      <div>
        <label for="new_price_product">
          Preço Novo <span class="text-danger">*</span>
        </label>
        <input id="new_price_product_see" class="form-control" type="text" disabled>
      </div>

      <div>
        <label for="category_product">
          Categoria do produto <span class="text-danger">*</span>
        </label>
        <input id="category_product_see" class="form-control" type="text" disabled>
      </div>

      <div>
        <label for="stock_product">
          Stock do produto <span class="text-danger">*</span>
        </label>
        <input id="stock_product_see" class="form-control" type="text" disabled>
      </div>

      <div>
        <label for="product_store_see">
          É um produto da loja? <span class="text-danger">*</span>
        </label>
        <input id="product_store_see" class="form-control" type="text" disabled>
      </div>
      <div>
        <label for="link_product_see">
          Link do produto <span class="text-danger">*</span>
        </label>
        <input id="link_product_see" class="form-control" type="text" disabled>
      </div>
      <div>
        <label for="is_best_sellers_see">
          Faz parte dos mais vendidos? <span class="text-danger">*</span>
        </label>
        <input id="is_best_sellers_see" class="form-control" type="text" disabled>
      </div>
      <div>
        <label for="is_new_arrivals_see">
          É recém-chegado? <span class="text-danger">*</span>
        </label>
        <input id="is_new_arrivals_see" class="form-control" type="text" disabled>
      </div>
      <div>
        <label for="is_top_rated_see">
          É muito bem avaliado? <span class="text-danger">*</span>
        </label>
        <input id="is_top_rated_see" class="form-control" type="text" disabled>
      </div>

      <div class="table-data">
        <div class="order">
          <div class="head">
            <h4>Caracteristicas do produto</h4>
          </div>
          <table>
            <thead>
              <tr>
                <th>Nome</th>
                <th>Valor</th>
              </tr>
            </thead>
            <tbody id="characteristics-container-see">
            </tbody>
          </table>
        </div>
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
      <h3>Todas as Produtos</h3>
    </div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Capa</th>
          <th>Produto</th>
          <th>Categoria</th>
          <th>Preço Antigo</th>
          <th>Preço Novo</th>
          <th>Stock</th>
          <th>Data de cadastro</th>
          <th>Clicks</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody id="all_records">

      </tbody>
    </table>
  </div>
</div>

<script src="<?= DASHBOARD_ACTIONS . "/actions_product.js" ?>"></script>