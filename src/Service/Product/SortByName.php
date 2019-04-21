<?php

declare(strict_types = 1);

namespace Service\Product;


class SortByName implements ISorter
{
    public function productSort(array $products): array
    {
        $sortFunction = function (Product $a, Product $b){
            return strcmp($a->getName(), $b->getName());
        };

        usort($products, $sortFunction);

        return $products;
    }
}