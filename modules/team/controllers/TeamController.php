<?php

namespace app\modules\team\controllers;

use app\components\controllers\FrontControlller;
use app\modules\team\models\Teams;
use darkdrim\simplehtmldom\SimpleHTMLDom;
use Yii;

/**
 * Default controller for the `team` module
 */
class TeamController extends FrontControlller {

    public $rowData = [];
    public $teamData = [];
    public $img;
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
        
       
        
        return $this->render('index', ['teamData' => $this->teamData]);
    }

    public function saveTeams(){
        $teams = new Teams();
        $batchArray = [];
        foreach($this->teamData as $teamSingle){
            
            $team = $teams->findOne(['dotabuff_id' => $teamSingle['dotabuff_id']]);
            if(!is_null($team)){
                unset($teamSingle['id']);
              if($team->load($teamSingle, '')){
                  $team->save();
              }
            }else {
                $batchArray[] = $teamSingle;
            }
            
        }
        
        Yii::$app->db->createCommand()->batchInsert(Teams::tableName(), $teams->attributes(), $batchArray)->execute();
    }
    
    public function generateCurlArray($html) {
        $table = $html->find('#teams-all table', 0);
        
        foreach ($table->find('tr') as $key => $row) {
            if ($key >= 2) {                              
                $flight = array();
                
                $flight['id'] = null;
                $flight['name'] =  substr($row->find('td', 1)->plaintext, 0, -21);
                $flight['second_name'] = null;
                D($row->find('td',0)->find('img',0)->src);
//                $this->teamData[$key]['img'] = $this->saveTeamImage($team[0]['image_path']);
//                $this->teamData[$key]['dotabuff_id'] = $team[0]['dotabuf_id']; 
//                $this->teamData[$key]['dotabuff_link'] = $team[0]['dotabuff_link'];
                $flight['total_place'] = substr($row->find('td', 2)->plaintext, 0, -2);
                $flight['game_count'] = $row->find('td', 3)->plaintext;
                $flight['winrate'] = rtrim($row->find('td', 4)->plaintext,'%');
                D($flight);
                foreach ($row->find('td') as $key2 => $cell) {
                    $teamAttr = array();
                    if ($key2 == 0) {
                        foreach ($cell->find('img') as $attr) {
                            $teamAttr['image_path'] = $attr->src;
                        }
                        foreach ($cell->find('a') as $attr) {
                            $teamAttr['dotabuff_link'] = $attr->href;
                            $teamAttr['dotabuf_id'] = preg_replace('/[^0-9]/', '', $attr->href);
                        }
                        $flight[] = $teamAttr;
                    } else {
                        $flight[] = $cell->plaintext;
                    }
                }
                $this->rowData[] = $flight;
            }
        }
        D($this->rowData);
        $this->generateTeamArray();
    }
    
    public function generateTeamArray(){
        foreach ($this->rowData as $key => $team) {
            $this->teamData[$key]['id'] = null;
            $this->teamData[$key]['name'] = substr($team[1], 0, -21);
            $this->teamData[$key]['second_name'] = null;
            $this->teamData[$key]['img'] = $this->saveTeamImage($team[0]['image_path']);
            $this->teamData[$key]['dotabuff_id'] = $team[0]['dotabuf_id']; 
            $this->teamData[$key]['dotabuff_link'] = $team[0]['dotabuff_link'];
            $this->teamData[$key]['total_place'] = substr($team[2], 0, -2);
            $this->teamData[$key]['game_count'] = $team[3];
            $this->teamData[$key]['winrate'] = rtrim($team[4],'%');
        }
    }
    
    public function saveTeamImage($imgpath = null){
//        $this->img = ImageHelper::saveCurlImg($imgpath);
        return 'bob';
    }
}
