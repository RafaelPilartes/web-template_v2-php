<?php

function load(string $controller, string $action)
{
  try {
    // se controller existe
    $controllerNamespace = "app\\controllers\\{$controller}";

    if (!class_exists($controllerNamespace)) {
      throw new Exception("O controller {$controller} não existe");
    }

    $controllerInstance = new $controllerNamespace();

    if (!method_exists($controllerInstance, $action)) {
      throw new Exception(
        "O método {$action} não existe no controller {$controller}"
      );
    }

    $controllerInstance->$action((object) $_REQUEST);
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}

$router = [
  "GET" => [
    "/" => fn () => load("BaseController", "home"),
    "/contact" => fn () => load("BaseController", "contact"),
    "/dashboard" => fn () => load("DashboardController", "home"),
    "/dashboard/contact" => fn () => load("DashboardController", "contact"),
    "/404" => fn () => load("BaseController", "notFound"),
  ],
];