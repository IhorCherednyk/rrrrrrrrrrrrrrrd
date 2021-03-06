<?php

namespace app\modules\team\controllers;

use app\components\controllers\BackController;
use app\modules\team\models\search\TeamsSearch;
use app\modules\team\models\Teams;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\helpers\ImageHelper;
use yii\web\UploadedFile;

/**
 * TeamController implements the CRUD actions for Teams model.
 */
class TeamBackController extends BackController {

    /**
     * Lists all Teams models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TeamsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Teams model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Teams model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Teams();
        if ($model->load(Yii::$app->request->post())) {
            $model->imgfile = UploadedFile::getInstance($model, 'imgfile');

            if ($model->validate()) {
                $model->img = ImageHelper::saveImage($model, 'imgfile');
                
                if ($model->save(false)) {
                    return $this->redirect(['index', 'id' => $model->id]);
                }
            }

        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Teams model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->imgfile = UploadedFile::getInstance($model, 'imgfile');
            if ($model->validate()) {
                if (!is_null($model->imgfile)) {
                    $model->img = ImageHelper::saveImage($model, 'imgfile', 'img');
                }
                if ($model->save(false)) {
                    return $this->redirect(['index', 'id' => $model->id]);
                }
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Teams model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Teams model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teams the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Teams::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
