<?php $this->layout("_theme"); ?>

<div class="main-content main-content-checkout">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-trail breadcrumbs">
          <ul class="trail-items breadcrumb">
            <li class="trail-item trail-begin">
              <a href="index.html">Home</a>
            </li>
            <li class="trail-item trail-end active">Checkout</li>
          </ul>
        </div>
      </div>
    </div>
    <h3 class="custom_blog_title">Checkout</h3>
    <div class="checkout-wrapp">
      <div class="shipping-address-form-wrapp">
        <div class="shipping-address-form checkout-form">
          <div class="row-col-12 row-col">
            <div class="shipping-address">
              <h3 class="title-form">Shipping Address</h3>
              <p class="form-row form-row-first">
                <label class="text">First name</label>
                <input title="first" type="text" class="input-text" />
              </p>
              <p class="form-row form-row-last">
                <label class="text">Last name</label>
                <input title="last" type="text" class="input-text" />
              </p>
              <p class="form-row forn-row-col forn-row-col-1">
                <label class="text">Country</label>
                <select title="country" data-placeholder="United Kingdom" class="chosen-select" tabindex="1">
                  <option value="United States">United States</option>
                  <option value="United Kingdom">United Kingdom</option>
                  <option value="Afghanistan">Afghanistan</option>
                  <option value="Aland Islands">Aland Islands</option>
                  <option value="Albania">Albania</option>
                  <option value="Algeria">Algeria</option>
                  <option value="American Samoa">American Samoa</option>
                  <option value="Andorra">Andorra</option>
                  <option value="Angola">Angola</option>
                  <option value="Anguilla">Anguilla</option>
                  <option value="Antarctica">Antarctica</option>
                  <option value="Antigua and Barbuda">
                    Antigua and Barbuda
                  </option>
                  <option value="Argentina">Argentina</option>
                  <option value="Armenia">Armenia</option>
                  <option value="Aruba">Aruba</option>
                  <option value="Australia">Australia</option>
                  <option value="Austria">Austria</option>
                  <option value="Azerbaijan">Azerbaijan</option>
                  <option value="Bahamas">Bahamas</option>
                  <option value="Bahrain">Bahrain</option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="Barbados">Barbados</option>
                  <option value="Belarus">Belarus</option>
                  <option value="Belgium">Belgium</option>
                  <option value="Belize">Belize</option>
                  <option value="Benin">Benin</option>
                  <option value="Bermuda">Bermuda</option>
                  <option value="Bhutan">Bhutan</option>
                </select>
              </p>
              <p class="form-row forn-row-col forn-row-col-2">
                <label class="text">State</label>
                <select title="state" data-placeholder="London" class="chosen-select" tabindex="1">
                  <option value="United States">London</option>
                  <option value="United Kingdom">tokyo</option>
                  <option value="Afghanistan">Seoul</option>
                  <option value="Aland Islands">Mexico city</option>
                  <option value="Albania">Mumbai</option>
                  <option value="Algeria">Delhi</option>
                  <option value="American Samoa">New York</option>
                  <option value="Andorra">Jakarta</option>
                  <option value="Angola">Sao Paulo</option>
                  <option value="Anguilla">Osaka</option>
                  <option value="Antarctica">Karachi</option>
                  <option value="Antigua and Barbuda">Matx-cơ-va</option>
                  <option value="Argentina">Toronto</option>
                  <option value="Armenia">Boston</option>
                </select>
              </p>
              <p class="form-row forn-row-col forn-row-col-3">
                <label class="text">City</label>
                <select title="city" data-placeholder="London" class="chosen-select" tabindex="1">
                  <option value="United States">London</option>
                  <option value="United Kingdom">tokyo</option>
                  <option value="Afghanistan">Seoul</option>
                  <option value="Aland Islands">Mexico city</option>
                  <option value="Albania">Mumbai</option>
                  <option value="Algeria">Delhi</option>
                  <option value="American Samoa">New York</option>
                  <option value="Andorra">Jakarta</option>
                  <option value="Angola">Sao Paulo</option>
                  <option value="Anguilla">Osaka</option>
                  <option value="Antarctica">Karachi</option>
                  <option value="Antigua and Barbuda">Matx-cơ-va</option>
                  <option value="Argentina">Toronto</option>
                  <option value="Armenia">Boston</option>
                </select>
              </p>
              <p class="form-row form-row-first">
                <label class="text">Zip code</label>
                <input title="zip" type="text" class="input-text" />
              </p>
              <p class="form-row form-row-last">
                <label class="text">Address</label>
                <input title="address" type="text" class="input-text" />
              </p>
            </div>
          </div>
        </div>
        <div class="button-control">
          <a href="/shoppingCart" class="button btn-back-to-shipping">Back to shipping</a>
          <a href="/checkout/congratulation" class="button button-payment">Checkout</a>
        </div>
      </div>
    </div>
  </div>
</div>