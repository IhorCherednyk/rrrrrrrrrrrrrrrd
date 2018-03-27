<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\LoginForm;
use darkdrim\simplehtmldom\SimpleHTMLDom;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use const YII_ENV_TEST;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'allow' => true,
                        'roles' => ['USER', 'admin', '?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

    public $dataArray = [];

    public function actionStats() {
        $html = SimpleHTMLDom::file_get_html('http://www.dota-prognoz.web/cards.html');
        $this->checkFirstField($html);
        $this->checkSecondField($html);
        $this->checkThirdField($html);
        $this->checkForthField($html);

        $this->countPercent();
        $this->countPercentMain();

        D($this->dataArray);
    }

    public function checkFirstField($html) {
        $table = $html->find('.predxi', 0);
        $team1Step = 2;
        $team2Step = 3;
        $step = 5;
        $dataArray = [];
        $matchStep = 0;
        $this->dataArray['result']['tb35'] = 0;
        $this->dataArray['result']['tm35'] = 0;
        $this->dataArray['result']['from-personal-average'] = [];
        $this->dataArray['games'] = [];

        foreach ($table->find('tr') as $key => $row) {
            if ($key == $team1Step) {
                $team1Step = $team1Step + $step;
                $this->dataArray['games'][$matchStep]['from-personal-average']['team1'] = $row->children(0)->text();
                $this->dataArray['games'][$matchStep]['from-personal-average']['sume'] = $row->children(1)->text();
                $this->dataArray['games'][$matchStep]['from-personal-average']['cards'] = $row->children(11)->text();
                if ($row->children(11)->text() >= 3.5) {
                    $this->dataArray['result']['tb35'] += 1;
                } else {
                    $this->dataArray['result']['tm35'] += 1;
                }
            }
            if ($key == $team2Step) {
                $team2Step = $team2Step + $step;
                $this->dataArray['games'][$matchStep]['from-personal-average']['team2'] = $row->children(0)->text();
                $this->dataArray['games'][$matchStep]['from-personal-average']['sume'] += $row->children(1)->text();

                $matchStep++;
            }
        }


        $confirm = 0;
        $notConfirm = 0;
        foreach ($this->dataArray['games'] as $dataKey => $data) {

            if ($data['from-personal-average']['sume'] <= 3.5 && $data['from-personal-average']['cards'] <= 3.5) {
                $this->dataArray['games'][$dataKey]['from-personal-average']['result'] = '+';
                $this->dataArray['games'][$dataKey]['from-personal-average']['percent'] = '100';
                $confirm++;
            } else if ($data['from-personal-average']['sume'] >= 3.5 && $data['from-personal-average']['cards'] >= 3.5) {
                $this->dataArray['games'][$dataKey]['from-personal-average']['result'] = '+';
                $this->dataArray['games'][$dataKey]['from-personal-average']['percent'] = '100';
                $confirm++;
            } else {
                $notConfirm++;
                $this->dataArray['games'][$dataKey]['from-personal-average']['result'] = '-';
                $this->dataArray['games'][$dataKey]['from-personal-average']['percent'] = '0';
            }
        }

        $this->dataArray['result']['from-personal-average'] = [
            'confirm' => $confirm,
            'notConfirm' => $notConfirm,
            'procent' => $confirm * 100 / ($confirm + $notConfirm)
        ];
    }

    public function checkSecondField($html) {
        $table = $html->find('.predxi', 0);
        $team1Step = 2;
        $team2Step = 3;
        $step = 5;
        $dataArray = [];
        $matchStep = 0;

        $this->dataArray['result']['from-personal-place'] = [];


        foreach ($table->find('tr') as $key => $row) {
            if ($key == $team1Step) {
                $team1Step = $team1Step + $step;

                $this->dataArray['games'][$matchStep]['from-personal-place']['team1'] = $row->children(0)->text();
                $this->dataArray['games'][$matchStep]['from-personal-place']['sume'] = $row->children(2)->text();
                $this->dataArray['games'][$matchStep]['from-personal-place']['cards'] = $row->children(11)->text();
            }
            if ($key == $team2Step) {
                $team2Step = $team2Step + $step;
                $this->dataArray['games'][$matchStep]['from-personal-place']['team2'] = $row->children(0)->text();
                $this->dataArray['games'][$matchStep]['from-personal-place']['sume'] += $row->children(3)->text();

                $matchStep++;
            }
        }


        $confirm = 0;
        $notConfirm = 0;
        foreach ($this->dataArray['games'] as $dataKey => $data) {

            if ($data['from-personal-place']['sume'] <= 3.5 && $data['from-personal-place']['cards'] <= 3.5) {
                $this->dataArray['games'][$dataKey]['from-personal-place']['result'] = '+';
                $this->dataArray['games'][$dataKey]['from-personal-place']['percent'] = '100';
                $confirm++;
            } else if ($data['from-personal-place']['sume'] >= 3.5 && $data['from-personal-place']['cards'] >= 3.5) {
                $this->dataArray['games'][$dataKey]['from-personal-place']['result'] = '+';
                $this->dataArray['games'][$dataKey]['from-personal-place']['percent'] = '100';
                $confirm++;
            } else {
                $notConfirm++;
                $this->dataArray['games'][$dataKey]['from-personal-place']['result'] = '-';
                $this->dataArray['games'][$dataKey]['from-personal-place']['percent'] = '0';
            }
        }

        $this->dataArray['result']['from-personal-place'] = [
            'confirm' => $confirm,
            'notConfirm' => $notConfirm,
            'procent' => $confirm * 100 / ($confirm + $notConfirm)
        ];
    }

    public function checkThirdField($html) {
        $table = $html->find('.predxi', 0);
        $team1Step = 2;
        $team2Step = 3;
        $step = 5;
        $dataArray = [];
        $matchStep = 0;

        $this->dataArray['result']['from-common-average'] = [];


        foreach ($table->find('tr') as $key => $row) {
            if ($key == $team1Step) {
                $team1Step = $team1Step + $step;

                $this->dataArray['games'][$matchStep]['from-common-average']['team1'] = $row->children(0)->text();
                $this->dataArray['games'][$matchStep]['from-common-average']['sume'] = $row->children(4)->text() / 2;
                $this->dataArray['games'][$matchStep]['from-common-average']['cards'] = $row->children(11)->text();
            }
            if ($key == $team2Step) {
                $team2Step = $team2Step + $step;
                $this->dataArray['games'][$matchStep]['from-common-average']['team2'] = $row->children(0)->text();
                $this->dataArray['games'][$matchStep]['from-common-average']['sume'] += $row->children(4)->text() / 2;

                $matchStep++;
            }
        }


        $confirm = 0;
        $notConfirm = 0;
        foreach ($this->dataArray['games'] as $dataKey => $data) {

            if ($data['from-common-average']['sume'] <= 3.5 && $data['from-common-average']['cards'] <= 3.5) {
                $this->dataArray['games'][$dataKey]['from-common-average']['result'] = '+';
                $this->dataArray['games'][$dataKey]['from-common-average']['percent'] = '100';
                $confirm++;
            } else if ($data['from-common-average']['sume'] >= 3.5 && $data['from-common-average']['cards'] >= 3.5) {
                $this->dataArray['games'][$dataKey]['from-common-average']['result'] = '+';
                $this->dataArray['games'][$dataKey]['from-common-average']['percent'] = '100';
                $confirm++;
            } else {
                $notConfirm++;
                $this->dataArray['games'][$dataKey]['from-common-average']['result'] = '-';
                $this->dataArray['games'][$dataKey]['from-common-average']['percent'] = '0';
            }
        }

        $this->dataArray['result']['from-common-average'] = [
            'confirm' => $confirm,
            'notConfirm' => $notConfirm,
            'procent' => $confirm * 100 / ($confirm + $notConfirm)
        ];
    }
    
    public function checkForthField($html) {
        $table = $html->find('.predxi', 0);
        $team1Step = 2;
        $team2Step = 3;
        $step = 5;
        $dataArray = [];
        $matchStep = 0;

        $this->dataArray['result']['from-common-place'] = [];


        foreach ($table->find('tr') as $key => $row) {
            if ($key == $team1Step) {
                $team1Step = $team1Step + $step;

                $this->dataArray['games'][$matchStep]['from-common-place']['team1'] = $row->children(0)->text();
                $this->dataArray['games'][$matchStep]['from-common-place']['sume'] = $row->children(5)->text() / 2;
                $this->dataArray['games'][$matchStep]['from-common-place']['cards'] = $row->children(11)->text();
            }
            if ($key == $team2Step) {
                $team2Step = $team2Step + $step;
                $this->dataArray['games'][$matchStep]['from-common-place']['team2'] = $row->children(0)->text();
                $this->dataArray['games'][$matchStep]['from-common-place']['sume'] += $row->children(6)->text() / 2;

                $matchStep++;
            }
        }


        $confirm = 0;
        $notConfirm = 0;
        foreach ($this->dataArray['games'] as $dataKey => $data) {

            if ($data['from-common-place']['sume'] <= 3.5 && $data['from-common-place']['cards'] <= 3.5) {
                $this->dataArray['games'][$dataKey]['from-common-place']['result'] = '+';
                $this->dataArray['games'][$dataKey]['from-common-place']['percent'] = '100';
                $confirm++;
            } else if ($data['from-common-average']['sume'] >= 3.5 && $data['from-common-average']['cards'] >= 3.5) {
                $this->dataArray['games'][$dataKey]['from-common-place']['result'] = '+';
                $this->dataArray['games'][$dataKey]['from-common-place']['percent'] = '100';
                $confirm++;
            } else {
                $notConfirm++;
                $this->dataArray['games'][$dataKey]['from-common-place']['result'] = '-';
                $this->dataArray['games'][$dataKey]['from-common-place']['percent'] = '0';
            }
        }

        $this->dataArray['result']['from-common-place'] = [
            'confirm' => $confirm,
            'notConfirm' => $notConfirm,
            'procent' => $confirm * 100 / ($confirm + $notConfirm)
        ];
    }

    public function countPercent() {
        foreach ($this->dataArray['games'] as $dataKey => $data) {
            $result = 0;
            foreach ($data as $key => $value) {
                $result += $value['percent'];
            }
            $this->dataArray['games'][$dataKey]['total-%'] = $result / count($data);
        }
    }

    public function countPercentMain() {
        $this->dataArray['result']['total-%']['main']['plus'] = 0;
        $this->dataArray['result']['total-%']['main']['minus'] = 0;

        foreach ($this->dataArray['games'] as $dataKey => $data) {
            if ($data['total-%'] == 100) {
                $this->dataArray['result']['total-%']['main']['plus'] += 1;
            } else if ($data['total-%'] == 0) {
                $this->dataArray['result']['total-%']['main']['minus'] += 1;
            }
        }
        
        $this->dataArray['result']['total-%']['main']['%'] = $this->dataArray['result']['total-%']['main']['plus']*100/($this->dataArray['result']['total-%']['main']['plus'] + $this->dataArray['result']['total-%']['main']['minus']);
    }

}
