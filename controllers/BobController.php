<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\setting\helpers\SettingHelper;
use darkdrim\simplehtmldom\SimpleHTMLDom;

/**
 * Description of BobController
 *
 * @author Anastasiya
 */
class BobController extends SiteController {

    public $userAgent = 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0';
    public $dataArray = [];
    public $referylink = 'https://www.championat.com';

    function getDataKeyFromHTML($html) {
        preg_match('/data_key" : "(.*)"},/', $html, $matches);
        return empty($matches[1]) ? false : $matches[1];
    }

    public function actionIndex() {

        $dotaPage = $this->curlInit('https://24scores.org/football/england/premier_league/2017-2018/regular_season/cards/');
        $homeTeam = 'Ньюкасл';
        $guestsTeam = 'Челси';
        $refery = 'Тейлор';




        $data_key = $this->getDataKeyFromHTML($dotaPage);
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $dotaPage, $matches);        // get cookie
        $cookies = [];
        foreach ($matches[1] as $item) {
            parse_str($item, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }

        $coockie_str = '';
        foreach ($cookies as $key2 => $cook) {
            $coockie_str .= $key2 . '=' . $cook . ';';
        }

        $footPage = $this->curlInit('https://24scores.org/backend/load_page_data.php?data_key=' . $data_key, $coockie_str);
        $html = SimpleHTMLDom::str_get_html($footPage);

        if ($html) {

            $this->generateMatchArray($html, $homeTeam, $guestsTeam);
        }


        $referyPage = $this->curlInit('https://www.championat.com/football/_england/2214/referees.html');

        

        $refHtml = SimpleHTMLDom::str_get_html($referyPage);

        if ($refHtml) {

            $this->generateRefferyArray($refHtml,$refery);
        }
    }

    function generateRefferyArray($refHtml,$refery) {

        $table = $refHtml->find('.b-table-sortlist', 0);

        foreach ($table->find('tr') as $key => $row) {
            if ($key >= 1) {

                if ($refery == $row->children(2)->sortorder) {
                    
                    $this->referylink .= $row->children(2)->children(0)->href;
                    D($this->referylink);
                            
                }
            }
        }
    }

    function curlInit($url, $coockie_str = false) {
//        sleep(30);
        $ch = curl_init();  //Инициализация сеанса
        if ($ch) {
            if ($coockie_str) {
                curl_setopt($ch, CURLOPT_COOKIE, $coockie_str);
            }
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HEADER, 1);
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
            Yii::warning(__METHOD__ . 'gametournament curl init exeption', 'gametournament');
            throw new Exception(__METHOD__);
        }
    }

    function generateMatchArray($html, $homeTeam, $guestsTeam) {

        $table = $html->find('table.t4');
        $total35 = $html->find('div.total3', 0)->find('table', 0);

        $key = [];
        foreach ($table as $key => $tbl) {

            if ($key == 0) {

                foreach ($tbl->find('tr') as $key2 => $row) {
                    if ($key2 >= 2) {

                        $team = $row->children(0)->plaintext;

                        if ($team == $homeTeam || $team == $guestsTeam) {

                            $this->dataArray[$team]['game'] = $row->children(1)->plaintext;
                            $this->dataArray[$team]['yellow-card-average'] = $row->children(3)->plaintext;
                            $this->dataArray[$team]['yellow-card-average-home'] = $row->children(7)->plaintext;
                            $this->dataArray[$team]['yellow-card-average-guests'] = $row->children(11)->plaintext;

                            continue;
                        }
                    }
                }
            }
        }

        foreach ($total35->find('tr') as $key3 => $row) {

            if ($key2 >= 2) {

                $team = $row->children(0)->plaintext;

                if ($team == $homeTeam || $team == $guestsTeam) {

                    $this->dataArray[$team]['total35']['yellow-card-average'] = $row->children(4)->plaintext;
                    $this->dataArray[$team]['total35']['yellow-card-average-home'] = $row->children(9)->plaintext;
                    $this->dataArray[$team]['total35']['yellow-card-average-guests'] = $row->children(14)->plaintext;

                    continue;
                }
            }
        }
    }

}
