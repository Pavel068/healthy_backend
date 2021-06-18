<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\History */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Назначения препаратов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="history-view">

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
            'observation_id',
            [
                'attribute' => 'patient_id',
                'value' => function ($model) {
                    return \app\models\Users::find()->where(['id' => $model->patient_id])->one()->full_name;
                }
            ],
            'drug',
            'drug_meta',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
