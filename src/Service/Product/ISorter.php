<?php

declare(strict_types = 1);

namespace Service\Product;


interface ISorter
{
    public function productSort(array  $products): array;
}