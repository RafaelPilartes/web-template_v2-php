<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

echo 1;

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

if ($type_form == 'get_products_search') {
  $num_product = $_GET['numRegister'];
  $searchTerm = $_GET['search_term'];

  if (empty($searchTerm)) {
    $return = ['error' => true, 'msg' => "O campo de pesquisa está vazio"];
  } else {
    $result_search = $pdo->prepare("SELECT * FROM product WHERE name_product LIKE :searchTerm ORDER BY id DESC LIMIT :limitRegister");
    $result_search->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    $result_search->bindParam(':limitRegister', $num_product, PDO::PARAM_INT);
    $result_search->execute();
    $num_search = $result_search->rowCount();

    if ($num_search <= 0) {
      echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> No product found </div>";
    } else {
      $return = "";

      while ($row_product = $result_search->fetch(PDO::FETCH_ASSOC)) {

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
}

if ($type_form == 'new_view_product') {
  $id_product = $_GET['idProduct'];

  // Recuperar o valor atual da coluna
  $sql_views = "SELECT views_product FROM product WHERE id = :id";
  $get_column_views = $pdo->prepare($sql_views);
  $get_column_views->bindParam(':id', $id_product);
  $get_column_views->execute();
  $currentValue = $get_column_views->fetchColumn();

  // Calcular o novo valor
  $newValue = $currentValue + 1;

  $sql_update = "UPDATE product SET views_product = :novoValor WHERE id = :id";
  $sql = $pdo->prepare($sql_update);
  $sql->bindParam(':novoValor', $newValue);
  $sql->bindParam(':id', $id_product);
  $sql->execute();
}

if ($type_form == 'get_product_category') {
  $num_register = $_GET['numRegister'];
  $categoryProduct = $_GET['category_product'];

  $result_product = $pdo->prepare("SELECT * FROM product WHERE category_product = :categoryProduct ORDER BY id DESC LIMIT :limitRegister");
  $result_product->bindParam(':categoryProduct', $categoryProduct);
  $result_product->bindParam(':limitRegister', $num_register, PDO::PARAM_INT);
  $result_product->execute();
  $num_product = $result_product->rowCount();

  if ($num_product <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> There are no products registered with this category </div>";
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
