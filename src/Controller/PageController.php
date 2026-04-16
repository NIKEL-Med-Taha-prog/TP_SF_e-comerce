<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig'
        );
    }
    #[Route('/login', name: 'app_login')]
    public function login():Response
    {
        return $this->render('page/login.html.twig'
    );
    }
    #[Route('/profile',name:'app_profile')]
    public function profile():Response{
        return $this->render('page/profile.html.twig'
    );

    }

    #[Route('/cart',name:'app_cart')]
    public function cart():Response{
        return $this->render('page/cart.html.twig'
    );
    }

    #[Route('/product_details',name:'app_product_details')]
    public function productDetails():Response{
        return $this->render('page/product_details.html.twig'
    );
   }

    #[Route('/browse_categories',name:'app_browse_categories')]
    public function categories():Response{
        return $this->render('page/browse_categories.html.twig'
    );

}
    #[Route('/productByCategory',name:'app_products_by_category')]
    public function productByCategory():Response{
        return $this->render('page/app_product_by_category.html.twig'
    );

}
}
