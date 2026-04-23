<?php
namespace App\Service\Cart;

use Symfony\Component\HttpFoundation\RequestStack;

class SessionCart implements CartInterface {
    public function __construct(private RequestStack $requestStack) {}

    private function getSession() {
        return $this->requestStack->getSession();
    }

    public function getCart(string $identifier): Cart {
        return $this->getSession()->get('cart_' . $identifier, new Cart());
    }

    public function add(CartItem $item, Cart $cart): Cart {
        // On vérifie si le produit est déjà là pour augmenter la quantité
        $exists = false;
        foreach ($cart->cartItems as $existingItem) {
            if ($existingItem->product->getId() === $item->product->getId()) {
                $existingItem->quantity += $item->quantity;
                $exists = true;
                break;
            }
        }
        if (!$exists) { $cart->cartItems[] = $item; }

        $this->getSession()->set('cart_default', $cart);
        return $cart;
    }

    public function remove(CartItem $item, Cart $cart): Cart {
        $cart->cartItems = array_filter($cart->cartItems, function($i) use ($item) {
            return $i->product->getId() !== $item->product->getId();
        });
        $this->getSession()->set('cart_default', $cart);
        return $cart;
    }

    public function clearCart(string $identifier): void {
        $this->getSession()->remove('cart_' . $identifier);
    }
}
