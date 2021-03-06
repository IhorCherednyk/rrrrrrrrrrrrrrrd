<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use Yii;
use app\helpers\ImageHelper;
use app\modules\team\models\Teams;
use darkdrim\simplehtmldom\SimpleHTMLDom;

/**
 * This command parced dotabuff site and take teams.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ParsedotabuffController extends Controller {

    public $rowData = [];
    public $img = [];
    public $dotaUrl = 'https://www.dotabuff.com/esports/teams';
    public $userAgent = 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0';
    
    
    public function init() {
        Yii::setAlias('@webroot', dirname(__DIR__) . '/web');
        parent::init(); // TODO: Change the autogenerated stub
    }
        //Yii::warning('test message','my_curl');
    public function actionIndex() {
        
        $dotaPage = $this->curlInit($this->dotaUrl);
        
        if($dotaPage){
            $html = SimpleHTMLDom::str_get_html($dotaPage);
            if($html){
                $this->generateCurlArray($html);
                $this->saveTeams();
            }else{
                Yii::warning(__CLASS__ . 'SimpleHTMLDom dont create HTML','dotabuff');
            }
        }
        

    }

    function curlInit($url) {
        $ch = curl_init();  //Инициализация сеанса
        if ($ch) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_REFERER, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
            $str = curl_exec($ch);
            curl_close($ch);

            return $str;
            
        } else {
            Yii::warning(__METHOD__ . 'Dotabuff curl init exeption','dotabuff');
            throw new Exception(__METHOD__);
        }
    }
    
    public function generateCurlArray($html) {
        
        $table = $html->find('#teams-all table', 0);
        
        if (!empty($table)) {
            foreach ($table->find('tr') as $key => $row) {
                try {
                    if ($key >= 2) {
                        $flight = array();
                        $flight['id'] = null;
                        $flight['name'] = substr($row->find('td', 1)->plaintext, 0, -21);
                        $flight['img'] = $row->find('td', 0)->find('img', 0)->src;
                        $flight['dotabuff_id'] = preg_replace('/[^0-9]/', '', $row->find('td', 0)->find('a', 0)->href);
                        $flight['dotabuff_link'] = $row->find('td', 0)->find('a', 0)->href;
                        $flight['total_place'] = substr($row->find('td', 2)->plaintext, 0, -2);
                        $flight['game_count'] = str_replace(',','',$row->find('td', 3)->plaintext);
                        $flight['winrate'] = rtrim($row->find('td', 4)->plaintext, '%');
                        $flight['gametournament_id'] = null;
                        $flight['search_name'] = $this->generateSearchName($flight['name']);
                        //write main array
                        $this->rowData[] = $flight;
                    }
                } catch (\Exception $exc) {
                    \Yii::warning($exc->getMessage(),'dotabuff');
                }
            }
        }else{
            Yii::warning(__METHOD__ . 'Dont find table html','dotabuff');
        }
    }
    
    public function saveTeams() {
        $teams = new Teams();
        $batchArray = [];
        foreach ($this->rowData as $teamSingle) {
            $team = $teams->find()->where(['dotabuff_id' => $teamSingle['dotabuff_id']])
                                  ->orWhere(['name' =>  $teamSingle['name']])->one();
            
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

    
    function generateSearchName($name){
        $st = strtolower(preg_replace("/[^a-zA-ZА-Яа-я0-9]/", "", $name));
        return $st;
    }
    
    public function saveTeamImage($imgpath = null) {
        
        return ImageHelper::saveCurlImg($imgpath);
        
    }

}
