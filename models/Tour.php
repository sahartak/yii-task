<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tour".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Booking[] $bookings
 * @property TourFields[] $tourFields
 */
class Tour extends \yii\db\ActiveRecord
{

    public $field_names = [];
    public $field_sorts = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => 'Tour Name',
            'field_names' => 'Field Name',
            'field_sorts' => 'Field Sort'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourFields()
    {
        return $this->hasMany(TourFields::className(), ['tour_id' => 'id'])->orderBy(['sort' => SORT_ASC]);
    }
}
