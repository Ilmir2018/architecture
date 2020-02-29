<?php

use Controller\MainController;
use Controller\OrderInfoController;
use Controller\OrderCheckoutController;
use Controller\ProductInfoController;
use Controller\ProductListController;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

$routes->add(
    'index',
    new Route('/', ['_controller' => [MainController::class, 'indexAction']])
);

$routes->add(
    'product_list',
    new Route('/product/list', ['_controller' => [ProductListController::class, 'listAction']])
);
$routes->add(
    'product_info',
    new Route('/product/info/{id}', ['_controller' => [ProductInfoController::class, 'infoAction']])
);

$routes->add(
    'order_info',
    new Route('/order/info', ['_controller' => [OrderInfoController::class, 'infoAction']])
);
$routes->add(
    'order_checkout',
    new Route('/order/checkout', ['_controller' => [OrderCheckoutController::class, 'checkoutAction']])
);

$routes->add(
    'user_authentication',
    new Route('/user/authentication', ['_controller' => [\Controller\UserAuthenticationController::class, 'authenticationAction']])
);
$routes->add(
    'logout',
    new Route('/user/logout', ['_controller' => [\Controller\UserLogoutController::class, 'logoutAction']])
);

return $routes;
