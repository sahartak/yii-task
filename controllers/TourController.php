<?php

namespace app\controllers;

use app\models\Booking;
use app\models\BookingFields;
use app\models\TourFields;
use Yii;
use app\models\Tour;
use app\models\TourSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TourController implements the CRUD actions for Tour model.
 */
class TourController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all Tour models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new TourSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Tour model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		$model = Tour::find()->where(['id'=>$id])->one();
		foreach($model->tourFields as $field) {
			$model->field_names[] = $field->name;
		}
		return $this->render('view', [
			'model' => $model,
		]);
	}

	/**
	 * Creates a new Tour model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Tour();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$tour = Yii::$app->request->post('Tour');

			$model->field_names = isset($tour['field_names']) ? $tour['field_names'] : [];
			$model->field_sorts = isset($tour['field_sorts']) ? $tour['field_sorts'] : [];
			if(!empty($model->field_names)) {
				foreach($model->field_names as $key => $field_name) {
					$field = new TourFields();
					$field->tour_id = $model->id;
					$field->name = $field_name;
					$field->sort = isset($model->field_sorts[$key]) ? $model->field_sorts[$key] : 0;
					$field->save();
				}
			}

			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Tour model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = Tour::find()->where(['id'=>$id])->one();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			TourFields::deleteAll(['tour_id' => $model->id]);
			$tour = Yii::$app->request->post('Tour');
			$model->field_names = isset($tour['field_names']) ? $tour['field_names'] : [];
			$model->field_sorts = isset($tour['field_sorts']) ? $tour['field_sorts'] : [];
			if(!empty($model->field_names)) {
				foreach($model->field_names as $key => $field_name) {
					$field = new TourFields();
					$field->tour_id = $model->id;
					$field->name = $field_name;
					$field->sort = isset($model->field_sorts[$key]) ? $model->field_sorts[$key] : 0;
					$field->save();
				}
			}

			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Tour model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$bookings = Booking::findAll(array('tour_id' => $id));
		foreach($bookings as $book) {
			BookingFields::deleteAll(array('booking_id' => $book->id));
		}
		Booking::deleteAll(['tour_id' => $id]);
		TourFields::deleteAll(['tour_id' => $id]);
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}



	/**
	 * Finds the Tour model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Tour the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Tour::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}


	public function actionAddbooking($id)
	{
		$model = Tour::find()->where(['id'=>$id])->one();
		if($model) {
			$booking = new Booking();
			$booking->tour_id = $model->id;
			if ($booking->load(Yii::$app->request->post()) && $booking->save()) {

				$bookingPost = Yii::$app->request->post('Booking');

				$booking->field_names = isset($bookingPost['field_names']) ? $bookingPost['field_names'] : [];
				$booking->field_values = isset($bookingPost['field_values']) ? $bookingPost['field_values'] : [];
				if(!empty($booking->field_values)) {
					foreach($booking->field_values as $key => $value) {
						$bookingField = new BookingFields();
						$bookingField->booking_id = $booking->id;
						$bookingField->value = $value;
						$bookingField->name = isset($booking->field_names[$key]) ? $booking->field_names[$key] : '';
						$bookingField->save();
					}
				}
				return $this->redirect(['bookings', 'id' => $model->id]);

			} else {
				return $this->render('addbooking', compact('model', 'booking'));
			}
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionBookings($id)
	{
		$model = Tour::find()->where(['id'=>$id])->one();
		if($model) {
			return $this->render('bookings', compact('model'));
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
