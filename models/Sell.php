<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sell".
 *
 * @property int $id
 * @property int $id_car
 * @property string $in_date
 * @property float $cost
 * @property float $downpayment
 * @property float $services
 * @property float $sell
 * @property float $profit
 * @property int $enabled
 *
 * @property Car $car
 */
class Sell extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sell';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_car', 'in_date', 'cost', 'downpayment', 'services', 'sell', 'profit'], 'required'],
            [['id_car', 'enabled'], 'integer'],
            [['in_date'], 'safe'],
            [['cost', 'downpayment', 'services', 'sell', 'profit'], 'number'],
            [['id_car'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['id_car' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_car' => 'Id Car',
            'in_date' => 'In Date',
            'cost' => 'Cost',
            'downpayment' => 'Downpayment',
            'services' => 'Services',
            'sell' => 'Sell',
            'profit' => 'Profit',
            'enabled' => 'Enabled',
        ];
    }

    /**
     * Gets query for [[Car]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'id_car']);
    }
}
