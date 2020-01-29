<?php

namespace common\models;

use yii\base\UserException;
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
    const STATUS_TREE = 0;
    const STATUS_GROUND = 1;
    const STATUS_SPOILED = 2;

    const AVAILABLE_COLORS = [
        'green',
        'red',
        'yellow'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apples';
    }

    public function __construct($color = null, $config = []) {
        $this->color = $color;
        $this->validateColor();
        $this->status = self::STATUS_TREE;
        $this->size = 100;
        $this->created_at = rand(0, time());
        $this->fell_at = 0;

        parent::__construct($config);
    }

    public function getRandomColor() {
        return self::AVAILABLE_COLORS[rand(0, count(self::AVAILABLE_COLORS) - 1)];
    }

    public function eat($percent) {
        $percent = (int)$percent;

        if ($this->status == self::STATUS_TREE) {
            throw new UserException('You can not eat apples on tree');
        }

        if ($this->isSpoiled()) {
            throw new UserException('You can not eat spoiled apples');
        }

        $this->size = $this->size - $percent;

        if ($this->size <= 0) {
            $this->delete();
        } else {
            $this->save();
        }
    }

    public function fallToGround() {
        if ($this->status == self::STATUS_TREE) {
            $this->status = self::STATUS_GROUND;
            $this->fell_at = time();
            $this->save();
        }
    }

    public function getStatus() {
        if ($this->status == self::STATUS_TREE)
            return self::STATUS_TREE;

        if ($this->isSpoiled())
            return self::STATUS_SPOILED;

        return self::STATUS_GROUND;
    }

    public function isSpoiled() {
        return time() - $this->fell_at > 5*24*60*60;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color'], 'validateColor'],
            [['status', 'created_at', 'fell_at'], 'integer'],
            [['size'], 'number'],
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

    public function validateColor()
    {
        if (!in_array($this->color, self::AVAILABLE_COLORS))
            $this->color = $this->getRandomColor();
    }
}
