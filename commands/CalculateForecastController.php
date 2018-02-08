<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\commands;

use app\modules\forecasts\models\Forecast;
use app\modules\forecasts\models\Matches;
use Exception;
use Yii;
use yii\console\Controller;
use yii\web\HttpException;

/**
 * Description of CalculateForecastController
 *
 * @author developer
 */
class CalculateForecastController extends Controller{
    
    public function actionIndex(){
        $matches = Matches::find()->where(['status' => Matches::COMPLETE])->all();
        if (!empty($matches)) {

            foreach ($matches as $ma => $match) {

                $forecasts = Forecast::find()->where(['match_id' => $match->id])->andWhere(['status' => Forecast::STATUS_NOT_COUNTED])->all();

                if (!empty($forecasts)) {
                    $transaction = Yii::$app->db->beginTransaction();

                    try {

                        foreach ($forecasts as $fc => $forecast) {
                            if ($forecast->bets_type == Forecast::BETS_TYPE_SCORE) {
                                if ($forecast->team1 == $match->team1_result && $forecast->team2 == $match->team2_result) {
                                    $forecast->status = Forecast::STATUS_COMPLETE_SUCCESS;
                                } else {
                                    $forecast->status = Forecast::STATUS_COMPLETE_FAIL;
                                }
                            } else if ($forecast->bets_type == Forecast::BETS_TYPE_WIN_LOSE) {
                                if ($forecast->team1 > $forecast->team2 && $match->team1_result > $match->team2_result) {
                                    $forecast->status = Forecast::STATUS_COMPLETE_SUCCESS;
                                } else if ($forecast->team1 < $forecast->team2 && $match->team1_result < $match->team2_result) {
                                    $forecast->status = Forecast::STATUS_COMPLETE_SUCCESS;
                                } else if ($forecast->team1 == $forecast->team2 && $match->team1_result == $match->team2_result) {
                                    $forecast->status = Forecast::STATUS_COMPLETE_SUCCESS;
                                } else {
                                    $forecast->status = Forecast::STATUS_COMPLETE_FAIL;
                                }
                            }
                            if (!$forecast->save()) {
                                throw new HttpException();
                            }
                        }

                        $match->status = Matches::COMPLETE_AND_COUNTED;
                        if (!$match->save()) {
                            throw new HttpException();
                        }

                        $transaction->commit();
                    } catch (Exception $exc) {
                        $transaction->rollBack();
                    }
                }
            }
        }
    }
    
}
