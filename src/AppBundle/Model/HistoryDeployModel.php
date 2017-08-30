<?php

namespace AppBundle\Model;

use AppBundle\Entity\HistoryDeploy;
use Doctrine\ORM\EntityManager;

/**
 * Class HistoryDeployModel
 * @package AppBundle\Model
 */
class HistoryDeployModel extends AbstractModel
{
    /**
     * HistoryDeployModel constructor.
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(HistoryDeploy::class);
    }
}
