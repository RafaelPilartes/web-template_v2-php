<?php

namespace app\routes;

class Routes
{
  public static function get()
  {
    return [
      "get" => [
        // BASE ROUTES
        "/" => 'BaseController@home',
        "/about" => 'BaseController@about',
        "/contact" => 'BaseController@contact',
        "/favorites" => 'BaseController@favorites',
        "/shoppingCart" => 'BaseController@shoppingCart',

        "/products" => 'BaseController@products',
        "/products/category/.*" => 'BaseController@productsCategory',
        "/products/search/.*" => 'BaseController@productsSearch',
        "/products/details/[0-9]+" => 'BaseController@productsDetails',

        "/checkout" => 'BaseController@checkout',
        "/checkout/shipping_address" => 'BaseController@shippingAddress',
        "/checkout/congratulation" => 'BaseController@congratulation',

        "/blog" => 'BaseController@blog',
        "/blog_details" => 'BaseController@blogDetails',

        "/login" => 'BaseController@login',
        "/register" => 'BaseController@register',

        // ADMIN ROUTES
        "/admin" => 'AdminController@login',
        "/admin/home" => 'AdminController@home',
        "/admin/team" => 'AdminController@team',
        "/admin/customers" => 'AdminController@customers',

        "/admin/orders" => 'AdminController@orders',
        "/admin/orders/details/[0-9]+" => 'AdminController@ordersDetails',

        "/admin/category" => 'AdminController@category',
        "/admin/product" => 'AdminController@product',
        "/admin/messages" => 'AdminController@messages',

      ],
    ];
  }
};