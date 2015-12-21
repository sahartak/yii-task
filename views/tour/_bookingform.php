<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tour */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tour-form">

	<?php $form = ActiveForm::begin();?>

	<div class="row">
		<div class="col-sm-8">
		<?php
			echo $form->field($booking, 'address')->textarea(['maxlength' => true]);
			echo $form->field($booking, 'time');
			echo $form->field($booking, 'group_num')->input('number');
			echo $form->field($booking, 'agency_id')->input('number');
			echo $form->field($booking, 'adults')->input('number');
			echo $form->field($booking, 'childs')->input('number');
			echo $form->field($booking, 'infants')->input('number');
			echo $form->field($booking, 'pick_up')->input('number');
			echo $form->field($booking, 'drop_off')->input('number');
		?>
		</div>
	</div>


<?php
	if($model->tourFields):
		foreach($model->tourFields as $field):
			?>
			<div class="row">
				<div class="col-sm-8">
					<div class="form-group field-tour-field_names">
						<label class="control-label"><?=$field->name?></label>
						<input type="text" id="tour-field_names" class="form-control" name="Booking[field_values][]">
						<input type="hidden" name="Booking[field_names][]" value="<?=$field->name?>">
						<div class="help-block"></div>
					</div>
				</div>
			</div>

		<?php endforeach; endif?>


	<div class="form-group">
		<?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
