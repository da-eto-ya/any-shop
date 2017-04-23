<?php

namespace AppBundle\Controller;

use AppBundle\Criteria\ProductSearchCriteria;
use AppBundle\Entity\Product;
use AppBundle\Type\ProductSearchType;
use AppBundle\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class CatalogueController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homepageAction(Request $request)
    {
        /** @var Form $searchForm */
        $searchForm = $this->createForm(ProductSearchType::class);
        /** @var ProductRepository $productRepository */
        $productRepository = $this->getDoctrine()->getRepository(Product::class);

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

        return $this->render(
            'default/index.html.twig',
            [
                'products' => $products,
                'form'     => $searchForm->createView(),
            ]
        );
    }
}
