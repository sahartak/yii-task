<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tour_fields".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property integer $tour_id
 *
 * @property Tour $tour
 */
class TourFields extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tour_fields';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name', 'sort', 'tour_id'], 'required'],
			[['sort', 'tour_id'], 'integer'],
			[['name'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'sort' => 'Sort',
			'tour_id' => 'Tour ID',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTour()
	{
		return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
	}
}
