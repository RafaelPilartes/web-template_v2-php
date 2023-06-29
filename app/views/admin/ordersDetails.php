<?php $this->layout("_theme"); ?>

<!-- head-title -->
<div class="head-title">
  <div class="left">
    <h1>Equipa > <span id="nameTeamH1"></span> </h1>
    <ul class="breadcrumb">
      <li>
        <a href="#">Painel</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a class="active" href="#">Equipas</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a href="#">Detalhes</a>
      </li>
      <li><i class="bx bx-chevron-right"></i></li>
      <li>
        <a href="#" id="nameTeamA"></a>
      </li>
    </ul>
  </div>
</div>

<!-- MODAL -->



<!-- TABLE -->
<div class="table-data">
  <div class="order">
    <div class="head">
      <h3>Dados da equipa</h3>
    </div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Nome da Equipa</th>
          <th>Tipo de Equipa</th>
          <th>Nº Participantes</th>
          <th>Valor Pago</th>
          <th>Estado</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <p id="id_team_list"></p>
          </td>
          <td>
            <p id="name_team_list"></p>
          </td>
          <td>
            <p id="type_team_list"></p>
          </td>
          <td>
            <p id="amount_members_list"></p>
          </td>
          <td>
            <p id="value_payment_team_list"></p>
          </td>
          <td><span id="status_payment_team_list" class="status "></span></td>
          <td>
            <button class="btn-delete" onclick='deleteTeam()'>
              <i class="fas fa-trash-alt"></i>
            </button>
            <button class="btn-edit" onclick='editTeam()'>
              <i class="fas fa-edit"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="table-data">
  <div class="order">
    <div class="head">
      <h3>Membros da equipa</h3>
    </div>
    <table>
      <thead>
        <tr>
          <th>Nome do Membro</th>
          <th>Idade</th>
          <th>E-mail</th>
          <th>Telefone</th>
          <th>Bilhete</th>
          <th>Província</th>
          <th>Morada</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody id="tbodyMember">
      </tbody>
    </table>
  </div>
</div>

<div>
  <script src="<?= BASE_JS . "/jquery-3.6.0.min.js" ?>"></script>
  <script src="<?= BASE_JS . "/bootstrap2.min.js" ?>"></script>
</div>