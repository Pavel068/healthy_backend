<?php

namespace app\controllers\api;

use app\helpers\ObservationsHelper;
use app\models\History;
use Yii;
use yii\data\ActiveDataProvider;

class HistoryController extends RestController
{
    public $modelClass = 'app\models\History';

    public function actionIndex()
    {
        $observation = ObservationsHelper::getObservation();
        $query = History::find()->where(['observation_id' => $observation->id]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->request->get('per_page') ? Yii::$app->request->get('per_page') : 10,
                'page' => Yii::$app->request->get('page') ? (int)Yii::$app->request->get('page') - 1 : 0
            ]
        ]);
    }
}