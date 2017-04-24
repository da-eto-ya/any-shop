<?php

namespace AppBundle\Controller;

use AppBundle\Criteria\ProductSearchCriteria;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Type\ProductSearchType;
use AppBundle\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class CatalogueController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Route("/category/{id}", name="category")
     * @Method("GET")
     * @Template
     *
     * @param Category|null $category
     * @param Request       $request
     *
     * @return array|\Symfony\Component\HttpFoundation\Response
     */
    public function categoryAction(?Category $category, Request $request)
    {
        /** @var Form $searchForm */
        $searchForm = $this->createForm(ProductSearchType::class);
        /** @var ProductRepository $productRepository */
        $productRepository = $this->getDoctrine()->getRepository(Product::class);
        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = $this->getDoctrine()->getRepository(Category::class);

        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            /** @var ProductSearchCriteria $criteria */
            $criteria = $searchForm->getData();
            /** @var Product[] $products */
            $products = $productRepository->search($criteria);
        } else {
            /** @var Product[] $products */
            $products = $productRepository->findAll();
        }

        /** @var Category[] $categories */
        $categories = $categoryRepository->findAll();

        return [
            'products'   => $products,
            'category'   => $category,
            'categories' => $categories,
            'form'       => $searchForm->createView(),
        ];
    }

    /**
     * @Route("/product/{id}", name="product", requirements={"id": "\d+"})
     * @Method("GET")
     * @Template
     *
     * @param Product $product
     *
     * @return array|\Symfony\Component\HttpFoundation\Response
     */
    public function productAction(Product $product)
    {
        return ['product' => $product];
    }
}
