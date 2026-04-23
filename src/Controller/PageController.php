<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Service\Cart\CartHandler;
use App\Service\Cart\CartItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;

final class PageController extends AbstractController
{
   #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository): Response
    {
     $products = $productRepository->findAll();

     return $this->render('page/index.html.twig', [
         'products' => $products
     ]);
    }

    #[Route('/browse_categories', name: 'app_browse_categories')]
    public function categories(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('page/browse_categories.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/category/{id}', name: 'app_products_by_category')]
    public function productByCategory(\App\Entity\Category $category): Response
    {
        return $this->render('page/products_by_category.html.twig', [
            'category' => $category,
            'products' => $category->getProducts()
        ]);
    }

    #[Route('/product/{id}', name: 'app_product_details')]
    public function productDetails(Product $product): Response
    {
        return $this->render('page/product_details.html.twig', [
            'product' => $product
        ]);
    }

    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function add(Product $product, CartHandler $cartHandler, Request $request): Response    {
       $quantity = $request->request->get('quantity', 1);

        $quantity = (int) $quantity;

        $item = new CartItem();
        $item->product = $product;
        $item->price = $product->getPrix();
        $item->quantity = $quantity;

        $cartHandler->addItem($item);

        $this->addFlash('success', 'Produit ajouté au panier !');

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart', name: 'app_cart')]
    public function cart(CartHandler $cartHandler): Response
    {
        $cart = $cartHandler->handle(new \App\Service\Cart\Cart());

        return $this->render('page/cart.html.twig', [
            'cart' => $cart
        ]);
    }
}
