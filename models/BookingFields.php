<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking_fields".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property integer $booking_id
 *
 * @property Booking $booking
 */
class BookingFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value', 'booking_id'], 'required'],
            [['booking_id'], 'integer'],
            [['name', 'value'], 'string', 'max' => 255]
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
            'value' => 'Value',
            'booking_id' => 'Booking ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking_id']);
    }
}
