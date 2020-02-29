<?php

declare(strict_types = 1);

namespace Controller;

use Framework\Render;
use Service\Order\Basket;
use Service\Order\BasketFacade;
use Service\User\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderInfoController
{
    use Render;

    /**
     * Корзина
     *
     * @param Request $request
     * @return Response
     */
    public function infoAction(Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            return $this->redirect('order_checkout');
        }

        $productList = (new BasketFacade($request->getSession()))->getProductsInfo();
        $isLogged = (new Security($request->getSession()))->isLogged();

        return $this->render('order/info.html.php', ['productList' => $productList, 'isLogged' => $isLogged]);
    }

}
