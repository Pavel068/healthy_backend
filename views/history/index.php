<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Назначения препаратов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить назначение', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'observation_id',
            [
                'attribute' => 'patient_id',
                'value' => function ($model) {
                    return \app\models\Users::find()->where(['id' => $model->patient_id])->one()->full_name;
                }
            ],
            'drug',
            'drug_meta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
