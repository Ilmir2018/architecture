<?php


namespace Controller;


use Framework\Render;
use Service\User\Security;

class UserLogoutController
{

    use Render;

    /**
     * Выходим из системы
     *
     * @param Request $request
     * @return Response
     */
    public function logoutAction(Request $request): Response
    {
        (new Security($request->getSession()))->logout();

        return $this->redirect('index');
    }

}