<?php


namespace common\exceptions;


use yii\base\Exception;

/**
 * Class LiedFiveHoursException
 * @package common\exceptions
 */
class LiedFiveHoursException extends Exception
{
    public $message = 'Fruit lied more than 5 hours';
}