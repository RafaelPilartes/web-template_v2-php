<?php
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'bestseller_products') {
  // Recuperar o valor atual da coluna
  $sql_views = "SELECT * FROM product WHERE is_best_sellers='yes' ORDER BY RAND() LIMIT 6";
  $result_product = $pdo->prepare($sql_views);
  $result_product->execute();
  $num_product = $result_product->rowCount();


  if ($num_product <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum produto cadastrada </div>";
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

if ($type_form == 'new_arrivals_products') {
  // Recuperar o valor atual da coluna
  $sql_views = "SELECT * FROM product WHERE is_new_arrivals='yes' ORDER BY RAND() LIMIT 6";
  $result_product = $pdo->prepare($sql_views);
  $result_product->execute();
  $num_product = $result_product->rowCount();


  if ($num_product <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum produto cadastrada </div>";
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

if ($type_form == 'top_rated_products') {
  // Recuperar o valor atual da coluna
  $sql_views = "SELECT * FROM product WHERE is_top_rated='yes' ORDER BY RAND() LIMIT 6";
  $result_product = $pdo->prepare($sql_views);
  $result_product->execute();
  $num_product = $result_product->rowCount();


  if ($num_product <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum produto cadastrada </div>";
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

if ($type_form == 'featured_products') {
  // Recuperar o valor atual da coluna
  $sql_views = "SELECT * FROM product ORDER BY RAND() LIMIT 16";
  $result_product = $pdo->prepare($sql_views);
  $result_product->execute();
  $num_product = $result_product->rowCount();


  if ($num_product <= 0) {
    echo $return = "<div class='alert alert-danger' role='alert' id='msgAlerta'> Não tem nenhum produto cadastrada </div>";
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
          <div class='flash'>
            <span class='onnew'>
              <span class='text'> new </span>
            </span>
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
      <li class='product-item col-lg-4 col-md-6 col-sm-6 col-xs-6 col-ts-12 style-3'>
        <div class='product-inner equal-element'>
          <div class='product-thumb'>
            <div class='product-top'>
              $isNewArrivals
              <div class='yith-wcwl-add-to-wishlist'>
                <div class='yith-wcwl-add-button'>
                  <a onclick='addToFavorite($id)' tabindex='0'>Add to Wishlist</a>
                </div>
              </div>
            </div>
            <div class='thumb-inner'>
              <a href='/products/details/$id' tabindex='0'>
                <img src='$url_image' alt='img' />
              </a>
            </div>
            <a href='/products/details/$id' class='button quick-wiew-button' tabindex='0'>Quick View</a>
          </div>
          <div class='product-info'>
            <h5 class='product-name product_title'>
              <a href='/products/details/$id' tabindex='0'>$name_product</a>
            </h5>
            <div class='group-info'>
              <div class='stars-rating'>
                <div class='star-rating'>
                  <span class='star-3'></span>
                </div>
                <div class='count-star'>(3)</div>
              </div>
              <div class='price'>
                <ins> $renderNumberFormattedNew </ins>
              </div>
            </div>
            <div class='group-buttons'>
              <div class='quantity'>
                <div class='control'>
                  <a class='btn-number qtyminus quantity-minus' href='#'>-</a>
                  <input type='text' data-step='1' data-min='0' value='1' title='Qty' class='input-qty qty'
                    size='4' />
                  <a href='/products/details/$id' class='btn-number qtyplus quantity-plus'>+</a>
                </div>
              </div>
              <button class='add_to_cart_button button' tabindex='0'>
                Shop now
              </button>
            </div>
          </div>
        </div>
      </li>
      ";
    }

    echo $return;
  }
}
