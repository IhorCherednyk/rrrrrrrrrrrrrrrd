<?php

namespace app\modules\team\controllers;

use app\components\controllers\FrontControlller;
use app\modules\team\models\Teams;
use darkdrim\simplehtmldom\SimpleHTMLDom;
use Yii;
use app\helpers\ImageHelper;

/**
 * Default controller for the `team` module
 */
class TeamController extends FrontControlller {

    public $rowData = [];
    public $img = [];

    /**
     * Renders the index view for the module
     * @return string
     */
    public function behaviors() {
        return parent::behaviors();
    }

    public function actionIndex() {
//        $url = 'https://www.dotabuff.com/esports/teams';
//        $ch = curl_init();  //Инициализация сеанса
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//        curl_setopt($ch, CURLOPT_HEADER, false);
//        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
//        //curl_setopt($ch, CURLOPT_TIMEOUT, 60);
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_REFERER, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0');
//        $str = curl_exec($ch);




        $html = SimpleHTMLDom::file_get_html('http://www.dota-prognoz.web/fail.html');
        $this->generateCurlArray($html);
        $this->saveTeams();


        return $this->render('index', ['teamData' => $this->rowData]);
    }

    public function saveTeams() {
        $teams = new Teams();
        $batchArray = [];
        foreach ($this->rowData as $teamSingle) {
            $team = $teams->findOne(['dotabuff_id' => $teamSingle['dotabuff_id']]);
            if (!is_null($team)) {
                unset($teamSingle['id']);
                unset($teamSingle['img']);
                if ($team->load($teamSingle, '')) {
                    $team->save();
                }
            } else {
                $teamSingle['img'] = $this->saveTeamImage($teamSingle['img']);
                $batchArray[] = $teamSingle;
                
            }
        }

        Yii::$app->db->createCommand()->batchInsert(Teams::tableName(), $teams->attributes(), $batchArray)->execute();
    }

    public function generateCurlArray($html) {
        $table = $html->find('#teams-all table', 0);
        if (!empty($table)) {
            foreach ($table->find('tr') as $key => $row) {
                try {
                    if ($key >= 10) {
                        break;
                    }
                    if ($key >= 2) {
                        $flight = array();
                        $flight['id'] = null;
                        $flight['name'] = substr($row->find('td', 1)->plaintext, 0, -21);
                        $flight['second_name'] = null;
                        $flight['img'] = $row->find('td', 0)->find('img', 0)->src;
                        $flight['dotabuff_id'] = preg_replace('/[^0-9]/', '', $row->find('td', 0)->find('a', 0)->href);
                        $flight['dotabuff_link'] = $row->find('td', 0)->find('a', 0)->href;
                        $flight['total_place'] = substr($row->find('td', 2)->plaintext, 0, -2);
                        $flight['game_count'] = $row->find('td', 3)->plaintext;
                        $flight['winrate'] = rtrim($row->find('td', 4)->plaintext, '%');
                        $this->rowData[] = $flight;
                    }
                } catch (\Exception $exc) {
                    \Yii::error($exc->getMessage());
                }
            }
        }
    }

    public function saveTeamImage($imgpath = null) {
        return ImageHelper::saveCurlImg($imgpath);
    }

}
