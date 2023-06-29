<?php

namespace app\controllers;

use app\controllers\BaseTemplateController;

class BaseController
{
  public function home()
  {
    return BaseTemplateController::view("home");
  }
  public function about()
  {
    return BaseTemplateController::view("about");
  }
  public function contact()
  {
    return BaseTemplateController::view("contact");
  }
  public function favorites()
  {
    return BaseTemplateController::view("favorites");
  }
  public function shoppingCart()
  {
    return BaseTemplateController::view("shoppingCart");
  }

  // checkout
  public function shippingAddress()
  {
    return BaseTemplateController::view("checkout_shipping_address");
  }
  public function paymentMethod()
  {
    return BaseTemplateController::view("checkout_payment_method");
  }
  public function congratulation()
  {
    return BaseTemplateController::view("checkout_congratulation");
  }

  // products
  public function products()
  {
    return BaseTemplateController::view("products");
  }
  public function productsSearch()
  {
    return BaseTemplateController::view("products_search");
  }
  public function productsCategory()
  {
    return BaseTemplateController::view("products_category");
  }
  public function productsDetails()
  {
    return BaseTemplateController::view("products_details");
  }

  // blog
  public function blog()
  {
    return BaseTemplateController::view("blog");
  }
  public function blogDetails()
  {
    return BaseTemplateController::view("blog_details");
  }

  // Login / Register
  public function login()
  {
    return BaseTemplateController::view("login");
  }
  public function register()
  {
    return BaseTemplateController::view("register");
  }

  // 404
  public function notFound()
  {
    return BaseTemplateController::view("404");
  }
}
