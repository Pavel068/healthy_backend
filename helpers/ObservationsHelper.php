<?php

namespace app\helpers;

use app\models\Users;

class ObservationsHelper
{
    public static function getObservation()
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
}