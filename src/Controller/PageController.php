<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Category;
use App\Entity\Product;

final class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig');
    }

    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('page/login.html.twig');
    }

    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('page/profile.html.twig');
    }

    #[Route('/cart', name: 'app_cart')]
    public function cart(): Response
    {
        return $this->render('page/cart.html.twig');
    }

    #[Route('/product/{id}', name: 'app_product_details')]
    public function productDetails(Product $product): Response
    {
        return $this->render('page/product_details.html.twig', [
            'product' => $product
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
    public function productByCategory(Category $category): Response
    {

        return $this->render('page/products_by_category.html.twig', [
            'category' => $category,
            'products' => $category->getProducts()
        ]);
    }
}
