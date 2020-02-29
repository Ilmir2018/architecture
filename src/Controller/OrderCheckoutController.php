<?php


namespace Controller;


use Framework\Render;
use Service\Order\BasketFacade;
use Service\User\Security;

class OrderCheckoutController
{

    use Render;
    /**
     * Оформление заказа
     *
     * @param Request $request
     * @return Response
     */
    public function checkoutAction(Request $request): Response
    {
        $isLogged = (new Security($request->getSession()))->isLogged();
        if (!$isLogged) {
            return $this->redirect('user_authentication');
        }

        (new BasketFacade($request->getSession()))->checkout();

        return $this->render('order/checkout.html.php');
    }

}