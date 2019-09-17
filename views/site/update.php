<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Addresses */

$this->title = 'Update Addresses: ' . $model->id;
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="addresses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
