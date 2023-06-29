<?php $this->layout("_theme"); ?>

<div class="main-content main-content-404 right-sidebar">
  <div class="container">
    <div class="row">
      <div class="content-area content-404 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="site-main">
          <section class="error-404 not-found">
            <div class="images">
              <img src="<?= BASE_IMG . "/404.png" ?>" />
            </div>
            <div class="text-404">
              <h1 class="page-title">Error 404 Not Found</h1>
              <p class="page-content">
                We´re sorry but the page you are looking for does nor exist.
                <br />
                You could return to
                <a href="index.html" class="hightlight"> Home page</a>
                or using
                <span class="hightlight toggle-hightlight"> search! </span>
              </p>
              <form role="search" method="get" class="search-form">
                <input type="search" class="search-field" placeholder="Your search here…" />
                <button>Search</button>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</div>