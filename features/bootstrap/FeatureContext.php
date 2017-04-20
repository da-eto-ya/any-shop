<?php

use AppBundle\Entity\Product;
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
     * @Given /^I have product "([^"]*)" on shop$/
     * @param string $title
     */
    public function iHaveProductOnShop(string $title)
    {
        $product = new Product();
        $product->setTitle($title);
        $em = $this->getEntityManager();
        $em->persist($product);
        $em->flush($product);
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
}
