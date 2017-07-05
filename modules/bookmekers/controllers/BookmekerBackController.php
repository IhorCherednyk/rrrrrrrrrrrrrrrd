<?php

namespace app\modules\bookmekers\controllers;

use app\components\controllers\BackController;
use app\modules\bookmekers\models\Bookmeker;
use app\modules\bookmekers\models\search\BookmekerSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\helpers\ImageHelper;

/**
 * BookmekerBackController implements the CRUD actions for Bookmeker model.
 */
class BookmekerBackController extends BackController {

    public function actionIndex() {
        return $this->renderList();
    }

    /**
     * Displays a single Bookmeker model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bookmeker model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Bookmeker();
        if ($model->load(Yii::$app->request->post())) {
            $model->filemedium_img = UploadedFile::getInstance($model, 'filemedium_img');
            $model->filesmall_img = UploadedFile::getInstance($model, 'filesmall_img');

            if ($model->validate()) {
                $model->img_medium = ImageHelper::saveImage($model, 'filemedium_img');
                $model->img_small = ImageHelper::saveImage($model, 'filesmall_img');

                if ($model->save(false)) {
                    return $this->redirect(['index', 'id' => $model->id]);
                } else {
                    return $this->render('create', [
                                'model' => $model,
                    ]);
                }
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Bookmeker model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            $model->filemedium_img = UploadedFile::getInstance($model, 'filemedium_img');
            $model->filesmall_img = UploadedFile::getInstance($model, 'filesmall_img');
            if ($model->validate()) {
                if (!is_null($model->filemedium_img)) {
                    $model->img_medium = ImageHelper::saveImage($model, 'filemedium_img', 'img_medium');
                }
                if (!is_null($model->filesmall_img)) {
                    $model->img_small = ImageHelper::saveImage($model, 'filesmall_img', 'img_small');
                }

                if ($model->save(false)) {
                    return $this->redirect(['index', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                                'model' => $model,
                    ]);
                }
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Bookmeker model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->renderList();
    }

    /**
     * Finds the Bookmeker model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bookmeker the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Bookmeker::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function renderList() {
        $searchModel = new BookmekerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

}
