<?php

namespace FS\SolrBundle\Doctrine\Hydration;

use FS\SolrBundle\Doctrine\Mapper\MetaInformation;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;

class DoctrineHydrator implements Hydrator
{

    /**
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * @var Hydrator
     */
    private $valueHydrator;

    /**
     * @param RegistryInterface $doctrine
     * @param Hydrator $valueHydrator
     */
    public function __construct(Registry $doctrine, Hydrator $valueHydrator)
    {
        $this->doctrine = $doctrine;
        $this->valueHydrator = $valueHydrator;
    }

    /**
     * @param $document
     * @param MetaInformation $metaInformation
     *
     * @return object
     */
    public function hydrate($document, MetaInformation $metaInformation)
    {
        $entityId = $document->id;
        $doctrineEntity = $this->doctrine
            ->getManager()
            ->getRepository($metaInformation->getClassName())
            ->find($entityId);

        $metaInformation->setEntity($doctrineEntity);

        return $this->valueHydrator->hydrate($document, $metaInformation);
    }
}