<?php

namespace app\modules\streams\controllers;

use yii\web\Controller;
use app\components\twitch\Twitch;
use Yii;

/**
 * Default controller for the `stream` module
 */
class StreamController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $clientId = '9tgpkcjb232zi04xqaq0pvlc2zmrjf';
    
    public function actionIndex()
    {  
        $this->view->params['DisableStreamWidget'] = true;
        
        // Создаем экземпляр твича и передаем в него client_id котороый определяем в __construct
        $twitch = new Twitch([
            'client_id' => $this->clientId
        ]);

        // Пытаемся получить стримы из кеша
        $streams = Yii::$app->cache->get('twitch.streams');

        // Если в кэше стримов нет то поулчаем новые стримы
        if ($streams === false) {
            // Вызывается метод streamSearch 
            $streams = $twitch->streamSearch('Dota 2', 10);
//            $streams = $twitch->liveStreamsGet();
            // Добовляем видео в кэш
            Yii::$app->cache->set('twitch.streams', $streams, 60);
        }

        if ($streams->_total) {
            // если стримы нашлись то возвращаем их
            return $this->render('index', ['data' => $streams->streams]);
        }
        return null;
    }
    
    public function actionViewStream($name,$id){
        $this->view->params['DisableStreamWidget'] = true;
        
        return $this->render('view-stream', ['name' => $name,'id' => $id]);
    }
}