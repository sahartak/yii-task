<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property integer $id
 * @property string $time
 * @property string $address
 * @property integer $group_num
 * @property integer $agency_id
 * @property integer $adults
 * @property integer $childs
 * @property integer $infants
 * @property integer $tour_id
 * @property integer $pick_up
 * @property integer $drop_off
 *
 * @property Tour $tour
 * @property BookingFields[] $bookingFields
 */
class Booking extends \yii\db\ActiveRecord
{
    public $field_names = [];
    public $field_values = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'address', 'group_num', 'agency_id', 'adults', 'childs', 'infants', 'tour_id', 'pick_up', 'drop_off'], 'required'],
            [['group_num', 'agency_id', 'adults', 'childs', 'infants', 'tour_id', 'pick_up', 'drop_off'], 'integer'],
            [['time'], 'date', 'format' => 'yyyy-M-d'],
            [['address'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'address' => 'Address',
            'group_num' => 'Group Num',
            'agency_id' => 'Agency ID',
            'adults' => 'Adults',
            'childs' => 'Childs',
            'infants' => 'Infants',
            'tour_id' => 'Tour ID',
            'pick_up' => 'Pick Up',
            'drop_off' => 'Drop Off',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingFields()
    {
        return $this->hasMany(BookingFields::className(), ['booking_id' => 'id']);
    }
}
