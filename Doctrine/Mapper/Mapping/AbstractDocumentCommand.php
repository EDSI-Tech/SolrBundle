<?php
namespace FS\SolrBundle\Doctrine\Mapper\Mapping;

use FS\SolrBundle\Doctrine\Mapper\MetaInformation;
use Solarium\QueryType\Update\Query\Document\Document;

/**
 * maps the common fields id and document_name
 */
abstract class AbstractDocumentCommand
{

    /**
     * @param MetaInformation $meta
     *
     * @return Document
     */
    public function createDocument(MetaInformation $meta)
    {
        $document = new Document();

        $document->addField('id', $meta->getEntityId());
        $document->addField('document_name_s', $meta->getDocumentName());
        $document->setBoost($meta->getBoost() ?? 0);

        return $document;
    }
}
