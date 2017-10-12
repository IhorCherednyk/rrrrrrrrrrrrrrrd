<?php

namespace app\modules\streams\controllers;

use app\components\controllers\FrontControlller;
use app\components\twitch\Twitch;
use Exception;
use Yii;

/**
 * Default controller for the `stream` module
 */
class StreamController extends FrontControlller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public $clientId = '9tgpkcjb232zi04xqaq0pvlc2zmrjf';

    public function actionIndex() {
        $this->view->params['DisableStreamWidget'] = true;


        // Пытаемся получить стримы из кеша
        $streams = Yii::$app->cache->get('twitch.streams');

        // Если в кэше стримов нет то поулчаем новые стримы
        if ($streams === false) {

            try {
                // Создаем экземпляр твича и передаем в него client_id котороый определяем в __construct
                $twitch = new Twitch([
                    'client_id' => $this->clientId
                ]);
                
                // Вызывается метод streamSearch 
                $streams = $twitch->streamSearch('Dota 2', 10);
                
                //$streams = $twitch->liveStreamsGet();
                // Добовляем видео в кэш
                Yii::$app->cache->set('twitch.streams', $streams, 60);
            } catch (Exception $exc) {
                
            }
        }
        if ($streams !== false && $streams->_total) {
            // если стримы нашлись то возвращаем их
            return $this->render('index', ['data' => $streams->streams]);
        }
        
        return $this->render('index', ['data' => []]);
        
    }

    public function actionViewStream($name, $id) {
        $this->view->params['DisableStreamWidget'] = true;

        return $this->render('view-stream', ['name' => $name, 'id' => $id]);
    }

}
