<?php
include_once "../db/config.php";

session_start();
$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_product') {
  $num_register = $_GET['numRegister'];

  $result_product = $pdo->prepare("SELECT * FROM product ORDER BY id DESC LIMIT :limitRegister");
  $result_product->bindParam(':limitRegister', $num_register, PDO::PARAM_INT);
  $result_product->execute();
  $num_product = $result_product->rowCount();

  if ($num_product <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> There are no products registered </div>";
  } else {
    $return = "";

    while ($row_product = $result_product->fetch(PDO::FETCH_ASSOC)) {

      extract($row_product);

      $decode_images_product = json_decode($images_product);

      $url_image = "";

      if ($decode_images_product) {
        $url_image = $decode_images_product[0];
      } else {
        $url_image = "https://img.freepik.com/free-vector/realistic-news-studio-background_23-2149985606.jpg";
      }

      $isNewArrivals = '';
      if ($is_new_arrivals == 'yes') {
        $isNewArrivals = "
        <div class='product-top'>
          <div class='flash'>
            <span class='onnew'>
              <span class='text'> new </span>
            </span>
          </div>
        </div>
        ";
      } else {
        $isNewArrivals = '';
      }

      $numberFormattedOld = '';
      $renderNumberFormattedOld = '';
      $renderNumberFormattedNew = '';
      $numberFormattedNew = number_format($new_price_product, 2, ',', '.');
      if (!empty($old_price_product)) {
        $numberFormattedOld = number_format($old_price_product, 2, ',', '.');

        if ($product_store  == 'yes') {
          $renderNumberFormattedOld = "<del>  $numberFormattedOld Akz </del>";
        } else {
          $renderNumberFormattedOld = "<del>  $ $numberFormattedOld </del>";
        }
      }
      if ($product_store  == 'yes') {
        $renderNumberFormattedNew = "<ins>  $numberFormattedNew Akz </ins>";
      } else {
        $renderNumberFormattedNew = "<ins>  $ $numberFormattedNew </ins>";
      }

      $return .= "
      <li class='product-item col-lg-4 col-md-6 col-sm-6 col-xs-6 col-ts-12 style-1'>
        <div class='product-inner equal-element'>
          $isNewArrivals
          <div class='product-thumb'>
            <div class='thumb-inner'>
              <a href='/products/details/$id'>
                <img src='$url_image' alt='img' />
              </a>
              <div class='thumb-group'>
                <div class='yith-wcwl-add-to-wishlist'>
                  <div class='yith-wcwl-add-button'>
                    <a onclick='addToFavorite($id)'>Add to Wishlist</a>
                  </div>
                </div>
                <a href='/products/details/$id' class='button quick-wiew-button'>Quick View</a>
                <div class='loop-form-add-to-cart'>
                  <button class='single_add_to_cart_button button'>
                    Add to cart
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class='product-info'>
            <h5 class='product-name product_title'>
              <a href='/products/details/$id'>$name_product</a>
            </h5>
            <div class='group-info'>
              <div class='stars-rating'>
                <div class='star-rating'>
                  <span class='star-3'></span>
                </div>
                <div class='count-star'>(3)</div>
              </div>
              <div class='price'>
                $renderNumberFormattedOld
                <ins> $renderNumberFormattedNew </ins>
              </div>
            </div>
          </div>
        </div>
      </li>
      ";
    }

    echo $return;
  }
}

if ($type_form == 'add_to_favorite') {
  $data = date('D');
  $mes = date('M');
  $dia = date('d');
  $ano = date('Y');

  $semana = array(
    'Sun' => 'Domingo',
    'Mon' => 'Segunda-Feira',
    'Tue' => 'Terca-Feira',
    'Wed' => 'Quarta-Feira',
    'Thu' => 'Quinta-Feira',
    'Fri' => 'Sexta-Feira',
    'Sat' => 'Sábado'
  );

  $mes_extenso = array(
    'Jan' => 'Janeiro',
    'Feb' => 'Fevereiro',
    'Mar' => 'Marco',
    'Apr' => 'Abril',
    'May' => 'Maio',
    'Jun' => 'Junho',
    'Jul' => 'Julho',
    'Aug' => 'Agosto',
    'Nov' => 'Novembro',
    'Sep' => 'Setembro',
    'Oct' => 'Outubro',
    'Dec' => 'Dezembro'
  );

  $completeDate =  $semana["$data"] . ", {$dia} de " . $mes_extenso["$mes"] . " de {$ano}";
  $id_product = $_GET['id_product'];

  if (!isset($_SESSION['customer_email'])) {
    $return = ['error' => false, 'msg' =>  "Login or register and try again 😓"];
    echo json_encode($return);
  } else {
    $email_customer = $_SESSION['customer_email'];

    $sql_insert = "INSERT INTO favorites (id_product, id_customer, date_create ) VALUES (:id_product, :id_customer, :date_create) ";
    $sql = $pdo->prepare($sql_insert);
    $sql->bindParam(':id_product', $id_product);
    $sql->bindParam(':id_customer', $email_customer);
    $sql->bindParam(':date_create', $completeDate);
    $sql->execute();

    $return = ['error' => false, 'msg' =>  "Product added successfully!❤️"];

    echo json_encode($return);
  }
}

if ($type_form == 'count_favorites') {
  if (!isset($_SESSION['customer_email'])) {
    echo 0;
  } else {
    $email_customer = $_SESSION['customer_email'];

    $query_get_count_favorites = "SELECT * FROM favorites WHERE id_customer = :id_customer ORDER BY id";
    $result_count_favorite = $pdo->prepare($query_get_count_favorites);
    $result_count_favorite->bindParam(':id_customer', $email_customer);
    $result_count_favorite->execute();

    $num_count_favorite = $result_count_favorite->rowCount();

    echo $num_count_favorite;
  }
}
