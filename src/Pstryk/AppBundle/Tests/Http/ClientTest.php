<?php
namespace Pstryk\AppBundle\Tests\Http;

use GuzzleHttp\Client as Client2;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Psr7\Response;
use Pstryk\AppBundle\Http\Client;

class ClientTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var Client
     */
    private $client;
    
    /**
     * @var Client2 | \PHPUint_Framework_MockObject_MockObject
     */
    private $httpClient;
    
    private $modemOptions = array(
        'url' => 'http://192.168.0.1',
        'login_form' => '/',
        'auth_check' => '/check',
        'username'=> 'login',
        'password'=> 'password',
        'user_agent' => 'Mozalia',
    );
    
    public function setUp() {
        $this->httpClient = $this->getMockBuilder(Client2::class)
            ->disableOriginalConstructor()->getMock();
        
        $this->client = new Client($this->httpClient, $this->modemOptions);
    }
    
    public function tearDown() {
        unset($this->httpClient, $this->client);
    }
    
    public function testAuthorize() {
        $csrfTokenHtml = 'name="CSRFValue" value=345353334>';
        $loginFormUrl = $this->modemOptions['url'] . $this->modemOptions['login_form'];
        $responseLoginForm = new Response(200, array(), $csrfTokenHtml);
        $this->httpClient->expects($this->at(0))->method('request')->with(
            'GET',
            $loginFormUrl
        )->willReturn($responseLoginForm);
        
        $authorizationUrl = sprintf('%s%s', $this->modemOptions['url'], $this->modemOptions['auth_check']);
        $response = new Response(
            200,
            array(),
            'some body'
        );

        $this->httpClient->expects($this->at(1))->method('request')
            ->with(
                'POST',
                $authorizationUrl
            )
            ->willReturn($response);
        
        $result = $this->client->authorize();
        
        $this->assertTrue($result);
    }
}
