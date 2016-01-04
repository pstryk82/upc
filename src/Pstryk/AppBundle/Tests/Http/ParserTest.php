<?php
namespace Pstryk\AppBundle\Tests\Http;

use Pstryk\AppBundle\Http\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var string
     */
    private $content = '';

    public function setUp() {
        $this->parser = new \Pstryk\AppBundle\Http\Parser();
        $this->content = file_get_contents('src/Pstryk/AppBundle/Tests/Fixtures/fixtures.html');
    }
    
    public function tearDown() {
        unset($this->parser, $this->content);
    }

    public function testParse() {
        $downstreams = $this->parser->parse($this->content);
        
        $first = $downstreams->first();
        $this->assertEquals(1, $first->getReceiverNo());
        $this->assertEquals(3, $first->getChannelId());
        $this->assertEquals('TAG_UPC_T38', $first->getLockStatus());
        $this->assertEquals(802000000, $first->getFrequency());
        $this->assertEquals('256QAM', $first->getModulation());
        $this->assertEquals(6952000, $first->getSymbolRate());
        $this->assertEquals(40.3, $first->getSnr());
        $this->assertEquals(0.6, $first->getPower());
    }
}
