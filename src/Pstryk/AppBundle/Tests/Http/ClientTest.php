<?php

namespace Pstryk\AppBundle\Tests\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Psr7\Response;
use Pstryk\AppBundle\Http\Client;

class ClientTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Client
     */
    private $client;

    /**
     * @var \PHPUint_Framework_MockObject_MockObject | GuzzleClient
     */
    private $httpClientMock;
    
    /**
     * @var array
     */
    private $modemOptions = array(
        'url' => 'http://192.168.0.1',
        'login_form' => '/',
        'auth_check' => '/check',
        'username' => 'login',
        'password' => 'password',
        'data_url' => '/where-the-data-comes-from.html',
        'user_agent' => 'Mozalia',
        'logout_url' => '/logout',
    );

    public function setUp() {
        $this->httpClientMock = $this->getMockBuilder(GuzzleClient::class)->disableOriginalConstructor()->getMock();
        $this->client = new Client($this->httpClientMock, $this->modemOptions);
    }

    public function tearDown() {
        unset($this->httpClientMock, $this->client);
    }

    public function testAuthorize() {
        $csrfTokenHtml = 'name="CSRFValue" value=345353334>';
        $loginFormUrl = $this->modemOptions['url'] . $this->modemOptions['login_form'];
        $responseLoginForm = new Response(200, array(), $csrfTokenHtml);
        $this->httpClientMock->expects($this->at(0))->method('request')->with(
            'GET', $loginFormUrl
        )->willReturn($responseLoginForm);

        $authorizationUrl = sprintf('%s%s', $this->modemOptions['url'], $this->modemOptions['auth_check']);
        $response = new Response(
            200, array(), 'some body'
        );

        $this->httpClientMock->expects($this->at(1))->method('request')
            ->with('POST', $authorizationUrl)
            ->willReturn($response);

        $result = $this->client->authorize();

        $this->assertTrue($result);
    }

    public function testFetchDownstreamData() {
        $response = new Response(200, array(), 'some data to parse');
        $this->httpClientMock->expects($this->any())->method('__call')
            ->with('get', [$this->modemOptions['url'] . $this->modemOptions['data_url'], ['cookies' => new CookieJar()]])
            ->willReturn($response);

        $data = $this->client->fetchDownstreamData();
        $this->assertEquals('some data to parse', $data);
    }
    
    public function testUnauthorize() {
        $expectedResponse = new Response(200, array(), 'you have been logged out');
        $this->httpClientMock
            ->method('__call')
            ->with('get', [$this->modemOptions['url'] . $this->modemOptions['logout_url'], ['cookies' => new CookieJar()]])
            ->willReturn($expectedResponse);
        
        $success = $this->client->unauthorize();
        $this->assertTrue($success);
    }
}
