<?php

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductImage;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    use KernelDictionary;

    private $schemaUpdated = false;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @BeforeScenario
     */
    public function prepareDataStorages()
    {
        if (!$this->schemaUpdated) {
            $application = new ConsoleApplication($this->getKernel());
            $application->setAutoExit(false);
            $options = [
                'command' => 'doctrine:schema:update',
                '--force' => true,
                '--quiet' => true,
            ];
            $application->run(new ArrayInput($options));
            $this->schemaUpdated = true;
        }

        $purger = new ORMPurger($this->getEntityManager());
        $purger->purge();
    }

    /**
     * @Transform :product
     *
     * @param string $product
     *
     * @return Product
     */
    public function castTitleToProduct(string $product)
    {
        $entity = new Product();
        $entity->setTitle($product);

        return $entity;
    }

    /**
     * @Transform :category
     *
     * @param string $category
     *
     * @return Category
     */
    public function castTitleToCategory(string $category)
    {
        $entity = new Category();
        $entity->setTitle($category);

        return $entity;
    }

    /**
     * @Transform :existingProduct
     *
     * @param string $existingProduct
     *
     * @return Product
     */
    public function castTitleToExistingProduct(string $existingProduct)
    {
        $repository = $this->getEntityManager()->getRepository(Product::class);

        return $repository->findOneBy(['title' => $existingProduct]);
    }

    /**
     * @Transform :imageFromFixture
     *
     * @param string $imageFromFixture
     *
     * @return ProductImage
     */
    public function castFixtureImageToImage(string $imageFromFixture)
    {
        $path = $this->getContainerParameter('web_fixtures_path').'/'.$imageFromFixture;
        $entity = new ProductImage();
        $entity->setPath($path);

        return $entity;
    }

    /**
     * @Given shop sells :product
     *
     * @param Product $product
     */
    public function shopSells(Product $product)
    {
        $em = $this->getEntityManager();
        $em->persist($product);
        $em->flush($product);
    }

    /**
     * @Given product :existingProduct has image :imageFromFixture
     *
     * @param Product $existingProduct
     * @param         $imageFromFixture
     */
    public function theProductHasImage(Product $existingProduct, ProductImage $imageFromFixture)
    {
        $imageFromFixture->setAlt("Image for ".$existingProduct->getTitle());
        $existingProduct->setImage($imageFromFixture);

        $em = $this->getEntityManager();
        $em->persist($imageFromFixture);
        $em->flush();
    }

    /**
     * @Given shop has category :category
     *
     * @param Category $category
     */
    public function shopHasCategory(Category $category)
    {
        $em = $this->getEntityManager();
        $em->persist($category);
        $em->flush($category);
    }

    /**
     * Get default Doctrine entity manager
     *
     * @return EntityManager
     */
    private function getEntityManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

    private function getContainerParameter(string $name)
    {
        return $this->getContainer()->getParameter($name);
    }
}
