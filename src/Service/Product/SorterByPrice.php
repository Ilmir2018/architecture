<?php

declare(strict_types = 1);

namespace Service\Product;


class SorterByPrice implements  ISorter
{
    public function productSort(array $products): array
    {
        $sortFunction = function (Product $a, Product $b){
            if($a->getPrice() === $b->getPrice()){
                return 0;
            }
            return $a->getPrice() < $b->getPrice() ? -1 : 1;
        };
    }
}