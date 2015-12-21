<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tour */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tour-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
    if(!$model->isNewRecord):
        foreach($model->tourFields as $field):
            $model->field_names = $field->name;
            $model->field_sorts = $field->sort;
            ?>

            <div class="row">
                <div class="col-sm-8">
                    <?= $form->field($model, 'field_names')?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'field_sorts')->dropDownList(range(1,20), array('required'=>true))?>
                </div>
                <div class="col-sm-1">
                    <label>&nbsp;</label> <br />
                    <button type="button" class="btn btn-danger delete_field"><i class="glyphicon glyphicon-trash"></i></button>
                </div>
            </div>

        <?php endforeach; endif?>

	<div class="form-group">
		<button type="button" class="btn btn-primary" id="add_field"><i class="glyphicon glyphicon-plus"></i> Add Field </button>
	</div>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>

<div class="hidden" id="field_template">
	<div class="row">
		<div class="col-sm-8">
			<?= $form->field($model, 'field_names[]')?>
		</div>
		<div class="col-sm-3">
			<?= $form->field($model, 'field_sorts[]')->dropDownList(range(1,20), array('required'=>true))?>
		</div>
		<div class="col-sm-1">
			<label>&nbsp;</label> <br />
			<button type="button" class="btn btn-danger delete_field"><i class="glyphicon glyphicon-trash"></i></button>
		</div>
	</div>
</div>
