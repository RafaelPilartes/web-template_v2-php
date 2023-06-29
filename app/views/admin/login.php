<?php
if ((isset($_SESSION['adm_deal_days_email']))) {
  header('Location:  /admin/home');
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title> <?= SITE ?> - Login </title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= DASHBOARD_STYLES . "/bootstrap.min.css" ?>">

  <!-- External Css -->
  <link rel="stylesheet" href="<?= DASHBOARD_STYLES . "/line-awesome.min.css" ?>">

  <!-- Custom Css -->
  <link rel="stylesheet" type="text/css" href="<?= DASHBOARD_STYLES . "/main.css" ?>">
  <link rel="stylesheet" type="text/css" href="<?= DASHBOARD_STYLES . "/login.css" ?>">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Favicon -->
  <link rel="icon" href="<?= DASHBOARD_STYLES . "/images/favicon.png" ?>">
  <link rel="apple-touch-icon" href="<?= DASHBOARD_STYLES . "/images/apple-touch-icon.png" ?>">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= DASHBOARD_STYLES . "/images/icon-72x72.png" ?>">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= DASHBOARD_STYLES . "/images/icon-114x114.png" ?>">


</head>

<body>

  <div class="ugf-bg">
    <div class="container relative">
      <div class="row">
        <div class="col">
          <div class="ugf-container-wrap">
            <div class="ugf-container">
              <div class="ugf-form-block">
                <div class="ugf-form-wrap">
                  <img style="width: 22rem; margin: -1.8rem 0 3rem;" src="<?= DASHBOARD_IMG . "/logo-dark.png" ?>"
                    class="img-fluid" alt="">

                  <span class="marker-icon">
                    <img src="<?= DASHBOARD_IMG . "/marker-user.png" ?>" alt="">
                  </span>
                  <div>
                    <h3 style="text-align: center;">Painel - <?= SITE ?> </h3>
                    <p style="margin: -2.8rem 0 3rem; text-align: center;"> Deal of the Days
                    </p>
                  </div>

                  <div id="msgAlertaErroCad"></div>

                  <form id="loginForm">
                    <div class="form-group">
                      <input name="email_address_adm" type="email" class="form-control" id="inputEmail" required>
                      <label for="inputEmail">Endereço de email</label>
                    </div>

                    <div class="form-group">
                      <input name="login_password_adm" type="password" class="form-control" id="inputPass" required>
                      <label for="inputPass">Palavra pass</label>
                    </div>

                    <button type="submit" class="btn">Conecte-se</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="<?= DASHBOARD_JS . "/jquery.min.js" ?>"></script>
  <script src="<?= DASHBOARD_JS . "/popper.min.js" ?>"></script>
  <script src="<?= DASHBOARD_JS . "/bootstrap.min.js" ?>"></script>

  <script src="<?= DASHBOARD_JS . "/owl.carousel.min.js" ?>"></script>
  <script src="<?= DASHBOARD_JS . "/countrySelect.min.js" ?>"></script>

  <script src="<?= DASHBOARD_JS . "/custom.js" ?>"></script>

  <script src="<?= DASHBOARD_ACTIONS . "/actions_login_adm.js" ?>"></script>
</body>

</html>