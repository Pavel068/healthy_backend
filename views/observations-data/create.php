<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ObservationsData */

$this->title = 'Добавить Observations Data';
$this->params['breadcrumbs'][] = ['label' => 'Observations Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="observations-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
