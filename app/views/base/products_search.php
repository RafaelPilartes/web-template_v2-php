<?php $this->layout("_theme"); ?>

<?php
//conexao da base de dados//
require 'base/db/config.php';
?>

<div class="main-content main-content-product left-sidebar">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-trail breadcrumbs">
          <ul class="trail-items breadcrumb">
            <li class="trail-item trail-begin">
              <a href="/">Home</a>
            </li>
            <li class="trail-item trail-end active">
              <a href="/products">Products</a>
            </li>
            <li class="trail-item trail-end active">Search</li>
            <li class="trail-item trail-end active" id="searchTerm1">Search</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- Column Rigth -->
      <div class="content-area shop-grid-content no-banner col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="site-main">
          <h3 class="custom_blog_title">Searched for: <span id="searchTerm2"></span></h3>
          <!-- Filter -->
          <div class="shop-top-control">
            <div class="select-item select-form">
              <span class="title">Sort</span>
              <select id="numRegister" title="sort" class="chosen-select">
                <option value="12">12 Products/Page</option>
                <option value="20">20 Products/Page</option>
                <option value="28">28 Products/Page</option>
                <option value="38">38 Products/Page</option>
                <option value="44">44 Products/Page</option>
              </select>
            </div>
            <div class="filter-choice select-form">
              <span class="title">Sort by</span>
              <select title="sort-by" data-placeholder="Price: Low to High" class="chosen-select">
                <option value="1">Price: Low to High</option>
                <option value="2">Sort by popularity</option>
                <option value="3">Sort by average rating</option>
                <option value="4">Sort by newness</option>
                <option value="5">Sort by price: low to high</option>
              </select>
            </div>
          </div>

          <!-- List Products -->
          <ul id="container_products" class="row list-products auto-clear equal-container product-grid">

          </ul>

          <!-- Pagination  -->
          <div class="pagination clearfix style3">
            <div class="nav-link">
              <a href="#" class="page-numbers"><i class="icon fa fa-angle-left" aria-hidden="true"></i></a>
              <a href="#" class="page-numbers">1</a>
              <a href="#" class="page-numbers">2</a>
              <a href="#" class="page-numbers current">3</a>
              <a href="#" class="page-numbers"><i class="icon fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
      </div>

      <!-- Column Left -->
      <div class="sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="wrapper-sidebar shop-sidebar">
          <div class="widget woof_Widget">
            <div class="widget widget-tags">
              <h3 class="widgettitle">Categories</h3>
              <ul class="tagcloud">
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= BASE_ACTIONS . "/actions_product_search.js" ?>"></script>