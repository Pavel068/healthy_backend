<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Observations */

$this->title = 'Добавить Наблюдение';
$this->params['breadcrumbs'][] = ['label' => 'Наблюдения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="observations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
