<?php
namespace App\Service\Cart;

use Symfony\Component\DependencyInjection\Attribute\Autowire;

class CartHandler {
    public function __construct(
        #[Autowire(service: SessionCart::class)]
        private CartInterface $strategy
    ) {}

    public function handle(Cart $cart): Cart {
        return $this->strategy->getCart('default');
    }

    public function addItem(CartItem $item): void {
        $cart = $this->strategy->getCart('default');
        $this->strategy->add($item, $cart);
    }
}
