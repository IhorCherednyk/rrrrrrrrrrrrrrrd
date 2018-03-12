<?php

namespace app\modules\user\controllers;

use app\components\controllers\FrontControlller;
use app\modules\user\forms\ProfileForm;
use app\modules\user\models\Transactions;
use app\modules\user\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\UploadedFile;

class UserController extends FrontControlller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'actions' => ['index'],
                        'allow' => true,
                    ],
                        [
                        'actions' => ['profile'], // add all actions to take guest to login page
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                        [
                        'actions' => ['refresh-coins'], // add all actions to take guest to login page
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionProfile() {

        $model = new ProfileForm(User::findOne(Yii::$app->user->id));

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if ($model->load(Yii::$app->request->post())) {

                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->validate()) {
                    $model->saveImage(Yii::$app->request->post());
                    return $this->renderPartial('profile', ['model' => $model]);
                }
                return $this->renderPartial('profile', ['model' => $model]);
            }
        } else if ($model->load(Yii::$app->request->post())) {

            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->updateProfile(Yii::$app->request->post())) {
                Yii::$app->session->setFlash('success', 'Профиль обновлен');
            }
        }


        return $this->render('profile', ['model' => $model]);
    }

    public function actionRefreshCoins() {
        if (Yii::$app->request->isAjax) {
                $transactionsCount = Transactions::find()->where(['reciver_coin' => Yii::$app->user->id])->sum('coins');
                if($transactionsCount <= 0){
                    $transaction = new Transactions();
                    $transaction->type = Transactions::TRANSACTION_TYPE_START;
                    $transaction->coins = Transactions::START_AND_REFRESH_COINS;
                    $transaction->reciver_coin = $user->id;
                    $transaction->save();
                    $transactionsCount = $transaction->coins;
                }
             
            Yii::$app->user->identity->coins = $transactionsCount;
            Yii::$app->user->identity->save();
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            return Yii::$app->user->identity->coins;
        }
    }
    
    public function actionAddCoins() {
        if (Yii::$app->request->isAjax) {
            $user = User::findOne(Yii::$app->request->post('userId'));
            if (!empty($user)) {
                $transactions = Transactions::find()->where(['reciver_coin' => $user->id])->sum('coins');
                if ($transactions <= 0) {
                    $transaction = new Transactions();
                    $transaction->type = Transactions::TRANSACTION_TYPE_START;
                    $transaction->coins = Transactions::START_AND_REFRESH_COINS;
                    $transaction->reciver_coin = $user->id;
                    $transaction->save();
                }
                return $transactions;
            }
        }
    }

}
