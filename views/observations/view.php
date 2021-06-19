<?php

use dosamigos\chartjs\ChartJs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Observations */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Наблюдение', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="observations-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <h2>График</h2>
    <?php

    echo \app\helpers\ChartsHelper::getObservationChart($model->id);

    ?>

</div>
