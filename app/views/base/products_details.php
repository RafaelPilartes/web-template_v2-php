<?php $this->layout("_theme"); ?>

<?php

//conexao da base de dados//
require 'base/db/config.php';

$currentURL = $_SERVER['REQUEST_URI'];

// Obtém a última parte da URI
$parts = explode('/', $currentURL);
$lastPart = end($parts);

$result_product = $pdo->prepare("SELECT * FROM product WHERE id = ? ORDER BY id LIMIT 1");
$result_product->execute(array($lastPart));
$num_product = $result_product->rowCount();

if ($num_product < 1) {
  header('Location: /products');
}

$id_product;
$images_product_all;
$name_product_this;
$description_product_this;
$category_product_this;
$old_price_product_this;
$new_price_product_this;
$stock_product_this;
$product_store_product;
$product_url;
$date_create_product;

while ($row_product = $result_product->fetch(PDO::FETCH_ASSOC)) {
  extract($row_product);

  $decode_images_product = json_decode($images_product);

  $id_product = $id;
  $images_product_all = $decode_images_product;
  $name_product_this = $name_product;
  $description_product_this = $description_product;
  $category_product_this = $category_product;
  $old_price_product_this = $old_price_product;

  $numberFormattedNew = number_format($new_price_product, 2, ',', '.');
  if ($product_store  == 'yes') {
    $new_price_product_this = " $numberFormattedNew Akz";
  } else {
    $new_price_product_this = " $ $numberFormattedNew";
  }

  $stock_product_this = $stock_product;
  // if($stock_product == 'Out of Stock'){
  //   $stock_product_this = 'Fora de Strock';
  // }else{
  //   $stock_product_this = 'Em Strock';
  // }

  $product_store_product = $product_store;
  $product_url = $link_product;
  $date_create_product = $date_create;
}

?>

<div class="main-content main-content-details single right-sidebar">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-trail breadcrumbs">
          <ul class="trail-items breadcrumb">
            <li class="trail-item trail-begin">
              <a href="/">Home</a>
            </li>
            <li class="trail-item trail-begin">
              <a href="/products">Products</a>
            </li>
            <li class="trail-item">
              <a href="/products/category/<?= $category_product_this ?>"><?= $category_product_this ?> </a>
            </li>
            <li class="trail-item trail-end active"> <?= $name_product_this ?> </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- LEFT -->
      <div class="content-area content-details col-lg-9 col-md-8 col-sm-12 col-xs-12">
        <div class="site-main">
          <div class="details-product">
            <!-- Images Product -->
            <div class="details-thumd">
              <div class="image-preview-container image-thick-box image_preview_container">
                <img id="img_zoom" data-zoom-image="<?= $images_product_all[0] ?>" src="<?= $images_product_all[0] ?>" alt="img" />
                <a href="#" class="btn-zoom open_qv"><i class="fa fa-search" aria-hidden="true"></i></a>
              </div>
              <div class="product-preview image-small product_preview">
                <div id="thumbnails" class="thumbnails_carousel owl-carousel" data-nav="true" data-autoplay="false" data-dots="false" data-loop="false" data-margin="10" data-responsive='{"0":{"items":3},"480":{"items":3},"600":{"items":3},"1000":{"items":3}}'>

                  <?php
                  foreach ($images_product_all as $image_url) :
                    echo "
                      <a href='#' data-image='$image_url' data-zoom-image='$image_url' class='active'>
                        <img src='$image_url' data-large-image='$image_url' alt='img' />
                      </a>
                    ";
                  endforeach;
                  ?>
                </div>
              </div>
            </div>

            <!-- Container Base info -->
            <div class="details-infor">
              <!-- Name products -->
              <h1 class="product-title"> <?= $name_product_this ?> </h1>

              <!-- Stars -->
              <div class="stars-rating">
                <div class="star-rating">
                  <span class="star-5"></span>
                </div>
                <div class="count-star">(7)</div>
              </div>

              <!-- Availability -->
              <div class="availability">
                availability:
                <a href="#"> <?= $stock_product_this ?> </a>
              </div>

              <!-- Price -->
              <div class="price">
                <span> <?= $new_price_product_this ?> </span>
              </div>

              <!-- <div class="product-details-description">
                <span>
                  <img src="assets/images/check-3.svg" alt="check" />
                  30 days easy returns
                </span>
                <br />
                <span>
                  <img src="assets/images/check-3.svg" alt="check" />
                  Order yours before 2.30pm for same day dispatch
                </span>
              </div> -->

              <div class="group-button">

                <!-- Quantity -->
                <div class="quantity-add-to-cart">
                  <?php
                  if ($product_store_product == 'yes') :
                  ?>
                    <div class="quantity">
                      <div class="control">
                        <a class="btn-number qtyminus quantity-minus" href="#">-</a>
                        <input type="text" data-step="1" data-min="0" value="1" title="Qty" class="input-qty qty" size="4" />
                        <a href="#" class="btn-number qtyplus quantity-plus">+</a>
                      </div>
                    </div>
                  <?php
                  endif
                  ?>

                  <?= $product_store_product == 'yes' ? "
                  <button class='single_add_to_cart_button button'>
                    Add to cart
                  </button>
                  " : "
                  <a id='btn_pay_now' href='$product_url' class='single_add_to_cart_button button'>
                    Pay now
                  </a>
                  " ?>

                  <!-- Button Add cart / Pay now -->

                </div>

                <hr />

                <!-- Add to favorites -->
                <div class="yith-wcwl-add-to-wishlist">
                  <div class="yith-wcwl-add-button">
                    <a href="#">Add to Wishlist</a>
                  </div>
                </div>

                <br />

                <!-- Image payment-option -->
                <?php
                if ($product_store_product == 'no') :
                ?>
                  <div class="availability">
                    Guaranteed safe & secure checkout:
                    <br />
                    <img src="/base/assets/payment-option.png" alt="" />
                  </div>
                <?php
                endif
                ?>
              </div>
            </div>
          </div>
          <div class="tab-details-product">
            <!-- Tab -->
            <ul class="tab-link">
              <li class="active">
                <a data-toggle="tab" aria-expanded="true" href="#product-descriptions">Descriptions
                </a>
              </li>
              <li class="">
                <a data-toggle="tab" aria-expanded="true" href="#information">Information
                </a>
              </li>
              <!-- <li class="">
                <a data-toggle="tab" aria-expanded="true" href="#reviews">Reviews (1)</a>
              </li> -->
            </ul>

            <div class="tab-container">
              <!-- Description -->
              <div id="product-descriptions" class="tab-panel active">
                <?= $description_product_this ?>
              </div>

              <!-- Information -->
              <div id="information" class="tab-panel">
                <table class="table table-bordered">
                  <?php

                  $get_characteristics = $pdo->prepare("SELECT * FROM characteristics where id_product=$id_product");
                  $get_characteristics->execute();

                  foreach ($get_characteristics as $characteristic) :
                    echo "
                      <tr>
                        <td>{$characteristic['name_characteristic']}</td>
                        <td>{$characteristic['value_characteristic']}</td>
                      </tr>
                    ";
                  endforeach;
                  ?>
                </table>
              </div>

              <!-- Reviews -->
              <div id="reviews" class="tab-panel">
                <div class="reviews-tab">
                  <div class="comments">
                    <h2 class="reviews-title">
                      1 review for
                      <span>Rolf Round</span>
                    </h2>
                    <ol class="commentlist">
                      <li class="conment">
                        <div class="conment-container">
                          <a href="#" class="avatar">
                            <img src="assets/images/avartar.png" alt="img" />
                          </a>
                          <div class="comment-text">
                            <div class="stars-rating">
                              <div class="star-rating">
                                <span class="star-5"></span>
                              </div>
                              <div class="count-star">(1)</div>
                            </div>
                            <p class="meta">
                              <strong class="author">Cobus Bester</strong>
                              <span>-</span>
                              <span class="time">June 7, 2013</span>
                            </p>
                            <div class="description">
                              <p>
                                Simple and effective design. One of my
                                favorites.
                              </p>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ol>
                  </div>
                  <div class="review_form_wrapper">
                    <div class="review_form">
                      <div class="comment-respond">
                        <span class="comment-reply-title">Add a review </span>
                        <form class="comment-form-review">
                          <p class="comment-notes">
                            <span class="email-notes">Your email address will not be published.</span>
                            Required fields are marked
                            <span class="required">*</span>
                          </p>
                          <div class="comment-form-rating">
                            <label>Your rating</label>
                            <p class="stars">
                              <span>
                                <a class="star-1" href="#"></a>
                                <a class="star-2" href="#"></a>
                                <a class="star-3" href="#"></a>
                                <a class="star-4" href="#"></a>
                                <a class="star-5" href="#"></a>
                              </span>
                            </p>
                          </div>
                          <p class="comment-form-comment">
                            <label>
                              Your review
                              <span class="required">*</span>
                            </label>
                            <textarea title="review" id="comment" name="comment" cols="45" rows="8"></textarea>
                          </p>
                          <p class="comment-form-author">
                            <label>
                              Name
                              <span class="">*</span>
                            </label>
                            <input title="author" id="author" name="author" type="text" value="" />
                          </p>
                          <p class="comment-form-email">
                            <label>
                              Email
                              <span class="">*</span>
                            </label>
                            <input title="email" id="email" name="email" type="email" value="" />
                          </p>
                          <p class="form-submit">
                            <input name="submit" type="submit" id="submit" class="submit" value="Submit" />
                          </p>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div style="clear: left"></div>

          <div class="related products product-grid">
            <h2 class="product-grid-title">You may also like</h2>
            <div class="owl-products owl-slick equal-container nav-center" data-slick='{"autoplay":false, "autoplaySpeed":1000, "arrows":true, "dots":false, "infinite":true, "speed":800, "rows":1}' data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":3}},{"breakpoint":"1200","settings":{"slidesToShow":2}},{"breakpoint":"992","settings":{"slidesToShow":2}},{"breakpoint":"480","settings":{"slidesToShow":1}}]'>

              <?php
              $get_outher_product = $pdo->prepare("SELECT * FROM product WHERE is_new_arrivals = 'no' ORDER BY RAND() LIMIT 6");
              $get_outher_product->execute();

              while ($outher_product = $get_outher_product->fetch(PDO::FETCH_ASSOC)) {

                extract($outher_product);

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

                echo "
                  <div class='product-item style-1'>
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
                                <a href='/products/details/$id'>Add to Wishlist</a>
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
                          <a href='/products/details/$id'>Dainty Bangle</a>
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
                  </div>
                ";
              }
              ?>

            </div>
          </div>
        </div>
      </div>

      <!-- RIGTH -->
      <div class="sidebar sidebar-details col-lg-3 col-md-4 col-sm-12 col-xs-12">
        <div class="wrapper-sidebar">
          <div class="widget widget-categories">
            <h3 class="widgettitle">Categories</h3>
            <ul class="list-categories">
              <?php
              $get_categories = $pdo->prepare("SELECT * FROM category WHERE visibility_category = 'Visible' ORDER BY RAND() LIMIT 16");
              $get_categories->execute();

              while ($category = $get_categories->fetch(PDO::FETCH_ASSOC)) {

                extract($category);

                echo "
                  <li class='tag-cloud-link'>
                    <a href='/products/category/$name_category'>$name_category</a>
                  </li>
                ";
              }
              ?>
            </ul>
          </div>
          <!-- Products -->
          <div class="widget widget-related-products">
            <h3 class="widgettitle">Related Products</h3>
            <div class="slider-related-products owl-slick nav-top-right equal-container" data-slick='{"autoplay":false, "autoplaySpeed":1000, "arrows":true, "dots":false, "infinite":true, "speed":800, "rows":1}' data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":1 }},{"breakpoint":"992","settings":{"slidesToShow":2}}]'>
              <?php
              $get_outher_product = $pdo->prepare("SELECT * FROM product WHERE category_product = :category_product ORDER BY RAND() LIMIT 3");
              $get_outher_product->bindValue(':category_product', $category_product_this);
              $get_outher_product->execute();

              while ($outher_product = $get_outher_product->fetch(PDO::FETCH_ASSOC)) {

                extract($outher_product);

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

                echo "
                  <div class='product-item style-1'>
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
                                <a href='/products/details/$id'>Add to Wishlist</a>
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
                          <a href='/products/details/$id'>Dainty Bangle</a>
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
                  </div>
                ";
              }
              ?>
            </div>
          </div>

          <!-- Testimonials -->
          <!-- <div class="widget widget-testimonials">
            <h3 class="widgettitle">Testimonials</h3>
            <div class="slider-related-products owl-slick nav-top-right"
              data-slick='{"autoplay":false, "autoplaySpeed":1000, "arrows":true, "dots":false, "infinite":true, "speed":800, "rows":1}'
              data-responsive='[{"breakpoint":"991","settings":{"slidesToShow":1 }}]'>
              <div class="testimonials-item">
                <div class="Testimonial-inner">
                  <div class="comment">
                    Donec ligula mauris, posuere sed tincidunt a, facilisis id
                    enim. Class aptent taciti sociosqu ad litora torquent per
                    conubia.
                  </div>
                  <div class="author">
                    <div class="avt">
                      <img src="assets/images/member1.png" alt="img" />
                    </div>
                    <h3 class="name">
                      Adam Smith
                      <span class="position"> CEO/Founder Apple </span>
                    </h3>
                  </div>
                </div>
              </div>
              <div class="testimonials-item">
                <div class="Testimonial-inner">
                  <div class="comment">
                    Donec ligula mauris, posuere sed tincidunt a, facilisis id
                    enim. Class aptent taciti sociosqu ad litora torquent per
                    conubia.
                  </div>
                  <div class="author">
                    <div class="avt">
                      <img src="assets/images/member2.png" alt="img" />
                    </div>
                    <h3 class="name">
                      Tom Milikin
                      <span class="position"> CEO/Founder Apple </span>
                    </h3>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</div>


<script src="<?= BASE_ACTIONS . "/actions_add_vews.js" ?>"></script>