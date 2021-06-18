<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PatientsData */

$this->title = 'Добавить данные пациента';
$this->params['breadcrumbs'][] = ['label' => 'Данные пациентов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
