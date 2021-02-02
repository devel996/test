<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apples".
 *
 * @property int $id
 * @property int|null $color
 * @property int|null $status
 * @property float|null $size
 * @property int|null $created_at
 * @property int|null $fell_at
 * @property string $image
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
            [['color', 'status', 'created_at', 'fell_at'], 'integer'],
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

    /**
     * @return string
     */
    public function getImage(): string
    {
        $color = new Color(['color' => $this->color]);

        return '/images/fruits/' . $color->name . '.png';
    }
}
