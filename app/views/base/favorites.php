<?php $this->layout("_theme"); ?>

<div class="site-content">
  <main class="site-main main-container no-sidebar">
    <div class="container">
      <div class="breadcrumb-trail breadcrumbs">
        <ul class="trail-items breadcrumb">
          <li class="trail-item trail-begin">
            <a href="">
              <span> Home </span>
            </a>
          </li>
          <li class="trail-item trail-end active">
            <span> Shopping Favorites </span>
          </li>
        </ul>
      </div>
      <div class="row">
        <div class="main-content-cart main-content col-sm-12">
          <h3 class="custom_blog_title">Shopping Favorites</h3>
          <div class="page-main-content">
            <div class="shoppingcart-content">
              <form action="shoppingcart.html" class="cart-form">
                <table class="shop_table">
                  <thead>
                    <tr>
                      <th class="product-remove"></th>
                      <th class="product-thumbnail"></th>
                      <th class="product-name"></th>
                      <th class="product-price"></th>
                      <th class="product-quantity"></th>
                      <th class="product-subtotal"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="cart_item">
                      <td class="product-remove">
                        <a href="#" class="remove"></a>
                      </td>
                      <td class="product-thumbnail">
                        <a href="#">
                          <img src="assets/images/cart-item-2.jpg" alt="img" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" />
                        </a>
                      </td>
                      <td class="product-name" data-title="Product">
                        <a href="#" class="title">Mini swing dress</a>
                        <span class="attributes-select attributes-color">Black,</span>
                        <span class="attributes-select attributes-size">XXL</span>
                      </td>

                      <td class="product-price" data-title="Price">
                        <span class="woocommerce-Price-amount amount">
                          <span class="woocommerce-Price-currencySymbol">
                            $
                          </span>
                          45
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>