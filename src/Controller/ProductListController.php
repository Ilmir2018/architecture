<?php


namespace Controller;


use Framework\Render;
use Service\Product\Product;

class ProductListController
{
    use Render;

    /**
     * Список всех продуктов
     *
     * @param Request $request
     *
     * @return Response
     */
    public function listAction(Request $request): Response
    {
        $productList = (new Product())->getAll($request->query->get('sort', ''));

        return $this->render('product/list.html.php', ['productList' => $productList]);
    }

}