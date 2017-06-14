<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Field */

$this->title = Yii::t('app', 'Create Field');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Field'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
