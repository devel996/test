<?php


namespace common\models;


use yii\base\Model;

/**
 * Class FruitStatus
 * @package common\models
 * @property int $status
 *
 */
class FruitStatus extends Model
{
    public const ON_TREE = 1;
    public const FELL = 2;
    public const ROTTEN = 3;
    public const EATEN = 4;

    public const DEFAULT_SIZE = 100;
    /**
     * @var int
     */
    public $status;

    /**
     * @return string
     */
    public function getName()
    {
        return [
            self::ON_TREE => 'Hanging on a tree',
            self::FELL => 'Lies on the ground',
            self::ROTTEN => 'Rotten fruit',
            self::EATEN => 'Eaten',
        ][$this->status];
    }
}