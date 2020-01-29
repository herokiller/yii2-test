<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apples".
 *
 * @property int $id
 * @property string $color
 * @property int $status
 * @property float $size
 * @property int $created_at
 * @property int $fell_at
 */
class Apple extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apples';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color', 'created_at', 'fell_at'], 'required'],
            [['status', 'created_at', 'fell_at'], 'integer'],
            [['size'], 'number'],
            [['color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
            'status' => 'Status',
            'size' => 'Size',
            'created_at' => 'Created At',
            'fell_at' => 'Fell At',
        ];
    }
}
