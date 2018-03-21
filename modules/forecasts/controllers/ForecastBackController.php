<?php

namespace app\modules\forecasts\controllers;

use app\components\controllers\BackController;
use app\modules\bookmekers\models\Bookmeker;
use app\modules\forecasts\models\Forecast;
use app\modules\forecasts\models\Matches;
use app\modules\forecasts\models\MatchesKoff;
use app\modules\forecasts\models\search\ForecastSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use function D;

/**
 * ForecastBackController implements the CRUD actions for Forecast model.
 */
class ForecastBackController extends BackController {

    /**
     * Lists all Forecast models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ForecastSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Forecast model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Forecast model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        
        $model = new Forecast();
        $model->user_id = \Yii::$app->user->id;
        $matches = Matches::find()->with('team1')->with('team2')
                        ->where(['status' => Matches::NOT_COMPLETE])
                        ->andWhere(['not', ['team1_id' => null]])
                        ->andWhere(['not', ['team2_id' => null]])
                        ->andWhere(['not',['koff_counter' => 0]])
//                ->andWhere(['>','start_time',time()])
                        ->asArray()->all();



        $bookmekers = Bookmeker::find()->all();


        $matchNameArray = [];
        foreach ($matches as $key => $match) {
            $matchNameArray[$match['id']] = $match['team1']['name'] . ' vs ' . $match['team2']['name'];
        }
        $betsType = $model->generateBetsType();
        $betsArray = [];

        if (Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
            if (!empty($model->match_id) && !empty($model->bets_type)) {
                $betsArray = $model->generateBackBets($model->match_id, $model->bets_type);
                $mathesKoff = Matches::find()->where([Matches::tableName() . '.id' => $model->match_id])
                                ->select(MatchesKoff::tableName() . '.book_id')->joinWith(['matchesKoffs'])->column();
                $bookmekers = Bookmeker::find()->where(['id' => $mathesKoff])->all();
            }
            $bookArray = ArrayHelper::map($bookmekers, 'id', 'gametournament_alias');
            return $this->renderPartial('create', [
                        'model' => $model,
                        'matchNameArray' => $matchNameArray,
                        'betsType' => $betsType,
                        'betsArray' => $betsArray,
                        'bookArray' => $bookArray
            ]);
        }

        $bookArray = ArrayHelper::map($bookmekers, 'id', 'gametournament_alias');
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->user_choice = Yii::$app->request->post('Forecast')['user_choice'];
            $model->saveForecast();
            return $this->redirect(['/forecasts/forecast-back/index']);
        }
        
        return $this->render('create', [
                    'model' => $model,
                    'matchNameArray' => $matchNameArray,
                    'betsType' => $betsType,
                    'betsArray' => $betsArray,
                    'bookArray' => $bookArray
        ]);
        
    }

    /**
     * Updates an existing Forecast model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->user_id = \Yii::$app->user->id;
        $matches = Matches::find()->with('team1')->with('team2')
                        ->where(['status' => Matches::NOT_COMPLETE])
                        ->andWhere(['not', ['team1_id' => null]])
                        ->andWhere(['not', ['team2_id' => null]])
                        ->andWhere(['not', ['koff_counter' => 0]])
//                ->andWhere(['>','start_time',time()])
                        ->asArray()->all();


        $bookmekers = Bookmeker::find()->all();


        $matchNameArray = [];
        foreach ($matches as $key => $match) {
            $matchNameArray[$match['id']] = $match['team1']['name'] . ' vs ' . $match['team2']['name'];
        }
        
        $betsType = $model->generateBetsType();
        $betsArray = $model->generateBackBets($model->match_id, $model->bets_type);
        if (Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
            if (!empty($model->match_id) && !empty($model->bets_type)) {
                $betsArray = $model->generateBackBets($model->match_id, $model->bets_type);
                $mathesKoff = Matches::find()->where([Matches::tableName() . '.id' => $model->match_id])
                                ->select(MatchesKoff::tableName() . '.book_id')->joinWith(['matchesKoffs'])->column();
                $bookmekers = Bookmeker::find()->where(['id' => $mathesKoff])->all();
            }
            $bookArray = ArrayHelper::map($bookmekers, 'id', 'gametournament_alias');
            return $this->renderPartial('create', [
                        'model' => $model,
                        'matchNameArray' => $matchNameArray,
                        'betsType' => $betsType,
                        'betsArray' => $betsArray,
                        'bookArray' => $bookArray
            ]);
        }

        $bookArray = ArrayHelper::map($bookmekers, 'id', 'gametournament_alias');
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->user_choice = Yii::$app->request->post('Forecast')['user_choice'];
            $model->saveForecast();
        }
        
        return $this->render('update', [
                    'model' => $model,
                    'matchNameArray' => $matchNameArray,
                    'betsType' => $betsType,
                    'betsArray' => $betsArray,
                    'bookArray' => $bookArray
        ]);

    }

    /**
     * Deletes an existing Forecast model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Forecast model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Forecast the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Forecast::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
