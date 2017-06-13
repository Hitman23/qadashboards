<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Form */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>
<h2>Evaluation Form</h2>
<div class=row>
  <div class="col-lg-3"><h4>Field Name</h4></div>
  <div class="col-lg-3"><h4>Description</h4></div>
  <div class="col-lg-3"><h4>Weight</h4></div>
  <div class="col-lg-3"><h4>Score</h4></div>
</div>

<?php
foreach($dataset as $data) {
  $category=$data['category_name'];
  ?>
  <?php if($category != $category2 ) { ?>
  <div class=row><h4><?=$category?></h4></div>
  <?php } ?>
  <div class=row>
    <div class="col-lg-3"><?=$data['field_name']?></div>
    <div class="col-lg-3"><?=$data['field_description']?></div>
    <div class="col-lg-3"><?=$data['weight']?></div>
    <div class="col-lg-3"><input type='number' name=d[<?=$data['form_id']?>] /></div>
  </div>
  <?php
  $category2=$data['category_name'];
}
?>
    <div class="form-group">
        <input type='hidden' name ='subject' value='<?=$_REQUEST['subject']?>' />
        <input type='hidden' name ='subject_id' value='<?=$_REQUEST['subject_id']?>' />
        <input type='hidden' name ='ref' value='<?=$_REQUEST['ref']?>' />
        <input type='hidden' name ='ref_id' value='<?=$_REQUEST['ref_id']?>' />
        <?=  Html::submitButton(Yii::t('app', 'Grade'), ['class' => 'pull-right btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
