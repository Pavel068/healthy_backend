<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ObservationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Наблюдения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="observations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить Наблюдение', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            [
                'attribute' => 'doctor_id',
                'value' => function ($model) {
                    return \app\models\Users::find()->where(['id' => $model->doctor_id])->one()->full_name;
                }
            ],
            [
                'attribute' => 'patient_id',
                'value' => function ($model) {
                    return \app\models\Users::find()->where(['id' => $model->patient_id])->one()->full_name;
                }
            ],
            'start_date',
            'end_date',
            'result:ntext',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
