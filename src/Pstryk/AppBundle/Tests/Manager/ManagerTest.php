<?php

namespace Pstryk\AppBundle\Tests\Manager;

use Pstryk\AppBundle\Manager\Manager;
use Pstryk\AppBundle\Http;
use Pstryk\AppBundle\Entity\Downstream;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;

class ManagerTest extends \PHPUnit_Framework_TestCase {
    
    /**
     * @var Manager
     */
    private $manager;
    
    /**
     * @var EntityManager | \PHPUnit_Framework_MockObject_MockObject
     */
    private $entityManagerMock;
    
    /**
     * @var Http\Parser | \PHPUnit_Framework_MockObject_MockObject
     */
    private $parserMock;
    
    /**
     * @var Http\Client | \PHPUnit_Framework_MockObject_MockObject
     */
    private $clientMock;
    
    public function setUp() {
        $this->entityManagerMock = $this->getMockBuilder(EntityManager::class)
                ->disableOriginalConstructor()->getMock();
        $this->parserMock = $this->getMockBuilder(Http\Parser::class)->getMock();
        $this->clientMock = $this->getMockBuilder(Http\Client::class)->getMock();
        $this->manager = new Manager($this->entityManagerMock, $this->parserMock, $this->clientMock);
    }
    
    public function tearDown() {
        unset($this->entityManagerMock, $this->parserMock, $this->clientMock, $this->manager);
    }
    
    public function testSave() {
        $downstream = new Downstream();
        $downstream->setChannelId(3)
            ->setFrequency(1500100900)
            ->setSnr(40.2);
        $downstreams = new ArrayCollection();
        $downstreams->add($downstream);
        
        $this->parserMock->method('parse')->willReturn($downstreams);
        $this->entityManagerMock->method('persist')->with($downstream);
        $this->entityManagerMock->method('flush');
    }
}
