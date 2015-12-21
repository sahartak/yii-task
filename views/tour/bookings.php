<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tour */

$this->title = $model->name . ' Bookings';
$this->params['breadcrumbs'][] = ['label' => 'Tours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php foreach($model->bookings as $booking) {
		$attributes = ['id','time', 'address', 'group_num', 'agency_id', 'adults', 'childs', 'infants', 'tour_id', 'pick_up', 'drop_off'];
		foreach($booking->bookingFields as $field) {
			$attributes[] = [
				'label' => $field->name,
				'value' => $field->value
			];
		}
		echo '<h4>Booking - ',$booking->id,'</h4>';
		echo DetailView::widget([
			'model' => $booking,
			'attributes' => $attributes,
		]);
	}?>


</div>
