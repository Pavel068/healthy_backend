<?php

namespace app\controllers\api;

use app\models\ObservationsData;
use app\models\Users;
use yii\web\BadRequestHttpException;

class ObservationsController extends RestController
{
    public $modelClass = 'app\models\ObservationsData';

    private function getObservation()
    {
        return Users::find()
            ->select('observations.*')
            ->join('INNER JOIN', 'observations', 'observations.patient_id = users.id')
            ->where([
                'users.id' => \Yii::$app->user->getId(),
                'end_date' => null
            ])
            ->orderBy('observations.id DESC')
            ->one();
    }

    public function actionCreate()
    {
        $observation = $this->getObservation();
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