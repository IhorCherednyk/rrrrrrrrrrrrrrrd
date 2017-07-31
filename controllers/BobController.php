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

/**
 * Description of BobController
 *
 * @author Anastasiya
 */

class BobController extends \yii\web\Controller {

    public $layout = '/mylayout';

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
//
//        $file = fopen('fail.html', 'a');
//        // Записать текст
//        fwrite($file, $str);
//        // Закрыть текстовый файл
//        fclose($file);
        $html = SimpleHTMLDom::file_get_html('http://www.dota-prognoz.web/fail.html');
        return $this->render('index', ['html' => $html]);
    }

}
