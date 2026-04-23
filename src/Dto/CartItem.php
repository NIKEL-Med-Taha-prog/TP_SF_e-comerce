<?php
namespace App\Dto;

use App\Entity\Product;

class CartItem {
    public function __construct(
        public Product $product,
        public int $quantity = 1
    ) {}
}
