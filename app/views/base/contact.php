<?php $this->layout("_theme"); ?>

<div class="main-content main-content-contact">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-trail breadcrumbs">
          <ul class="trail-items breadcrumb">
            <li class="trail-item trail-begin">
              <a href="/">Home</a>
            </li>
            <li class="trail-item trail-end active">Contact us</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="content-area content-contact col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="site-main">
          <h3 class="custom_blog_title">Contact us</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="page-main-content">
    <div class="google-map">
      <iframe width="100%" height="500" id="gmap_canvas"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3941.8090250199857!2d13.220480096789554!3d-8.897339999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a51f4574bdbdcf1%3A0xb1e062e01456f054!2sIce%20Watch!5e0!3m2!1spt-BR!2sao!4v1687247291251!5m2!1spt-BR!2sao"
        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-contact">
            <div class="col-lg-8 no-padding">
              <div class="form-message">
                <h2 class="title">Send us a Message!</h2>

                <!-- Form -->
                <form id="messageForm" class="cleric-contact-fom">
                  <span id="msgAlertaErroCad"></span>
                  <div class="row">
                    <div class="col-sm-6">
                      <p>
                        <span class="form-label">Your Name *</span>
                        <span class="form-control-wrap your-name">
                          <input title="name_user" type="text" name="name_user" size="40"
                            class="form-control form-control-name" />
                        </span>
                      </p>
                    </div>
                    <div class="col-sm-6">
                      <p>
                        <span class="form-label"> Your Email * </span>
                        <span class="form-control-wrap your-email">
                          <input title="email_user" type="email" name="email_user" size="40"
                            class="form-control form-control-email" />
                        </span>
                      </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <p>
                        <span class="form-label">Phone</span>
                        <span class="form-control-wrap your-phone">
                          <input title="phone_user" type="text" name="phone_user"
                            class="form-control form-control-phone" />
                        </span>
                      </p>
                    </div>
                    <div class="col-sm-6">
                      <p>
                        <span class="form-label"> Company </span>
                        <span class="form-control-wrap your-company">
                          <input title="summary" type="text" name="summary" class="form-control your-company" />
                        </span>
                      </p>
                    </div>
                  </div>
                  <p>
                    <span class="form-label"> Your Message </span>
                    <span class="wpcf7-form-control-wrap your-message">
                      <textarea title="message" name="message" cols="40" rows="9"
                        class="form-control your-textarea"></textarea>
                    </span>
                  </p>
                  <p>
                    <input type="submit" value="SEND MESSAGE" class="form-control-submit button-submit" />
                  </p>
                </form>
              </div>
            </div>
            <div class="col-lg-4 no-padding">
              <div class="form-contact-information">
                <form action="#" class="cleric-contact-info">
                  <h2 class="title">Contact information</h2>
                  <div class="info">
                    <div class="item address">
                      <span class="icon"> </span>
                      <span class="text">
                        FUBU, Chegas no Triângulo do ISPAJ (Projeto nova vida) e pegas uma moto até na Rua da Igreja
                        Cura de Vina.
                        <br />
                        <hr />
                        FUBU, Arrive at the ISPAJ Triangle (New Life Project) and take a motorbike to Rua da Igreja
                        wine cure.
                      </span>
                    </div>
                    <div class="item phone">
                      <span class="icon"> </span>
                      <span class="text"> (+244) 930 878 505 </span>
                    </div>
                    <div class="item email">
                      <span class="icon"> </span>
                      <span class="text"> info@dealsdays-php.com </span>
                    </div>
                  </div>
                  <div class="socials">
                    <a href="#" class="social-item" target="_blank">
                      <span class="icon fa fa-facebook"> </span>
                    </a>
                    <a href="#" class="social-item" target="_blank">
                      <span class="icon fa fa-twitter-square"> </span>
                    </a>
                    <a href="#" class="social-item" target="_blank">
                      <span class="icon fa fa-instagram"> </span>
                    </a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= BASE_ACTIONS . "/actions_message.js" ?>"></script>