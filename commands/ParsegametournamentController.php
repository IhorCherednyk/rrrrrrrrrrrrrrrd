<?php

namespace app\commands;

use yii\console\Controller;
use app\helpers\ImageHelper;
use app\modules\bookmekers\models\Bookmeker;
use app\modules\forecasts\models\Matches;
use app\modules\forecasts\models\MatchesKoff;
use app\modules\forecasts\models\TeamAlias;
use app\modules\team\models\Teams;
use darkdrim\simplehtmldom\SimpleHTMLDom;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use app\modules\forecasts\models\Tournaments;


class ParsegametournamentController extends Controller{
       /**
     * Renders the index view for the module
     * @return string
     */
    public $dotaUrl = 'http://game-tournaments.com';
    public $userAgent = 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0';
    public $matchGlobalArray = [];

    public function getAfterTwoDateTime() {
        return time() + (24 * 60 * 60);
    }
    
    public function init() {
        Yii::setAlias('@webroot', dirname(__DIR__) . '/web');
        parent::init(); // TODO: Change the autogenerated stub
    }
    public function actionIndex() {
        
        
        $dotaPage = $this->curlInit($this->dotaUrl . '/dota-2');
        
//        $html = SimpleHTMLDom::str_get_html($dotaPage);
//        $file = fopen('match.html', 'w');
//        fwrite($file,$dotaPage);
//        fclose($file);
//        $html = SimpleHTMLDom::file_get_html('http://www.dota-prognoz.web/match.html');
        
        if ($dotaPage) {
            $html = SimpleHTMLDom::str_get_html($dotaPage);
            if ($html) {
                
                $this->generateMatchArray($html);
                
                if (!empty($this->matchGlobalArray)) {
                    $this->referToArrayLink();
                    $this->identifyTeamInMatchArray();
                    
                    $this->saveMatches();
                    
                }else{
                    Yii::warning(__CLASS__ . '$this->matchGlobalArray is empty', 'gametournament');
                }
            } else {
                Yii::warning(__CLASS__ . 'SimpleHTMLDom dont create HTML', 'gametournament');
            }
        }
        
        
    }

    function curlInit($url) {
        sleep(30);
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
            Yii::warning(__METHOD__ . 'gametournament curl init exeption','gametournament');
            throw new Exception(__METHOD__);
        }
    }

    function generateMatchArray($html) {

        $table = $html->find('#block_matches_current .matches', 0);
        $time = $this->getAfterTwoDateTime();
        
        if (!empty($table)) {
            foreach ($table->find('tr') as $key => $row) {
                $id = (int) $row->rel;
                try {

                    if (empty($row->class) && (int) $row->find('td', 2)->children(1)->children(0)->time <= $time && is_null(Matches::findOne(['gametournament_id' => $id]))) {
                        
                        // Match Id in gametournament
                        $this->matchGlobalArray[$key]['gametournament_id'] = $id;


                        //All information about Teams
                        $this->matchGlobalArray[$key]['team1_id'] = null;
                        $this->matchGlobalArray[$key]['team2_id'] = null;


                        //Tournament data
                        $tourneyNamae = $row->find('td', 3)->children(0)->title;
                        $tourneyImage = $row->find('td', 3)->children(0)->children(0)->children(0)->src;
                        //Create or get Id by Tournament
                        $this->matchGlobalArray[$key]['tournament_id'] = $this->generateTournamentData($tourneyNamae, $tourneyImage);
                        // Match start time
                        $this->matchGlobalArray[$key]['start_time'] = (int) $row->find('td', 2)->children(1)->children(0)->time;


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
                    Yii::warning($exc->getMessage(),'gametournament');
                    continue;
                }
            }
        }
    }

    function generateTournamentData($name, $img) {
        if ($name && $img) {
            $tournament = Tournaments::getIdByName($name);

            if (is_null($tournament)) {
                $newTournament = new Tournaments();
                $newTournament->name = $name;
                $newTournament->img = $this->saveTeamImage($this->dotaUrl . $this->clearImgPath($img));
                if ($newTournament->save()) {
                    return $newTournament->id;
                } else {
                    return null;
                }
            } else {
                return $tournament->id;
            }
        } else {
            return null;
        }
    }

    function referToArrayLink() {

        $link = &$this->matchGlobalArray;

        foreach ($link as $key => $match) {

            $singleDotaPage = $this->curlInit($this->dotaUrl . $match['link_for_bets']);

            if($singleDotaPage){

                $html = SimpleHTMLDom::str_get_html($singleDotaPage);

                if($html){

                    $data = $this->getDataFromSinglePage($html);

                    if(!empty($data)){
                        $this->matchGlobalArray[$key]['team1']['name_team'] = $data['name1'];
                        $this->matchGlobalArray[$key]['team1']['team_img'] = $data['team1_img'];
                        $this->matchGlobalArray[$key]['team2']['name_team'] = $data['name2'];
                        $this->matchGlobalArray[$key]['team2']['team_img'] = $data['team2_img']; 
                        if (!empty($data['bets'])){
                            $this->matchGlobalArray[$key]['bets'] = $data['bets'];
                        }
                    }else{
                       Yii::warning(__METHOD__ . 'Dont find data in single page for ','gametournament'); 
                    }
                }else{
                    Yii::warning(__METHOD__ . 'Dont create HTML for single page','gametournament');
                }

            }else{
                Yii::warning(__METHOD__ . 'Dont init curl in single page','gametournament');
            }

        }
        
    }

    function getDataFromSinglePage($html) {
        
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

    // Save or Create Team by Match Array end get Team id
    function identifyTeamInMatchArray() {
        
        $link = &$this->matchGlobalArray;
        
        foreach ($link as $key => $match) {
            $this->matchGlobalArray[$key]['team1_id'] = $this->setOrSaveTeam($match['team1']);
            $this->matchGlobalArray[$key]['team2_id'] = $this->setOrSaveTeam($match['team2']);
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
                $ta->search_alias = strtolower(preg_replace("/[^a-zA-ZА-Яа-я0-9]/", "", $teamData['name_team_alias']));
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
                $teamAlias->search_alias = strtolower(preg_replace("/[^a-zA-ZА-Яа-я0-9]/", "", $teamData['name_team_alias']));
                $teamAlias->save();
                return $team->id;
            }
        }

        return null;
    }

    function saveMatches() {
        foreach ($this->matchGlobalArray as $key => $value) {
            if (!empty($value['bets'])) {
                $value['koff_counter'] = count($value['bets']);
            }
            
            $match = new Matches();
            if ($match->load($value, '') && $match->save()) {
                if (!empty($value['bets'])) {
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
                            }else{
                                Yii::warning(__METHOD__ . 'Bookmeker dont`t saved','gametournament');
                            }
                        }
                    }
                }
            }else{
                Yii::warning(__METHOD__ . 'MAtch dont`t saved','gametournament');
            }
        }
    }

    function saveKofficientForMatch($matchid, $bookid, $data) {
        $koff = new MatchesKoff();
        $koff->match_id = $matchid;
        $koff->book_id = $bookid;
        $koff->team1_koff = (float) $data['team1_koff'];
        $koff->team2_koff = (float) $data['team2_koff'];
        if ($koff->save()) {
            return true;
        }else{
           Yii::warning(__METHOD__  . 'Team dont`t saved','gametournament'); 
        }
    }

    public function saveTeamImage($imgpath = null) {
        return ImageHelper::saveCurlImg($imgpath);
    }

    function clearImgPath($img) {
        return str_replace('_60/', '', $img);
    }
}
