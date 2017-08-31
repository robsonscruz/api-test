<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Bundle\FrameworkBundle\Console\Application;

/**
 * Class StructureService
 * @package AppBundle\Service
 */
class StructureService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var KernelInterface
     */
    protected $kernel;

    /**
     * @var Application
     */
    protected $application;

    /**
     *
     */
    const HISTORY_DEPLOY = 'history_deploy';

    /**
     * StructureService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, KernelInterface $kernel)
    {
        $this->entityManager = $entityManager;
        $this->kernel = $kernel;

        $this->application = new Application($this->kernel);
        $this->application->setAutoExit(false);
    }

    /**
     * Check if basic structure exists
     */
    public function createStructure()
    {
        $this->executeCommand(['command' => 'doctrine:database:create', '--if-not-exists' => null]);

        if ($this->entityManager->getConnection()->getSchemaManager()->tablesExist([self::HISTORY_DEPLOY]) == false) {
            $this->executeCommand(['command' => 'doctrine:schema:create']);
        }
    }

    /**
     * @param array $command
     */
    protected function executeCommand(array $command)
    {
        $input = new ArrayInput($command);

        $output = new BufferedOutput();
        $this->application->run($input, $output);

        $output->fetch();
    }
}
