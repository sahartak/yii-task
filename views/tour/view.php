<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tour */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<a href="<?=Url::to(['tour/bookings', 'id' => $model->id])?>" class="btn btn-warning">View Bookings</a>
		<a href="<?=Url::to(['tour/addbooking', 'id' => $model->id])?>" class="btn btn-success">Add Booking</a>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method' => 'post',
			],
		]) ?>
	</p>

	<?php
		$feilds_str = '<ul>';
		foreach($model->field_names as $field) {
			$feilds_str .= '<li>'.$field.'</li>';
		}
		$feilds_str .= '</ul>';
	?>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'name',
			[
				'label' => 'Fields',
				'value' => $feilds_str,
				'format' => 'html'
			],
		],
	]) ?>

</div>
