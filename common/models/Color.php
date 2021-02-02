<?php


namespace common\models;


use yii\base\Model;

/**
 * Class Color
 * Color is a value object
 * @package common\models
 *
 * @property int $name
 */
class Color extends Model
{
    public const GREEN = 1;
    public const RED = 2;
    public const YELLOW = 3;
    public const BLUE = 4;

    /**
     * @var int
     */
    public $color;

    /**
     * @return string
     */
    public function getName()
    {
        return [
            self::GREEN => 'Green',
            self::RED => 'Red',
            self::YELLOW => 'Yellow',
            self::BLUE => 'Blue'
        ][$this->color];
    }

    /**
     * @return int
     */
    public static function getRandomOne(): int
    {
        $list = [self::GREEN, self::RED, self::YELLOW, self::BLUE];

        return $list[array_rand($list)];
    }
}