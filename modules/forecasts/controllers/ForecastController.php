<?php

namespace app\modules\forecasts\controllers;

use yii\console\Controller;
use Yii;
use app\helpers\ImageHelper;
use darkdrim\simplehtmldom\SimpleHTMLDom;


/**
 * Default controller for the `forecasts` module
 */
class ForecastController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $dotaUrl = 'http://game-tournaments.com/dota-2';
    public $userAgent = 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0';
    
    public $matchArray = [];
    
    
    public function actionIndex()
    {
//      $dotaPage = $this->curlInit($this->$dotaUrl);
//      $html = SimpleHTMLDom::str_get_html($dotaPage);
//      $this->generateLinksArray($html);        
        
//        $file = fopen('match.html', 'a');
//        fwrite($file, $str);
//        fclose($file);
        $html = SimpleHTMLDom::file_get_html('http://www.dota-prognoz.web/match.html');
        
        $this->generateMatchArray($html);
        
        return $this->render('index');
    }
    
    function curlInit($url){
        $ch = curl_init();  //Инициализация сеанса
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->$userAgent);
        $str = curl_exec($ch);
        curl_close($ch);
        
        return $str;

    }
    
    function generateMatchArray($html){
        $table = $html->find('#block_matches_current .matches', 0);
        if (!empty($table)) {
            foreach ($table->find('tr') as $key => $row) {
                if(empty($row->class)) {
                    $matchArray['id'] = null;
                    $matchArray['id_dt2'] = (int)$row->rel;
                    $matchArray['name_team1'] = $row->find('td', 1)->find('a',0)->children(0)->children(0)->plaintext;
                    $matchArray['name_team2'] = $row->find('td', 1)->find('a',0)->children(2)->children(1)->plaintext;
                    $matchArray['team1_idt2'] = (int)$row->find('td', 1)->find('a',0)->children(0)->children(0)->rel;
                    $matchArray['team2_idt2'] = (int)$row->find('td', 1)->find('a',0)->children(2)->children(1)->rel;
                    $matchArray['start_time'] = (int)$row->find('td', 2)->children(1)->children(0)->time;

                    $matchArray['tournamentInfo']['name'] = null;
                    $matchArray['tournamentInfo']['img'] = null;
                    
                    $matchArray['link_for_bets'] = 'http://www.dota-prognoz.web' . $row->find('td', 1)->find('a',0)->href;

                }
                
//                try {
//                    if ($key >= 2) {
//                        $flight = array();
//                        $flight['id'] = null;
//                        $flight['name'] = substr($row->find('td', 1)->plaintext, 0, -21);
//                        $flight['second_name'] = null;
//                        $flight['img'] = $row->find('td', 0)->find('img', 0)->src;
//                        $flight['dotabuff_id'] = preg_replace('/[^0-9]/', '', $row->find('td', 0)->find('a', 0)->href);
//                        $flight['dotabuff_link'] = $row->find('td', 0)->find('a', 0)->href;
//                        $flight['total_place'] = substr($row->find('td', 2)->plaintext, 0, -2);
//                        $flight['game_count'] = str_replace(',', '', $row->find('td', 3)->plaintext);
//                        $flight['winrate'] = rtrim($row->find('td', 4)->plaintext, '%');
//                        //write main array
//                        $this->rowData[] = $flight;
//                    }
//                } catch (\Exception $exc) {
//                    \Yii::error($exc->getMessage());
//                }
            }
        }
    }
}
