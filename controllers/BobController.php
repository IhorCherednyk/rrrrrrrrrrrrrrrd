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
    public $dataGlobalArray = [];
    public $teamsArray = [];
    public $referyArray = [];
    public $referylink = '';
    public $cardsPage = '';
    public $referyPage = 'https://www.championat.com/football/_england/2214/referees.html';
    public $layout = '/mylayout';

    public function generateDataForArray() {
        $this->referylink = 'https://www.championat.com';
        $this->cardsPage = 'https://24scores.org/football/england/premier_league/2017-2018/regular_season/cards/';

        $this->dataGlobalArray = [
                [
                'match' => 'Сток - Манчестер С',
                'refery' => [
                    'name' => 'Мосс'
                ],
            ],
                [
                'match' => 'Борнмут - Тоттенхэм',
                'refery' => [
                    'name' => 'Дин'
                ],
            ],
                [
                'match' => 'Арсенал - Уотфорд',
                'refery' => [
                    'name' => 'Аткинсон'
                ],
            ],
                [
                'match' => 'Челси - Кр. Пэлэс',
                'refery' => [
                    'name' => 'Тeйлор'
                ],
            ],
                [
                'match' => 'Эвертон - Брайтон',
                'refery' => [
                    'name' => 'Ист'
                ],
            ],
                [
                'match' => 'Хаддерсфилд - Суонси',
                'refery' => [
                    'name' => 'Оливер'
                ],
            ],
                [
                'match' => 'Ньюкасл - Саутгемптон',
                'refery' => [
                    'name' => 'Марринер'
                ],
            ],
                [
                'match' => 'Вест Хэм - Бернли',
                'refery' => [
                    'name' => 'Мэйсон'
                ],
            ],
                [
                'match' => 'Вест Бромвич - Лестер',
                'refery' => [
                    'name' => 'Мэдли'
                ],
            ],
                [
                'match' => 'Манчестер Ю - Ливерпуль',
                'refery' => [
                    'name' => 'Поусон'
                ],
            ]
        ];

        foreach ($this->dataGlobalArray as $key => $value) {
            $this->dataGlobalArray[$key]['refery']['refery-link'] = null;
            $this->dataGlobalArray[$key]['refery']['tb35'] = null;
            $this->dataGlobalArray[$key]['refery']['tm35'] = null;
            $this->dataGlobalArray[$key]['refery']['last-3']['tb35'] = null;
            $this->dataGlobalArray[$key]['refery']['last-3']['tm35'] = null;
            $teams = explode('-', $value['match']);
            foreach ($teams as $keyt => $team) {
                $this->dataGlobalArray[$key]['team-' . $keyt]['name'] = trim($team);
                $this->dataGlobalArray[$key]['team-' . $keyt]['alias'] = $this->getAlias(trim($team));
            }
        }
    }

    public function getAlias($name) {
        $arr = [
            'Манчестер С' => 'Манчестер Сити',
            'Манчестер Ю' => 'Манчестер Юнайтед',
            'Ливерпуль' => 'Ливерпуль',
            'Тоттенхэм' => 'Тоттенхэм Хотспур',
            'Челси' => 'Челси',
            'Арсенал' => 'Арсенал',
            'Бернли' => 'Бёрнли',
            'Лестер' => 'Лестер Сити',
            'Эвертон' => 'Эвертон',
            'Борнмут' => 'Борнмут',
            'Уотфорд' => 'Уотфорд',
            'Брайтон' => 'Брайтон энд Хоув Альбион',
            'Ньюкасл' => 'Ньюкасл Юнайтед',
            'Суонси' => 'Суонси Сити',
            'Хаддерсфилд' => 'Хаддерсфилд Таун',
            'Кр. Пэлэс' => 'Кристал Пэлас',
            'Вест Хэм' => 'Вест Хэм Юнайтед',
            'Саутгемптон' => 'Саутгемптон',
            'Сток' => 'Сток Сити',
            'Вест Бромвич' => 'Вест Бромвич Альбион',
        ];

        if (!empty($arr[$name])) {
            return $arr[$name];
        }
        return null;
    }

    public function translit($s) {
        $s = (string) $s; // преобразуем в строковое значение
        $s = strip_tags($s); // убираем HTML-теги
        $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
        $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
        $s = trim($s); // убираем пробелы в начале и конце строки
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
        $s = strtr($s, array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => ''));
        $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
        $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
        return $s; // возвращаем результат
    }

    public function actionStats(){
        return $this->render('stats');
    }
    
    public function actionIndex() {
//        $start = microtime(true);

        $this->generateDataForArray();


        $cardsPage = $this->curlInit($this->cardsPage);

        $data_key = $this->getDataKeyFromHTML($cardsPage);

        $coockie_str = $this->generateCookieStr($cardsPage);

        $footPage = $this->curlInit('https://24scores.org/backend/load_page_data.php?data_key=' . $data_key, $coockie_str);


        $html = SimpleHTMLDom::str_get_html($footPage);

        if ($html) {
            $this->getCardsDataFromPage($html);
        }

        $refPage = $this->curlInit($this->referyPage);
        $refHtml = SimpleHTMLDom::str_get_html($refPage);

        if ($refHtml) {

            $this->getRefferyLinksFromPage($refHtml);
        }

        $this->getDataFromSingleReferyPage();
//        $this->dataGlobalArray = [
//            0 => [
//                'match' => 'Вест Хэм - Сток',
//                'refery' => [
//                    'name' => 'Тейлор',
//                    'refery-link' => 'https://www.championat.com/football/_england/2214/referee/985.html',
//                    'tb35' => 11,
//                    'tm35' => 11,
//                    'last-3' => [
//                        'tb35' => 0,
//                        'tm35' => 3,
//                    ]
//                ],
//                'team-0' => [
//                    'name' => 'Вест Хэм',
//                    'alias' => 'Вест Хэм Юнайтед',
//                    'own' => [
//                        'yc-average' => '2.2',
//                        'yc-average-home' => '2.29',
//                        'yc-average-guests' => '2.12',
//                    ],
//                    'tb35' => [
//                        'yc-average%' => '50',
//                        'yc-average-home%' => '50',
//                        'yc-average-guests%' => '50',
//                    ],
//                    'game' => [
//                        'yc-average' => '3.6',
//                        'yc-average-home' => '3.64',
//                        'yc-average-guests' => '3.56',
//                    ],
//                    'refery' => [
//                        0 => '7',
//                    ],
//                ],
//                'team-1' => [
//                    'name' => 'Сток',
//                    'alias' => 'Сток Сити',
//                    'own' => [
//                        'yc-average' => '1.35',
//                        'yc-average-home' => '1.19',
//                        'yc-average-guests' => '1.53',
//                    ],
//                    'tb35' => [
//                        'yc-average%' => '32',
//                        'yc-average-home%' => '25',
//                        'yc-average-guests%' => '40',
//                    ],
//                    'game' => [
//                        'yc-average' => '2.58',
//                        'yc-average-home' => '2.25',
//                        'yc-average-guests' => '2.93',
//                    ],
//                    'refery' => [
//                        0 => '4',
//                        1 => '6',
//                        2 => '3',
//                        3 => '1',
//                    ]
//                ]
//            ],
//            1 => [
//                'match' => 'Вест Хэм - Сток',
//                'refery' => [
//                    'name' => 'Тейлор',
//                    'refery-link' => 'https://www.championat.com/football/_england/2214/referee/985.html',
//                    'tb35' => 11,
//                    'tm35' => 11,
//                    'last-3' => [
//                        'tb35' => 0,
//                        'tm35' => 3,
//                    ]
//                ],
//                'team-0' => [
//                    'name' => 'Вест Хэм',
//                    'alias' => 'Вест Хэм Юнайтед',
//                    'own' => [
//                        'yc-average' => '2.2',
//                        'yc-average-home' => '2.29',
//                        'yc-average-guests' => '2.12',
//                    ],
//                    'tb35' => [
//                        'yc-average%' => '50',
//                        'yc-average-home%' => '50',
//                        'yc-average-guests%' => '50',
//                    ],
//                    'game' => [
//                        'yc-average' => '3.6',
//                        'yc-average-home' => '3.64',
//                        'yc-average-guests' => '3.56',
//                    ],
//                    'refery' => [
//                        0 => '7',
//                    ],
//                ],
//                'team-1' => [
//                    'name' => 'Сток',
//                    'alias' => 'Сток Сити',
//                    'own' => [
//                        'yc-average' => '1.35',
//                        'yc-average-home' => '1.19',
//                        'yc-average-guests' => '1.53',
//                    ],
//                    'tb35' => [
//                        'yc-average%' => '32',
//                        'yc-average-home%' => '25',
//                        'yc-average-guests%' => '40',
//                    ],
//                    'game' => [
//                        'yc-average' => '2.58',
//                        'yc-average-home' => '2.25',
//                        'yc-average-guests' => '2.93',
//                    ],
//                    'refery' => [
//                        0 => '4',
//                        1 => '6',
//                        2 => '3',
//                        3 => '1',
//                    ]
//                ]
//            ],
//        ];
        return $this->render('index', [
                    'dataGlobalArray' => $this->dataGlobalArray
        ]);
    }

    function generateCookieStr($cardsPage) {
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $cardsPage, $matches);        // get cookie
        $cookies = [];
        foreach ($matches[1] as $item) {
            parse_str($item, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }

        $coockie_str = '';
        foreach ($cookies as $key2 => $cook) {
            $coockie_str .= $key2 . '=' . $cook . ';';
        }
        return $coockie_str;
    }

    function getDataKeyFromHTML($html) {
        preg_match('/data_key" : "(.*)"},/', $html, $matches);
        return empty($matches[1]) ? false : $matches[1];
    }

    function getRefferyLinksFromPage($refHtml) {
        $table = $refHtml->find('.b-table-sortlist', 0);

        foreach ($this->dataGlobalArray as $matchKey => $matches) {

            foreach ($table->find('tr') as $key => $row) {
                if ($key >= 1) {

                    if ($matches['refery']['name'] == $row->children(2)->sortorder && (int) $row->children(5)->text() > 0) {

                        $this->dataGlobalArray[$matchKey]['refery']['refery-link'] = 'https://www.championat.com' . $row->children(2)->children(0)->href;
                    }
                }
            }
        }
    }

    function getDataFromSingleReferyPage() {
        foreach ($this->dataGlobalArray as $matchKey => $matches) {
            if (!empty($matches['refery']['refery-link'])) {
                $linkHtml = $this->curlInit($matches['refery']['refery-link']);
                $html = SimpleHTMLDom::str_get_html($linkHtml);
                $referyTable = $html->find('table', 1);

                $this->dataGlobalArray[$matchKey]['refery']['tb35'] = 0;
                $this->dataGlobalArray[$matchKey]['refery']['tm35'] = 0;
                $this->dataGlobalArray[$matchKey]['refery']['last-3']['tb35'] = 0;
                $this->dataGlobalArray[$matchKey]['refery']['last-3']['tm35'] = 0;

                $step = count($referyTable->find('tr')) - 3;


                foreach ($referyTable->find('tr') as $key => $row) {

                    if ($key >= 1) {

                        if ((int) $row->children(4)->plaintext > 3.5) {
                            $this->dataGlobalArray[$matchKey]['refery']['tb35'] = $this->dataGlobalArray[$matchKey]['refery']['tb35'] + 1;
                        } else {
                            $this->dataGlobalArray[$matchKey]['refery']['tm35'] = $this->dataGlobalArray[$matchKey]['refery']['tm35'] + 1;
                        }


                        $teamsArr = [];
                        $teamsArr[] = $row->children(2)->children(0)->text();
                        $teamsArr[] = $row->children(2)->children(1)->text();

                        foreach ($teamsArr as $key4 => $teams) {

                            if ($matches['team-0']['alias'] == $teams) {
                                $this->dataGlobalArray[$matchKey]['team-0']['refery'][] = $row->children(4)->plaintext;
                            }
                            if ($matches['team-1']['alias'] == $teams) {
                                $this->dataGlobalArray[$matchKey]['team-1']['refery'][] = $row->children(4)->plaintext;
                            }
                        }
                    }
                    if ($key >= $step) {
                        if ((int) $row->children(4)->plaintext > 3.5) {
                            $this->dataGlobalArray[$matchKey]['refery']['last-3']['tb35'] = $this->dataGlobalArray[$matchKey]['refery']['last-3']['tb35'] + 1;
                        } else {
                            $this->dataGlobalArray[$matchKey]['refery']['last-3']['tm35'] = $this->dataGlobalArray[$matchKey]['refery']['last-3']['tm35'] + 1;
                        }
                    }
                }
            }
        }
    }

    function curlInit($url, $coockie_str = false) {
        sleep(1);
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

    function getCardsDataFromPage($html) {
        $table = $html->find('table.t4', 0);
        $total35 = $html->find('div.total3', 0)->find('table', 0);


        foreach ($this->dataGlobalArray as $key => $matches) {

            foreach ($table->find('tr') as $key2 => $row) {
                if ($key2 >= 2) {
                    $i = 0;
                    $team = $row->children(0)->plaintext;

                    if ($team == $matches['team-0']['name']) {
                        $this->dataGlobalArray[$key]['team-0']['own']['yc-average'] = $row->children(3)->plaintext;
                        $this->dataGlobalArray[$key]['team-0']['own']['yc-average-home'] = $row->children(7)->plaintext;
                        $this->dataGlobalArray[$key]['team-0']['own']['yc-average-guests'] = $row->children(11)->plaintext;
                        $i++;
                        continue;
                    } else if ($team == $matches['team-1']['name']) {
                        $this->dataGlobalArray[$key]['team-1']['own']['yc-average'] = $row->children(3)->plaintext;
                        $this->dataGlobalArray[$key]['team-1']['own']['yc-average-home'] = $row->children(7)->plaintext;
                        $this->dataGlobalArray[$key]['team-1']['own']['yc-average-guests'] = $row->children(11)->plaintext;
                        $i++;
                        continue;
                    }
                    if ($i == 2) {
                        break;
                    }
                }
            }

            foreach ($total35->find('tr') as $key3 => $row) {

                if ($key2 >= 2) {
                    $i = 0;
                    $team = $row->children(0)->plaintext;


                    if ($team == $matches['team-0']['name']) {
                        $this->dataGlobalArray[$key]['team-0']['tb35']['yc-average%'] = $row->children(4)->plaintext;
                        $this->dataGlobalArray[$key]['team-0']['tb35']['yc-average-home%'] = $row->children(9)->plaintext;
                        $this->dataGlobalArray[$key]['team-0']['tb35']['yc-average-guests%'] = $row->children(14)->plaintext;

                        $this->dataGlobalArray[$key]['team-0']['game']['yc-average'] = $row->children(1)->plaintext;
                        $this->dataGlobalArray[$key]['team-0']['game']['yc-average-home'] = $row->children(6)->plaintext;
                        $this->dataGlobalArray[$key]['team-0']['game']['yc-average-guests'] = $row->children(11)->plaintext;
                        $i++;
                        continue;
                    } else if ($team == $matches['team-1']['name']) {

                        $this->dataGlobalArray[$key]['team-1']['tb35']['yc-average%'] = $row->children(4)->plaintext;
                        $this->dataGlobalArray[$key]['team-1']['tb35']['yc-average-home%'] = $row->children(9)->plaintext;
                        $this->dataGlobalArray[$key]['team-1']['tb35']['yc-average-guests%'] = $row->children(14)->plaintext;

                        $this->dataGlobalArray[$key]['team-1']['game']['yc-average'] = $row->children(1)->plaintext;
                        $this->dataGlobalArray[$key]['team-1']['game']['yc-average-home'] = $row->children(6)->plaintext;
                        $this->dataGlobalArray[$key]['team-1']['game']['yc-average-guests'] = $row->children(11)->plaintext;
                        $i++;
                        continue;
                    }
                    if ($i == 2) {
                        break;
                    }
                }
            }
        }
    }

}
