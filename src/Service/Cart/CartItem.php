<?php
namespace App\Service\Cart;

use App\Entity\Product;

class CartItem {
    public ?int $id = null;
    public ?Product $product = null;
    public ?float $price = null;
    public int $quantity = 0;
}
