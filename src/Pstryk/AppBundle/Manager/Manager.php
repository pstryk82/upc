<?php

namespace Pstryk\AppBundle\Manager;

use Pstryk\AppBundle\Http;
use Doctrine\ORM\EntityManager;

class Manager {

    /**
     * @var EntityManager
     */
    private $entityManager;
    
    /**
     * @var Http\Parser
     */
    private $parser;
    
    /**
     * @var Http\Client
     */
    private $client;
    
    public function __construct(EntityManager $entityManager, Http\Parser $parser, Http\Client $client) {
        $this->entityManager = $entityManager;
        $this->parser = $parser;
        $this->client = $client;
    }

    public function getDataFromModem() {
        $this->client->authorize();
        $httpResponse = $this->client->fetchDownstreamData();
        $this->client->unauthorize();
        
        return $httpResponse;
    }

    public function save($httpResponse) {
        $downstreams = $this->parser->parse($httpResponse);
        foreach ($downstreams as $downstream) {
            $this->entityManager->persist($downstream);
        }
        $this->entityManager->flush();
    }
}
