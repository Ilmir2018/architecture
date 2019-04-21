<?php

declare(strict_types = 1);

namespace Service\Product;


class Sorter
{
    private $productSorter;

    public function __construct(ISorter $productSorter){
        $this->productSorter = $productSorter;
    }

    public function sort(array $products):array {
        if (!count($products)){
            return $products;
        }
        return $this->productSorter->productSort($products);
    }
}