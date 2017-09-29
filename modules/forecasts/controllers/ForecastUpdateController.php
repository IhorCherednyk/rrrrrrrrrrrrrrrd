<?php

namespace app\modules\forecasts\controllers;

use app\helpers\ImageHelper;
use app\modules\bookmekers\models\Bookmeker;
use app\modules\forecasts\models\Matches;
use app\modules\forecasts\models\MatchesKoff;
use app\modules\forecasts\models\TeamAlias;
use app\modules\team\models\Teams;
use darkdrim\simplehtmldom\SimpleHTMLDom;
use Yii;
use yii\base\Controller;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use function D;

class ForecastUpdateController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public $dotaUrl = 'http://game-tournaments.com';
    public $userAgent = 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0';
    public $matchGlobalArray = [];

    public function actionIndex() {
        // Get matches by conditions
        $matches = Matches::findUpdateConditions();
        if (!empty($matches)) {
//        $dotaPage = $this->curlInit($this->dotaUrl . '/dota-2');
//        $html = SimpleHTMLDom::str_get_html($dotaPage);

            $html = SimpleHTMLDom::file_get_html('http://www.dota-prognoz.web/match.html');


            if ($html) {
                $this->generateMatchArray($html, $matches);
                if (!empty($this->matchGlobalArray)) {
                    if ($this->referToArrayLink()) {
                        $this->identifyTeamInMatchArray();
                        $this->saveMatches();
                    }
                }
            }
            
        } else {
            return false;
        }
        return $this->render('index');
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
            throw new Exception(__METHOD__);
        }
    }

    function generateMatchArray($html, $matches) {

        $table = $html->find('#block_matches_current .matches', 0);
        
        
        if (!empty($table)) {
            foreach ($table->find('tr') as $key => $row) {
                $id = (int) $row->rel;

                try {
                    if (in_array($id, $matches)) {

                        // Match Id in gametournament
                        $this->matchGlobalArray[$key]['gametournament_id'] = $id;


                        //All information about Teams
                        $this->matchGlobalArray[$key]['team1_id'] = null;
                        $this->matchGlobalArray[$key]['team2_id'] = null;

                        $this->matchGlobalArray[$key]['team1'] = [
                            'name_team_alias' => trim($row->find('td', 1)->find('a', 0)->children(0)->children(0)->plaintext),
                            'name_team' => '',
                            'team_img' => '',
                            'team_idt2' => (int) $row->find('td', 1)->find('a', 0)->children(0)->children(0)->rel,
                        ];
                        $this->matchGlobalArray[$key]['team2'] = [
                            'name_team_alias' => trim($row->find('td', 1)->find('a', 0)->children(2)->children(1)->plaintext),
                            'name_team' => '',
                            'team_img' => '',
                            'team_idt2' => (int) $row->find('td', 1)->find('a', 0)->children(2)->children(1)->rel,
                        ];

                        $this->matchGlobalArray[$key]['link_for_bets'] = $row->find('td', 1)->find('a', 0)->href;
                    }
                } catch (Exception $exc) {
                    Yii::error($exc->getMessage());
                    continue;
                }
            }
        }
    }

    function referToArrayLink() {

        $link = &$this->matchGlobalArray;
        $html = SimpleHTMLDom::file_get_html('http://www.dota-prognoz.web/singlematch.html');

        if (!empty($link)) {
            foreach ($link as $key => $match) {
//                $singleDotaPage = $this->curlInit($this->dotaUrl . $match['link_for_bets']);
//                $html = SimpleHTMLDom::str_get_html($singleDotaPage);
                $data = $this->getDataFromSinglePage($html);
                $this->matchGlobalArray[$key]['team1']['name_team'] = $data['name1'];
                $this->matchGlobalArray[$key]['team1']['team_img'] = $data['team1_img'];
                $this->matchGlobalArray[$key]['team2']['name_team'] = $data['name2'];
                $this->matchGlobalArray[$key]['team2']['team_img'] = $data['team2_img'];
                if (!empty($data['bets'])) {
                    $this->matchGlobalArray[$key]['bets'] = $data['bets'];
                }
            }

            return true;
        } else {
            return false;
        }
    }

    function getDataFromSinglePage($html) {
        if ($html) {
            $singleTeamDataParent = $html->find('.match-info', 0)->children(0);
            $singleBetsDataParent = $html->find('#pastkef', 0);
            $data = [];
            if (!empty($singleTeamDataParent)) {
                $data['name1'] = $singleTeamDataParent->children(0)->find('.mteamname', 0)->children(0)->title;
                $data['team1_img'] = $this->clearImgPath($singleTeamDataParent->children(0)->find('.mteamlogo', 0)->children(0)->src);
                $data['name2'] = $singleTeamDataParent->children(2)->find('.mteamname', 0)->children(0)->title;
                $data['team2_img'] = $this->clearImgPath($singleTeamDataParent->children(2)->find('.mteamlogo', 0)->children(0)->src);
            }
            if (!empty($singleBetsDataParent)) {
                foreach ($singleBetsDataParent->find('.row2') as $key => $row) {
                    if (!empty($row)) {
                        $data['bets'][] = [
                            'name' => split('&', split('=', $row->children(0)->children(0)->href)[1])[0],
                            'team1_koff' => $row->find('.koeftable', 0)->children(0)->children(1)->children(0)->plaintext,
                            'team2_koff' => $row->find('.koeftable', 0)->children(0)->children(1)->children(1)->plaintext,
                            'img_path' => $row->children(0)->children(0)->find('img', 0)->src
                        ];
                    }
                }
            }

            return $data;
        }
        return false;
    }

    // Save or Create Team by Match Array end get Team id
    function identifyTeamInMatchArray() {
        $link = &$this->matchGlobalArray;
        if (!empty($link)) {
            foreach ($link as $key => $match) {
                $this->matchGlobalArray[$key]['team1_id'] = $this->setOrSaveTeam($match['team1']);
                $this->matchGlobalArray[$key]['team2_id'] = $this->setOrSaveTeam($match['team2']);
            }
        }
    }

    function setOrSaveTeam($teamData) {
        $teams = Teams::findByAttributes($teamData['team_idt2'], $teamData['name_team'], $teamData['name_team_alias']);


        //Update Teams and create or Upldate Alias
        if (!is_null($teams)) {

            $teams->gametournament_id = $teamData['team_idt2'];
            $teams->name = $teamData['name_team'];

            $teamsAlias = TeamAlias::find()->where(['team_id' => $teams->id])->andWhere(['alias' => $teamData['name_team_alias']])->one();
            if (is_null($teamsAlias)) {
                $ta = new TeamAlias();
                $ta->team_id = $teams->id;
                $ta->alias = $teamData['name_team_alias'];
                $ta->save();
            }
            if ($teams->save()) {
                return $teams->id;
            }

            //Create Team and Alias    
        } else if (is_null($teams) && $teamData['team_idt2'] != 0) {
            $team = new Teams();
            $team->name = $teamData['name_team'];
            $team->gametournament_id = $teamData['team_idt2'];
            $team->img = $this->saveTeamImage($this->dotaUrl . $this->clearImgPath($teamData['team_img']));
            $team->dotabuff_id = null;
            $team->dotabuff_link = null;
            if ($team->save()) {
                $teamAlias = new TeamAlias();
                $teamAlias->team_id = $team->id;
                $teamAlias->alias = $teamData['name_team_alias'];
                $teamAlias->save();
                return $team->id;
            }
        }

        return null;
    }

    
    
    function saveMatches() {
        foreach ($this->matchGlobalArray as $key => $value) {
            
            if(!empty($value['bets'])){
                $value['koff_counter'] = count($value['bets']);
            }
            
            
            $match = Matches::findByTournamentId($value['gametournament_id']);
            
            if(!is_null($match)){
                if ($match->load($value, '') && $match->save() && !empty($value['bets'])) {
                    
                    if(!empty($value['bets'])){
                        foreach ($value['bets'] as $i => $bet) {
                            $bookmekers = Bookmeker::findByAliasName($bet['name']);

                            if (!is_null($bookmekers)) {
                                $this->saveKofficientForMatch($match['id'], $bookmekers->id, $bet);
                            } else {
                                $bookmeker = new Bookmeker();
                                $bookmeker->gametournament_alias = $bet['name'];
                                $bookmeker->img_medium = $this->saveTeamImage($this->dotaUrl . $bet['img_path']);
                                if ($bookmeker->save()) {
                                    $this->saveKofficientForMatch($match['id'], $bookmeker->id, $bet);
                                }
                            }
                        }
                    }
                    
                }
            }
            
        }
    }

    function saveKofficientForMatch($matchid, $bookid, $data) {
        $koff = MatchesKoff::findForUpdate($matchid,$bookid);
        
        if(is_null($koff)){
            $koff = new MatchesKoff();
        }
        
        $koff->match_id = $matchid;
        $koff->book_id = $bookid;
        $koff->team1_koff = (float) $data['team1_koff'];
        $koff->team2_koff = (float) $data['team2_koff'];
        
        if ($koff->save()) {
            return true;
        }
        
    }

    public function saveTeamImage($imgpath = null) {
        return ImageHelper::saveCurlImg($imgpath);
    }

    function clearImgPath($img) {
        return str_replace('_60/', '', $img);
    }

}
