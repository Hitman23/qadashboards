<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Form */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Form').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'tool0.name',
                'label' => Yii::t('app', 'Tool')
            ],
        [
                'attribute' => 'field0.name',
                'label' => Yii::t('app', 'Field')
            ],
        'weight',
        'ordering',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerEntry->totalCount){
    $gridColumnEntry = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'subject',
        'subject_id',
        'score',
        [
                'attribute' => 'ref0.name',
                'label' => Yii::t('app', 'Ref')
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEntry,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Entry')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnEntry
    ]);
}
?>
    </div>
</div>
