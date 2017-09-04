<?php

namespace app\components\twitch;

/**
 * TwitchTV API SDK for PHP
 *
 * PHP SDK for interacting with the TwitchTV API

 *
 * @author Nikadimas
 */
class Twitch {

    /** @var array */
    private $config = array();

    /** @var TwitchRequest */
    protected $request;

    /**
     * TwitchSDK constructor
     * @param array $config
     * @throws TwitchSDKException
     * @throws \InvalidArgumentException
     */
    public function __construct(array $config = array()) {
        
        //проверка на наличие курла get_loaded_extensions возвращает всех php модулей
        if (!in_array('curl', get_loaded_extensions(), true)) {
            throw new TwitchSDKException('cURL extension is not installed and is required');
        }
        
        // проверяет передали ли мы в конфиге ключи
        if (!array_key_exists('client_id', $config)) {
            throw new \InvalidArgumentException('Missing required Client-ID parameter in config
                @see https://blog.twitch.tv/client-id-required-for-kraken-api-calls-afbb8e95f843');
        }
        
        // Создаем класс и передаем в него id клиента
        $this->request = new TwitchRequest;
        $this->request->setClientId($config['client_id']);
    }

    /**
     * Search live streams
     * @param string $query
     * @param null $limit
     * @param null $offset
     * @param null $hls
     * @return \stdClass
     * @throws TwitchException
     */
    public function streamSearch($game, $limit = null, $offset = null, $hls = null) {
        // Передаем параметры для поиска
        
        //Строим строку запросса и передаем в нее параметры
        $queryString = $this->buildQueryString(array(
            'game' => $game,    // Название игры
            'limit' => $limit, //Максимальное количество возвращаемых объектов, отсортированных по количеству подписчиков. По умолчанию: 25. Максимум: 100.
            'offset' => $offset, //Смещение объекта для разбивки на страницы результатов. По умолчанию: 0.
            'hls' => $hls, // поотоковая передача
//            'language' => 'ru'
        ));
        
        // Возвращаем результат поиска перд этим передавая в него строку с параметрами поиска
        return $this->request->request('streams' . $queryString);
    }
    
    /**
     * Get the specified channel's stream
     * @param $channel
     * @return \stdClass
     * @throws TwitchSDKException
     */
    public function streamGet($channel) {
        return $this->request->request('streams/' . $channel);
    }
    
    /**
     * Get the specified channel's stream
     * @param $channel
     * @return \stdClass
     * @throws TwitchSDKException
     */
 //   public function liveStreamsGet() {
 //       
 //       $queryString = $this->buildQueryString(array(
 //           'channel' => [51435464, 52215959],
//            'channel' => ['a1taoda', 'followkudes'],
//            'channel' => ['A1taOda', 'followKudes'],
 //           'game' => 'Dota 2', // Название игры
//            'language' => 'en'
//            'stream_type' => 'live',
    //        'limit' => 5, //Максимальное количество возвращаемых объектов, отсортированных по количеству подписчиков. По умолчанию: 25. Максимум: 100.
//        ));
//        return $this->request->request('streams/' . $queryString);
//    }

    /**
     * Build query string
     * @param $params
     * @return null|string
     */
    protected function buildQueryString($params) {
        
        $param = [];
        $queryString = null;
        foreach ($params as $key => $value) {
            if (!empty($value)) {
                $param[$key] = $value;
            }
        }
        
        if (count($param) > 0) {
            //http_build_query — Генерирует URL-кодированную строку запроса
            $queryString = '?' . http_build_query($param);
        }
        return $queryString;
    }

}
