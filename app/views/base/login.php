<?php

if ((isset($_SESSION['customer_email']))) {
  header('Location: http://localhost:8000');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= SITE ?> - Login</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link
    href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Favicon -->
  <link rel="icon" href="<?= BASE_IMG . "/favicon.png" ?>">

  <!-- Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Style -->
  <link rel="stylesheet" type="text/css" href="<?= BASE_STYLES . "/login.css" ?>" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
</head>

<body>
  <div class="page" style="height: 100vh;">
    <form class="formLogin" id="registerForm">
      <img src="<?= BASE_IMG . "/logo.png" ?>" alt="img" />

      <div id="msgAlertaErroCad"></div>

      <h1>Login</h1>
      <p>Digite os seus dados de acesso no campo abaixo.</p>
      <label for="email_customer">E-mail</label>
      <input name="email_customer" type="email" placeholder="Digite seu e-mail" autofocus="true" />
      <label for="login_password_customer">Senha</label>
      <input name="login_password_customer" type="password" placeholder="Digite seu e-mail" />
      <a href="/register">Ainda não tenho uma conta</a>
      <input type="submit" value="Acessar" class="btn" />
    </form>
  </div>

</body>

</html>

<script src="<?= BASE_ACTIONS . "/actions_login.js" ?>"></script>