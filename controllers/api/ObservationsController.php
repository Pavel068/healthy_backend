<?php

namespace app\controllers\api;

use app\helpers\ObservationsHelper;
use app\models\ObservationsData;
use app\models\Users;
use yii\web\BadRequestHttpException;

class ObservationsController extends RestController
{
    public $modelClass = 'app\models\ObservationsData';

    public function actionCreate()
    {
        $observation = ObservationsHelper::getObservation();
        $obData = new ObservationsData();
        $obData->load(array_merge(\Yii::$app->request->post(), [
            'observation_id' => $observation->id
        ]), '');

        if ($obData->validate() && $obData->save()) {
            \Yii::$app->response->statusCode = 201;
            return $obData;
        } else {
            throw new BadRequestHttpException();
        }
    }
}