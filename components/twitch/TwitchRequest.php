<?php

namespace app\components\twitch;

/**
 * TwitchRequest for TwitchTV API SDK for PHP
 *
 * PHP SDK for interacting with the TwitchTV API
 *
 * @author Nikadimas
 */
class TwitchRequest {
    
    /** @var integer Set connect timeout */
    public $connectTimeout = 30;

    /** @var integer Set timeout default. */
    public $timeout = 30;

    /** @var integer Contains the last HTTP status code returned */
    public $httpCode = 0;

    /** @var array Contains the last HTTP headers returned */
    public $httpInfo = [];

    /** @var array Contains the last Server headers returned */
    public $httpHeader = [];

    /** @var boolean Throw cURL errors */
    public $throwCurlErrors = true;

    /** @var string */
    private $clientId;

    const URL_TWITCH = 'https://api.twitch.tv/kraken/';
    const MIME_TYPE = 'application/vnd.twitchtv.v5+json';

    /**
     * Get Client ID
     * @return string
     */
    public function getClientId() {
        return $this->clientId;
    }

    /**
     * Set CLient ID
     * @param string $clientId
     */
    public function setClientId($clientId) {
        $this->clientId = $clientId;
    }

    /**
     * TwitchAPI request
     * @param string $uri
     * @param string $method
     * @param string $postfields
     * @return \stdClass
     * @throws TwitchException
     */
    public function request($uri, $method = 'GET', $postfields = null) {
        //получаем url для поиска
        // создаем запрос
//        D($uri);
        return $this->generalRequest(self::URL_TWITCH . $uri, $method, $postfields);
    }

    /**
     * TwitchAPI request
     * method used by teamRequest && request methods
     * because there are two different Twitch APIs
     * don't call it directly
     * @param string $uri
     * @param string $method
     * @param string $postfields
     * @return \stdClass
     * @throws TwitchException
     */
    private function generalRequest($uri, $method = 'GET', $postfields = null) {
        $this->httpInfo = [];
        
        //вызываем функцию инициализации curl
        $crl = $this->initCrl($uri, $method, $postfields);
        //получаем результат curl
        $response = curl_exec($crl);
        
        $this->httpCode = curl_getinfo($crl, CURLINFO_HTTP_CODE); // получам статус 

        //Получаем информацию о выполнении курла
        $this->httpInfo = array_merge($this->httpInfo, curl_getinfo($crl));
        
        if (curl_errno($crl) && $this->throwCurlErrors === true) {
            throw new TwitchException(curl_error($crl), curl_errno($crl));
        }
        // закрываем выполнение курла
        curl_close($crl);
        
        //преобразуем json в массив и возвращаем
        return json_decode($response);
    }

    /**
     * Initialize a cURL session
     * @param string $uri
     * @param string $method
     * @param string|null $postfields
     * @return resource
     */
    private function initCrl($uri, $method, $postfields) {
        // устанавливаем хедеры для твича котороые необходимы по умолчанию
        $optHttpHeader = ['Expect:',
            'Accept: ' . self::MIME_TYPE,
            'Client-ID: ' . $this->getClientId()
        ];
        
        // Инициализируем curl
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout); // устанавливаем таймауты для конекта
        curl_setopt($crl, CURLOPT_TIMEOUT, $this->timeout); // устанавливаем таймаут
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true); //для возврата результата передачи в качестве строки из curl_exec() вместо прямого вывода в браузер. 
        curl_setopt($crl, CURLOPT_HEADERFUNCTION, [$this, 'getHeader']); // Вызывает функцию колбек функция которая записывает хедеры в курл
        curl_setopt($crl, CURLOPT_HEADER, false); // Включение заголовков в вывод
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, FALSE); //FALSE для остановки cURL от проверки сертификата узла сети.
        switch ($method) {
            case 'POST':
                curl_setopt($crl, CURLOPT_POST, true);
                break;
            case 'PUT':
                curl_setopt($crl, CURLOPT_CUSTOMREQUEST, 'PUT');
                break;
            case 'DELETE':
                curl_setopt($crl, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }
        
        if ($postfields !== null) {
            curl_setopt($crl, CURLOPT_POSTFIELDS, ltrim($postfields, '?'));
            $optHttpHeader[] = 'Content-Length: ' . strlen($postfields);
        }
        curl_setopt($crl, CURLOPT_HTTPHEADER, $optHttpHeader); // устанавливаем хедеры
        curl_setopt($crl, CURLOPT_URL, $uri); // передаем url
        return $crl;
    }

    /**
     * Get the header info to store
     * @param $ch
     * @param $header
     * @return int
     */
    private function getHeader($ch, $header) {
        
        $i = strpos($header, ':');
        if (!empty($i)) {
            $key = str_replace('-', '_', strtolower(substr($header, 0, $i)));
            $value = trim(substr($header, $i + 2));
            $this->httpHeader[$key] = $value;
        }
        return strlen($header);
    }

}
