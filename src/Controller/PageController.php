<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Service\Cart\CartHandler;
use App\Service\Cart\CartItem;
use App\Service\Cart\Cart;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(ProductRepository $productRepository): Response
    {
        $allProducts = $productRepository->findAll();

        return $this->render('page/index.html.twig', [
            'products' => $allProducts,
        ]);
    }

    #[Route('/browse_categories', name: 'app_browse_categories')]
    public function listCategories(CategoryRepository $categoryRepository): Response
    {
        $allCategories = $categoryRepository->findAll();

        return $this->render('page/browse_categories.html.twig', [
            'categories' => $allCategories,
        ]);
    }

    #[Route('/category/{id}', name: 'app_products_by_category')]
    public function showProductsByCategory(\App\Entity\Category $category): Response
    {
        $categoryProducts = $category->getProducts();

        return $this->render('page/products_by_category.html.twig', [
            'category' => $category,
            'products' => $categoryProducts,
        ]);
    }

    #[Route('/product/{id}', name: 'app_product_details')]
    public function showProductDetails(Product $product): Response
    {
        return $this->render('page/product_details.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/cart', name: 'app_cart')]
    public function showCart(CartHandler $cartHandler): Response
    {
        $currentCart = $cartHandler->handle(new Cart());

        return $this->render('page/cart.html.twig', [
            'cart' => $currentCart,
        ]);
    }

    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function addToCart(Product $product, CartHandler $cartHandler, Request $request): Response
    {
        $qty = (int) $request->request->get('quantity', 1);

        $cartItem = new CartItem();
        $cartItem->product = $product;
        $cartItem->price = $product->getPrix();
        $cartItem->quantity = $qty;

        $cartHandler->addItem($cartItem);

        $this->addFlash('success', 'Article ajouté au panier avec succès !');

        return $this->redirectToRoute('app_cart');
    }
}