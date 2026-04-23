<?php
namespace App\Service\Cart;

class Cart {
    public ?string $id = null;
    public ?\DateTime $createdAt = null;
    /** @var CartItem[] */
    public array $cartItems = [];

    public function total(): float {
        $total = 0;
        foreach ($this->cartItems as $item) {
            $total += ($item->price * $item->quantity);
        }
        return $total;
    }
}
