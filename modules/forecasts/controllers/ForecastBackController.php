<?php

namespace app\modules\forecasts\controllers;

use app\components\controllers\BackController;
use app\modules\forecasts\models\BetsType;
use app\modules\forecasts\models\Forecast;
use app\modules\forecasts\models\Matches;
use app\modules\forecasts\models\search\ForecastSearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * ForecastBackController implements the CRUD actions for Forecast model.
 */
class ForecastBackController extends BackController
{

    /**
     * Lists all Forecast models.
     * @return mixed
     */
    public function actionIndex()
    {
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
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Forecast model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Forecast();
        $matches = Matches::find()->with('team1')->with('team2')
                ->where(['status' => Matches::NOT_COMPLETE])
                ->andWhere(['not', ['team1_id' => null]])
                ->andWhere(['not', ['team2_id' => null]])
//                ->andWhere(['>','start_time',time()])
                ->asArray()->all();
        
        $matchNameArray = [];
        foreach ($matches as $key => $match) {
            $matchNameArray[$match['id']] = $match['team1']['name'] . ' vs ' . $match['team2']['name'];
        }
        $betsType = $model->generateBetsType();
        $betsArray = [];
        
        if (Yii::$app->request->isAjax) {
           $model->load(Yii::$app->request->post());
           
           if(!empty($model->match_id) && !empty($model->bets_type)){
               $betsArray = $model->generateBackBets($model->match_id,$model->bets_type);
           }
          
           return $this->renderPartial('create', [
                'model' => $model,
                'matchNameArray' => $matchNameArray,
                'betsType' => $betsType,
                'betsArray' => $betsArray
            ]);
        }
        
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->user_id = \Yii::$app->user->id;
            $model->status = Forecast::FORECAST_NOT_COUNTED;
            
            return $this->redirect(['view', 'id' => $model->id]);
            
        } else {
            return $this->render('create', [
                'model' => $model,
                'matchNameArray' => $matchNameArray,
                'betsType' => $betsType,
                'betsArray' => $betsArray
            ]);
        }
    }

    /**
     * Updates an existing Forecast model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Forecast model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
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
    protected function findModel($id)
    {
        if (($model = Forecast::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
