<?php

namespace app\components\widgets;

use app\components\twitch\Twitch,
    Yii,
    yii\base\Widget;

/**
 * Description of TwitchStreams
 *
 * @author Nikadimas
 */
class TwitchStreamsWidget extends Widget {

    public $clientId = '9tgpkcjb232zi04xqaq0pvlc2zmrjf';

    public function init() {
        parent::init();
    }

    public function run() {
        $twitch = new Twitch([
            'client_id' => $this->clientId
        ]);
        
        $streams = Yii::$app->cache->get('widget.twitch.streams');
        if($streams === false) {
            $streams = $twitch->streamSearch('dota 2', 2);
            Yii::$app->cache->set('widget.twitch.streams', $streams, 60);
        }
        
        if($streams->_total) {
            return $this->render('twitch_streams', ['data' => $streams->streams]);
        }
        return null;
    }

}
