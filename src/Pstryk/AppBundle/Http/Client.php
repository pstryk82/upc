<?php

namespace Pstryk\AppBundle\Http;

use GuzzleHttp\Cookie\CookieJar;
use Symfony\Component\HttpFoundation\Response;

class Client {
    
    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient;
    
    /**
     * @var array
     */
    private $modemOptions;
    
    /**
     * @var CookieJar
     */
    private $cookieJar;
    
    public function __construct(\GuzzleHttp\Client $httpClient, array $modemOptions) {
        $this->httpClient = $httpClient;
        $this->modemOptions = $modemOptions;
        $this->cookieJar = new CookieJar();
    }

    /**
     * @return bool
     */
    public function authorize() {
        $csrfToken = $this->getCSRFToken();
        $body = sprintf(
            'CSRFValue=%s&loginUsername=%s&loginPassword=%s&logoffUser=%s',
            $csrfToken,
            $this->modemOptions['username'],
            $this->modemOptions['password'],
            '0'
        );
        $response = $this->httpClient->request(
            'POST',
            $this->modemOptions['url'] . $this->modemOptions['auth_check'],
            array(
                'body' => $body,
                'connect_timeout' => 3,
                'timeout' => 10,
                'headers' => array(
                    'Referer' => $this->modemOptions['url'] . $this->modemOptions['login_form'],
                    'Origin' => $this->modemOptions['url'],
                    'Content-Length' => strlen($body),
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Cookie' => 'name=Session',
                    'Host' => '192.168.0.1',
                    'User-Agent' => $this->modemOptions['user_agent'],
                    'Connection' => 'keep-alive',
                ),
                'cookies' => $this->cookieJar,
            )
        );
        
        return $response->getStatusCode() == Response::HTTP_OK;
    }
    
    /**
     * @return string
     */
    private function getCSRFToken() {
        $response = $this->httpClient->request(
            'GET',
            $this->modemOptions['url'] . $this->modemOptions['login_form'],
            array(
                'headers' => array(
                    'User-Agent' => $this->modemOptions['user_agent'],
                    'Connection' => 'keep-alive',
                ),
                'cookies' => $this->cookieJar,
            )
        );
        $loginFormHtml = $response->getBody()->getContents();
        preg_match('#name="CSRFValue" value=(\d+)>#', $loginFormHtml, $matches);
        
        return $matches[1];
    }

    /**
     * @return string
     */
    public function fetchDownstreamData() {
        $response = $this->httpClient->get(
            $this->modemOptions['url'] . $this->modemOptions['data_url'],
            array(
                'cookies' => $this->cookieJar,
            )
        );

        return $response->getBody()->getContents();
    }
    
    /**
     * @return bool
     */
    public function unauthorize() {
        $response = $this->httpClient->get(
            $this->modemOptions['url'] . $this->modemOptions['logout_url'],
            array(
                'cookies' => $this->cookieJar
            )
        );
        
        return $response->getStatusCode() == Response::HTTP_OK;
    }
}
